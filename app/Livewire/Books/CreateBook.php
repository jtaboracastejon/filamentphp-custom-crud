<?php

namespace App\Livewire\Books;

use App\Filament\Pages\Books\ListBooks;
use App\Models\Book;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateBook extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_title')
                    ->label('Original Title')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('es_title')
                    ->label('Spanish Title')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('author')
                    ->label('Author')
                    ->required(),
                Select::make('genre')
                ->label('Genre')
                ->options([
                    'fantasy' => 'Fantasy',
                    'sci-fi' => 'Sci-Fi',
                    'mystery' => 'Mystery',
                    'horror' => 'Horror',
                    'romance' => 'Romance',
                    'non-fiction' => 'Non-Fiction',
                    'other' => 'Other',
                ])
                ->required()
                ->searchable(),
                Forms\Components\TextInput::make('year')
                    ->label('Year')
                    ->required()
                    ->numeric()
                    ->mask(mask: '9999'),
                Textarea::make(name: 'synopsis')
                    ->label(label: 'Synopsis')
                    ->required()
                    ->maxLength(length: 255)
                    ->columnSpanFull(),
                FileUpload::make('cover')
                    ->label('Cover')
                    ->required()
                    ->storeFileNamesIn(statePath: 'cover_file_names')
                    ->columnSpanFull(),
            ])
            ->columns(3)
            ->statePath('data')
            ->model(Book::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Book::create($data);

        $this->form->model($record)->saveRelationships();

        $notification = Notification::make()
            ->success()
            ->title(title: 'Created');

        $notification->send();

        return $this->redirect(ListBooks::getUrl());
    }

    public function render(): View
    {
        return view('livewire.books.create-book');
    }
}
