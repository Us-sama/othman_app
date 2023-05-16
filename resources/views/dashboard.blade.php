<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permis de confiance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid gap-6 mb-6 md:grid-cols-2 m-6">
                    <div class="mx-auto w-full overflow-hidden px-6 border-r-2 border-grey-600 ">
                        <div class="mb-6">
                            <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"><i class="fa-solid fa-folder mr-2"></i>État génerale des formations et des demandes.</span> </h1>
                        </div>
                        <canvas
                        data-te-chart="bar"
                        data-te-dataset-label="Demandes"
                        data-te-labels="{{$jsonFormationNames}}"
                        data-te-dataset-data="{{$demandeCount}}">
                        </canvas>
                    </div>
                    <div>
                        <div class="mx-auto w-3/5 overflow-hidden ">
                            <div class="">
                                <h2></h2>
                            </div>
                            {{-- <div class="">
                                <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-xl lg:text-xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"><i class="fa-solid fa-folder mr-2"></i>État génerale des demandes</span> </h1>
                            </div> --}}
                            <canvas
                            data-te-chart="doughnut"
                            data-te-dataset-label="Demandes"
                            data-te-labels="{{$labelsJson}}"
                            data-te-dataset-data="{{$dataJson}}"
                            data-te-dataset-background-color="{{$backgroundColorJson}}">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

// const data =
// console.log(data)
// const parsedData = JSON.parse(data);

// // Extract the status labels and counts from the parsed data
// const labels = parsedData.map(item => item.status);
// const counts = parsedData.map(item => item.count);

// // Update the chart attributes with the extracted data
// const chartElement = document.querySelector('[data-te-chart="doughnut"]');
// chartElement.setAttribute('data-te-labels', JSON.stringify(labels));
// chartElement.setAttribute('data-te-dataset-data', JSON.stringify(counts));

// // Optionally, update the background colors as well
// const backgroundColors = ['rgba(63, 81, 181, 0.5)', 'rgba(77, 182, 172, 0.5)', 'rgba(66, 133, 244, 0.5)', 'rgba(156, 39, 176, 0.5)'];
// chartElement.setAttribute('data-te-dataset-background-color', JSON.stringify(backgroundColors));

// </script>
