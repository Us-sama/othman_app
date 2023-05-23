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
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
              <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Nouvelle demande</span>
            </div>
          </li>
        </ol>
      </nav>
</div>


    <div class="my-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 w-full">
                <form method="POST" action="{{route('demande.store')}}" enctype="multipart/form-data">
                <div class="flex justify-end">
                    <a class="py-2 px-3 bg-transparent hover:bg-cyan-600 text-cyan-600 hover:text-white border border-cyan-600 text-sm font-semibold rounded-md shadow focus:outline-none" href="{{route('demande.list')}}" ><i class="fa-solid fa-xmark mr-2"></i>Annuler</a>
                    <button type="submit" class="bg-violet-500 hover:bg-violet-600 focus:outline-none focus:ring focus:ring-violet-300 active:bg-violet-700 px-5 py-2 text-sm leading-5 rounded-md font-semibold text-white mx-3"><i class="fa-solid fa-check mr-2"></i>Enregistrer</button>
                </div>
                    @csrf

                    <!-- Demandeur section -->
                    <h3 class="text-2xl font-bold dark:text-white">Demandeur</h3>
                    <div class="grid gap-6 mb-6 md:grid-cols-2 block mt-2 p-6 bg-white border border-gray-200 rounded-lg shadow">
                        <div>
                            <label for="Nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du demandeur</label>
                            <input required type="text" name="demandeur[Nom]" id="Nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nom" required>
                        </div>
                        <div>
                            <label for="Prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom du demandeur</label>
                            <input required type="text" name="demandeur[Prenom]" id="Prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prenom" required>
                        </div>
                        <div>
                            <label for="CIN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CIN du demandeur</label>
                            <input required type="text" name="demandeur[CIN]" id="CIN" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CIN">
                            <p id="CIN-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Si le CIN existe déja les autres champs du demandeur seront négligés.</p>
                        </div>
                        <div>
                            <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de naissance</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input id="dpt" type="text" name="demandeur[birthdate]" id="birthdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="sélectionner une date"  >
                              </div>
                            </div>
                        </div>
                        <div>

                        </div>

                        <!-- Demande section -->
                        <h3 class="text-2xl font-bold dark:text-white" >Demande</h3>
                        <div class=" block bg-white border border-gray-200 rounded-lg shadow mt-4 p-4">
                            {{-- <div>

                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                                <select name="demande[status]" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choisir le statut</option>
                                    <option value="En attente">En attente</option>
                                    <option value="Payé/en cours">Payé/en cours</option>
                                    <option value="Rejeté">Rejeté</option>
                                    <option value="Approuvé">Approuvé</option>
                                </select>
                            </div> --}}

                            {{-- <div>
                                <input type="text" id="dpt">
                            </div> --}}
                                <label for="demand_files">Fichiers</label>

                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" id="dropzone-label" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                      <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p id="dropzone-label-text" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clicker ici pour uploader un fichier</span> ou glisser le fichier</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400"></p>
                                      </div>
                                      <input type="file" name="demand_files" id="dropzone-file" class="hidden" required />
                                    </label>
                                  </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const options = {
        formatter: (input, date, instance) => {
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            const value = `${year}-${month}-${day}`;
            input.value = value; // => '2099-1-1'
          },
        }
    const picker = datepicker(document.querySelector('#dpt'),options)
 //change the date format and continue the form design and handle errors gl buddy
//  function formatDate(dateString) {
//   const date = new Date(dateString);
//   const day = date.getDate();
//   const month = date.getMonth() + 1;
//   const year = date.getFullYear();

//   const formattedDate = `${day.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}/${year.toString()}`;

//   document.getElementById('birthdate').value = formattedDate;
// }
document.addEventListener('DOMContentLoaded', function() {
  const input = document.getElementById('dropzone-file');
  input.addEventListener('change', function() {
    updateLabel(this);
  });
});

function updateLabel(input) {
  console.log('changed');
  const label = input.nextElementSibling;
  const labelText = document.querySelector('#dropzone-label-text');
  if (input.value) {
    const fileName = input.value.split('\\').pop();
    labelText.textContent = fileName;
  } else {
    labelText.innerHTML = '<span class="font-semibold">Click to upload</span> or drag and drop';
  }
}
</script>
