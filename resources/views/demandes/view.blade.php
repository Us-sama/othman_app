<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des demandes') }}
        </h2>
    </x-slot>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <nav class="flex px-5 py-3 text-gray-700 " aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
              Acceuil
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="{{route('demande.list')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Demandes</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Details de la demande</span>
            </div>
          </li>
        </ol>
      </nav>
</div>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <div class="grid gap-6 mb-6 md:grid-cols-2  flex justify-between  mb-4">


        <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl mb-5 font-bold tracking-tight text-gray-900 dark:text-white w">
                <i class="fa-regular fa-user mr-2"></i>
                {{$demande->demandeur->Nom}}&nbsp;{{$demande->demandeur->Prenom}}

            </h5>
            <h6 class=" bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 mb-2 rounded-full dark:bg-purple-900 dark:text-purple-300 w-fit	">
                <i class="fa-solid fa-id-card"></i>
                {{$demande->demandeur->CIN}}
            </h6>
            <p class="font-normal text-gray-700 dark:text-gray-400 mb-4">
                <span class="font-bold text-gray-700 dark:text-gray-400">
                    <i class="fa-solid fa-cake-candles mr-2"></i>
                    Date de naissance : </span>
                    le {{$demande->demandeur->birthdate}}
            </p>
            <a href="{{route('demande.downloadFile',$demande->demand_files)}}" class="">
                <i class="fa-solid fa-download mr-2"></i>
                Voir les fichiers du demandeurs
            </a>
        </div>
        <div>
            @if($demande->status == 'En attente')
             <div class="block w-full p-6 bg-gray-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-grey-900 dark:text-white">
                        <i class="fa-solid fa-file-lines mr-2"></i>
                        Demande en attente </h5>
                </a>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Accepter ou rejeter la demande
                </p>
                 {{-- <a href="#" x-on:click.prevent="$dispatch('open-modal', 'confirm-demande{{$demande->id}}-payement')">
                    <i class="fa-regular fa-credit-card mr-2"></i>
                    Ajouter le paiement
                </a> --}}

                <div class="grid gap-6 mb-2 md:grid-cols-2  flex justify-between pt-4">
                    <form action="{{route('demande.accepter' ,$demande)}}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            <i class="fa-regular fa-circle-check mr-2"></i>
                            Accepter
                        </button>
                    </form>
                    <form action="{{route('demande.rejeter' ,$demande)}}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            <i class="fa-regular fa-circle-xmark mr-2"></i>
                            Rejeter
                        </button>
                    </form>
                </div>


            </div>
            @elseif($demande->status == 'Acceptée' )
            <div class="block w-full p-6 bg-red-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-red-900 dark:text-white"><i class="fa-solid fa-money-check-dollar mr-2"></i>Paiement non effectué !</h5>
                </a>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Demande acceptée, ajouter un paiement pour que vous pouvez passer a la prochaine étape:
                    <br>
                    Appuyer sur le bouton si dessous pour ajouter un paiement
                </p>
                 {{-- <a href="#" x-on:click.prevent="$dispatch('open-modal', 'confirm-demande{{$demande->id}}-payement')">
                    <i class="fa-regular fa-credit-card mr-2"></i>
                    Ajouter le paiement
                </a> --}}

                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-demande-payement')"
                    class="my-2"
                > <i class="fa-regular fa-credit-card mr-2"></i>{{ __('Ajouter un paiement') }}</x-primary-button>

                <x-modal name="confirm-demande-payement" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="POST" action="{{ route('demande.storePaymentFile',$demande) }}" class="p-6" enctype="multipart/form-data">
                        @csrf

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Ajouter le paiement.') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Télecharger le fichier du paiement dans la case si dessous.') }}
                        </p>

                        <div class="mt-6">
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="payment_file" type="file">
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ml-3" type="submit">
                                {{ __('Ajouter le paiement') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>


            </div>

            @elseif($demande->status == 'Rejetée' )
            <div class="block w-full p-6 bg-red-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-red-900 dark:text-white"><i class="fa-solid fa-money-check-dollar mr-2"></i>Demande Refusée</h5>
                </a>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Vous pouvez accepter cette demande.
                    <br>
                    Appuyer sur le bouton si dessous pour accepter la demande
                </p>
                 {{-- <a href="#" x-on:click.prevent="$dispatch('open-modal', 'confirm-demande{{$demande->id}}-payement')">
                    <i class="fa-regular fa-credit-card mr-2"></i>
                    Ajouter le paiement
                </a> --}}
                <form action="{{route('demande.accepter' ,$demande)}}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fa-regular fa-circle-check mr-2"></i>
                        Accepter
                    </button>
                </form>
            </div>


            @elseif($demande->status == 'Payée')

            <div class="block w-full p-6 bg-emerald-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-Emerald-900 dark:text-white"><i class="fa-solid fa-money-check-dollar mr-2"></i>Paiement effectué !</h5>
                </a>

                <p class="font-normal text-gray-500 dark:text-gray-400 text-xl">Le paiement est bien effectué
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Telecharger ou modifier le fichier du paiement:
                </p>
                <div class="flex justify-between my-4">
                    {{-- <a href="#" >
                        <i class="fa-solid fa-pen mr-2"></i>
                        Modifier le paiement
                    </a> --}}

                    <a href="{{route('demande.downloadFile',$demande->payment_file)}}" class="">
                        <i class="fa-solid fa-download mr-2"></i>
                        Telecharger le paiement
                    </a>
                </div>
            </div>
            @elseif($demande->status == 'En formation')

            <div class="block w-full p-6 bg-violet-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-6 text-2xl font-semibold tracking-tight text-Emerald-900 dark:text-white">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Demandeur en formation</h5>
                </a>

                <p class="font-normal text-gray-500 dark:text-gray-400 text-xl mb-16">En attente de l'evaluation du formation
                </p>
            </div>
            @elseif($demande->status == 'Admis')

            <div class="block w-full p-6 bg-green-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>

                <a href="#">
                    <h5 class="mb-6 text-2xl font-semibold tracking-tight text-green-700 dark:text-white">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Demande approuvée et bien traitée.</h5>
                </a>

                <p class="font-normal text-gray-500 dark:text-gray-400 text-xl mb-16">Le permis est prêt et peut être récupéré.
                </p>
            </div>
            @elseif($demande->status == 'Non admis')

            <div class="block w-full p-6 bg-red-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>


                    <h5 class="mb-6 text-2xl font-semibold tracking-tight text-Emerald-900 dark:text-white">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Demande non admis</h5>


                <p class="font-normal text-gray-500 dark:text-gray-400 text-xl mb-16">La demande est non admis aprés la formation.
                </p>
            </div>
            @elseif($demande->status == 'Recuperé')

            <div class="block w-full p-6 bg-green-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-3xl">

                </div>
                    <h5 class="mb-6 text-2xl font-semibold tracking-tight text-Emerald-900 dark:text-white">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Permis recupéré.</h5>
            </div>
            @endif
        </div>
    </div>

    @if(!$demande->payment_file)

    <div class="block w-full p-6 text-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 " >
        <h2 class="text-rose-500 font-semibold">Veuiller ajouter un paiement pour pouvoir continuer.</h2>
    </div>

    @elseif($demande->status == 'Admis')
    <div class="block w-full p-6 text-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 " >
        <h2 class="text-gray-500 font-semibold text-3xl font-bold dark:text-white mb-6">Permis recuperé ?</h2>
        <form action="{{route('demande.recupere', $demande)}}" method="POST">
            @csrf
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

                Clicker ici pour confirmer la reception
            </button>

        </form>
    </div>

    @elseif($demande->status == 'Non admis' || $demande->status == 'Recuperé' )

    {{-- nothing --}}

    @else
        <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 " >
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Affecter a une formation') }}
            </h2>
            <div class="my-4">
                <form action="{{route('demande.attachFormation',$demande)}}" method="POST">
                    @csrf
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner une formation</label>
                    <select id="foramtion" name="formation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($formations as $formation)
                        <option value="{{$formation->id}}">{{$formation->name}}</option>
                        @endforeach
                    </select>
                    <div class="m-4 flex justify-end">
                        <x-primary-button
                        x-data=""
                        type="submit"
                        class="my-2 disabled:opacity-25"
                        >
                        <i class="fa-regular fa-credit-card mr-2"></i>
                        {{ __('Affecter à la formation') }}
                    </x-primary-button>
                </div>

            </form>

        </div>

    @endif
</div>
</div>


</x-app-layout>
<script>
    function openModal(){
        window.dispatchEvent(new CustomEvent('show', { detail: 'payement-modal' }));
        console.log('opened modal');
    }
</script>
