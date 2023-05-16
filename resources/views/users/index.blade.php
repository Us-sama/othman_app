<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-between">
                    {{ __("Liste des utilisateurs") }}
                    <a href="{{route('user.create')}}" class=" py-2 px-3 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold rounded-md shadow focus:outline-none" >Ajouter un utilisateur</a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-4 mt-4">
                <table id="usersTable" class="display">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Crée le</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        @if($user->active)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->roles->first()->name == 'chef')

                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400">{{ $user->roles->first()->name }}</span>
                                @endif
                                @if($user->roles->first()->name == 'admin')

                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">{{ $user->roles->first()->name }}</span>
                                @endif
                                @if($user->roles->first()->name == 'agent')

                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">{{ $user->roles->first()->name }}</span>
                                @endif
                            </td>

                            <td><i class="fa-regular fa-clock mr-2"></i>{{ $user->created_at }}</td>
                            <td class="flex justify-end">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link href="{{route('user.edit', $user)}}" ><i class="fa-regular fa-pen-to-square mr-2"></i>Modifier</x-dropdown-link>
                                        <x-dropdown-link x-on:click.prevent="$dispatch('open-modal', 'confirm-user{{$user->id}}-deletion')"><i class="fa-regular fa-trash-can mr-2"></i>Supprimer</x-dropdown-link>
                                    </x-slot>

                                </x-dropdown>
                            </td>
                        </tr>

                        <x-modal name="confirm-user{{$user->id}}-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

                            <div class="p-6 text-center">
                                <form action="{{route('user.destroy',$user)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Êtes-vous sure de supprimer cet user ?</h3>

                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Oui, Supprimer!
                                    </button>

                                </form>
                                {{-- <button x-on:click.prevent="$dispatch('close-modal', 'confirm-user{{$user->id}}-deletion')"class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button> --}}
                            </div>
                        </x-modal>

                        @endif
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</x-app-layout>
<script>
    let table = new DataTable('#usersTable', {
        responsive: true,
        fixedHeader: true,
        "language": {
            "sEmptyTable":    "Aucune donnée disponible dans le tableau",
            "sInfo":          "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":     "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":  "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":   "",
            "sInfoThousands": ",",
            "sLengthMenu":    "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":    "Traitement...",
            "sSearch":        "Rechercher : ",
            "sZeroRecords":   "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
    </script>
