<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditBook extends Component implements HasForms
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
            ->schema([
                Forms\Components\TextInput::make('original_title')
                    ->required(),
                Forms\Components\TextInput::make('es_title')
                    ->required(),
                Forms\Components\TextInput::make('author')
                    ->required(),
                Forms\Components\TextInput::make('genre')
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->required(),
                Forms\Components\TextInput::make('synopsis')
                    ->required(),
                Forms\Components\TextInput::make('cover')
                    ->required(),
                Forms\Components\TextInput::make('cover_file_names')
                    ->required(),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.books.edit-book');
    }
}
