<x-filament-panels::page>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/admin/list-books' => 'Books',
        '' => 'Create',
    ]" />
    @livewire('books.create-book')
</x-filament-panels::page>
