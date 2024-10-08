<?php

namespace App\Filament\Pages\Books;

use Filament\Actions\Action;
use Filament\Pages\Page;

class ListBooks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.books.list-books';

    protected function getHeaderActions(): array
    {
        return [
            Action::make(name: 'Create')
                ->url(url: CreateBooks::getUrl()),
        ];
    }
}
