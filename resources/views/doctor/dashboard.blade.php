<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-900">
                    👨‍⚕️ Espace Médecin
                </h2>
                <p class="text-sm text-gray-600 mt-1">Gestion de vos analyses médicales</p>
            </div>
            <a href="{{ route('doctor.analyses.create') }}" 
               class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 shadow-md transition-all">
                + Nouvelle analyse
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistiques compactes --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                
                <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalAnalyses }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-xl">📊</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Ce mois</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $analysesMois }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <span class="text-xl">📅</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Cette semaine</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $analysesSemaine }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                            <span class="text-xl">⚡</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Liste des analyses --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Liste des analyses</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Patient</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Résultat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($analyses as $analyse)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                            {{ $analyse->access_id }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $analyse->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                            {{ $analyse->patient->full_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/'.$analyse->pdf_path) }}" 
                                           target="_blank"
                                           class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            📄 Voir PDF
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                            Détails
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-400 text-5xl mb-3">📂</div>
                                        <p class="text-gray-600 font-medium">Aucune analyse enregistrée</p>
                                        <p class="text-sm text-gray-500 mt-1">Ajoutez votre première analyse</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($analyses->count() > 0)
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $analyses->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>