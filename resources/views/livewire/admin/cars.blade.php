<div>
    <div class="py-4 flex justify-between">
        
        <x-alert />

        <x-button wire:click="createModal" primary type="button">
        create
        </x-button>
    </div>

    <div>
        <x-table>
            <x-slot name="thead">
                <x-table.th>
                    Id
                </x-table.th>
                <x-table.th>
                    Name
                </x-table.th>
                <x-table.th>
                    actions
                </x-table.th>
            </x-slot>
            <x-table.tbody>
                @forelse($this->cars as $collection)
                <x-table.tr>
                    <x-table.td>
                    {{ $collection->id }}
                    </x-table.td>
                    <x-table.td>
                    {{ $collection->name }}
                    </x-table.td>
                    <x-table.td>
                        <x-button wire:click="editModal{{ $collection->id }}" secondary>
                            edit
                        </x-button>
                        <x-button wire:click="delete{{ $collection->id }}" danger>
                            delete
                        </x-button>
                    </x-table.td>
                </x-table.tr>
                @empty
                    no data
                @endforelse
                </x-table.tbody>
            </x-table>
    </div>


        <x-modal wire:model="createModal">
            <x-slot name="title">
                create car
            </x-slot>
            <x-slot name="content">
                // error handling
                <form wire:prevent.submit="store">

                    <x-button type="submit" primary>
                        save
                    </x-button>
                </form>
            </x-slot>
        </x-modal>

        <x-modal wire:model="editModal">
            <x-slot name="title">
                update car
            </x-slot>
            <x-slot name="content">
                // error handling
                <form wire:prevent.submit="update">

                    <x-button type="submit" primary>
                        save
                    </x-button>
                </form>
            </x-slot>
        </x-modal>

    </div>
