<div>
    <form wire:submit="create">
        {{ $this->form }}
        <br>
        <x-filament::button type="submit">
            Create
        </x-filament::button>
    </form>
</div>
