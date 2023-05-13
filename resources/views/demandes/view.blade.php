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

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="grid gap-6 mb-6 md:grid-cols-2 bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between p-6 mb-4">


        <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl mb-5 font-bold tracking-tight text-gray-900 dark:text-white w">
                <i class="fa-regular fa-user mr-2"></i>
                {{$demande->demandeur->Nom}}&nbsp;{{$demande->demandeur->Prenom}}

            </h5>
            <h6 class=" bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 mb-2 rounded-full dark:bg-purple-900 dark:text-purple-300 w-fit	">
                <i class="fa-solid fa-id-card"></i>
                {{$demande->demandeur->CIN}}
            </h6>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                <span class="font-bold text-gray-700 dark:text-gray-400">
                    <i class="fa-solid fa-cake-candles mr-2"></i>
                    Date de naissance : </span>
                    le {{$demande->demandeur->birthdate}}
            </p>
        </div>
        <div>
            {{-- <button onclick="openModal()">
                Show Modal
            </button>
            <x-modal name='payement-modal' :show="" maxWidth="lg" focusable>
                <x-slot>
                    <h1>this is a modal</h1>
                </x-slot>
            </x-modal> --}}
        </div>




    </div>
</div>


</x-app-layout>
<script>
    function openModal(){
        window.dispatchEvent(new CustomEvent('show', { detail: 'payement-modal' }));
        console.log('opened modal');
    }
</script>
