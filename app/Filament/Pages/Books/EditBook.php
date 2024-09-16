<?php

namespace App\Filament\Pages\Books;

use App\Models\Book;
use Filament\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class EditBook extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.books.edit-book';

    //!IMPORTANT Hide the page from the navigation
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'books/edit/{record}';

    public $record;

    public function mount(int | string $record): void
    {
        $this->record = Book::findOrFail($record);
    }
}
