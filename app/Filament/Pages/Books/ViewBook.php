<?php

namespace App\Filament\Pages\Books;

use Filament\Pages\Page;

class ViewBook extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.books.view-book';
}
