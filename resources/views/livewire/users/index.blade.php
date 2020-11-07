<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto px-5">
                @if (Session::has('message'))
                    <div id="alert" class="mb-5 bg-{{ Session::get('message')['color'] }}-100 border-t-4 border-{{ Session::get('message')['color'] }}-500 rounded-b text-{{ Session::get('message')['color'] }}-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                            <div>
                                <p class="font-bold">{{ Session::get('message')['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="bg-whit flex px-4 py-3">
                                    <button wire:click="create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Crear usuario
                                    </button>
                                </div>
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <div class="bg-whit flex px-4 py-3">
                                        <input wire:model="search" type="text" placeholder="Buscar usuario" class="form-input w-full">
                                        <select wire:model="paginate" class="form-input ml-4">
                                            <option value="5">5 por página</option>
                                            <option value="10">10 por página</option>
                                            <option value="15">15 por página</option>
                                            <option value="20">20 por página</option>
                                        </select>
                                        @if ($search != '')
                                            <button wire:click="clear" class="form-input rounded-md block ml-4">
                                                x
                                            </button>
                                        @endif
                                    </div>
                                    @if (count($users) > 0)
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                        Nombre
                                                    </th>
                                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                        Correo
                                                    </th>
                                                    <th class="px-6 py-3 bg-gray-50"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                                            {{ $user->name }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                                            {{ $user->email }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                                            <button wire:click="edit({{ $user->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                                Editar
                                                            </button>
                                                            <button wire:click="destroy({{ $user->id }})" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                                Eliminar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="bg-whit px-4 py-3">
                                            {{ $users->links() }}
                                        </div>
                                    @else
                                        <div class="bg-whit px-4 py-3">
                                            No se encontraron registros en la página {{ $this->page }} para la busqueda {{ $search }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    @include('livewire.users.create')
    @include('livewire.users.edit')
</div>
