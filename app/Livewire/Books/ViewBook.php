<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ViewBook extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Book $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Forms\Components\TextInput::make('original_title')
                    ->label('Original Title')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(),
                Forms\Components\TextInput::make('es_title')
                    ->label('Spanish Title')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(),
                Forms\Components\TextInput::make('author')
                    ->label('Author')
                    ->required()
                    ->disabled(),
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
                    ->searchable()
                    ->disabled(),
                Forms\Components\TextInput::make('year')
                    ->label('Year')
                    ->required()
                    ->numeric()
                    ->mask(mask: '9999')
                    ->disabled(),
                Textarea::make(name: 'synopsis')
                    ->label(label: 'Synopsis')
                    ->required()
                    ->maxLength(length: 255)
                    ->columnSpanFull()
                    ->disabled(),
                FileUpload::make('cover')
                    ->label('Cover')
                    ->image()
                    ->required()
                    ->downloadable()
                    ->storeFileNamesIn(statePath: 'cover_file_names')
                    ->columnSpanFull()
                    ->disabled(),
            ])
            ->columns(3)
            ->statePath('data')
            ->model($this->record);
    }

    public function render(): View
    {
        return view('livewire.books.view-book');
    }
}
