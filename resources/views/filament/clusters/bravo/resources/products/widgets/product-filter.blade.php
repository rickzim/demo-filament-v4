<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit="applyFilters">
            {{ $this->form }}

            <x-filament::button type="submit" wire:target="applyFilters" color="primary" class="mt-4">
                Apply Filters
            </x-filament::button>
            <x-filament::button wire:click="resetFilters" color="primary" class="mt-4">
                Reset Filters
            </x-filament::button>

        </form>
    </x-filament::section>
</x-filament-widgets::widget>
