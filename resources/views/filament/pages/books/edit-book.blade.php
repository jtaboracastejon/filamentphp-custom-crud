<x-filament-panels::page>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/admin/list-books' => 'Books',
        '' => 'Edit',
    ]" />
    <livewire:books.edit-book :record="$record" />
</x-filament-panels::page>
