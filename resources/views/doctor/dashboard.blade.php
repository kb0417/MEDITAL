<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    👨‍⚕️ Espace Médecin
                </h2>
                <p class="text-sm text-gray-600 mt-1">Gérez vos analyses médicales</p>
            </div>
        </div>
    </x-slot>

    {{-- CONTENU PRINCIPAL --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistiques --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-2xl mb-4">
                        📊
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1">{{ $analyses->count() }}</div>
                    <div class="text-sm text-gray-600 font-medium">Analyses totales</div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-2xl mb-4">
                        ✅
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1">{{ $analyses->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                    <div class="text-sm text-gray-600 font-medium">Ce mois-ci</div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center text-2xl mb-4">
                        📅
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1">{{ $analyses->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                    <div class="text-sm text-gray-600 font-medium">Cette semaine</div>
                </div>

            </div>

            {{-- Carte principale --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow duration-300">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">
                            📋 Liste des analyses
                        </h3>
                        <p class="text-sm text-gray-600">
                            Historique complet de vos analyses enregistrées
                        </p>
                    </div>
                    
                    <a href="{{ route('doctor.analyses.create') }}" 
                       class="mt-4 md:mt-0 inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 hover:-translate-y-0.5">
                        <span>➕</span>
                        Ajouter une analyse
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    🆔 ID Analyse
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    📅 Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    👤 Patient
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    📄 Résultat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    ⚡ Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($analyses as $analyse)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-50 text-blue-700 text-sm font-semibold rounded-full border border-blue-200">
                                            {{ $analyse->access_id }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">
                                            {{ $analyse->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $analyse->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-50 text-green-700 text-sm font-semibold rounded-full border border-green-200">
                                            ✓ Enregistré
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors"
                                           href="{{ asset('storage/'.$analyse->pdf_path) }}"
                                           target="_blank">
                                            <span>📄</span>
                                            Voir le PDF
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="inline-flex items-center gap-2 px-4 py-2 bg-white text-indigo-600 font-semibold rounded-lg border-2 border-indigo-100 hover:bg-indigo-50 hover:border-indigo-200 transition-all duration-200">
                                            <span>👁️</span>
                                            Détails
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16">
                                        <div class="text-center">
                                            <div class="text-6xl mb-4 opacity-30">📂</div>
                                            <div class="text-xl font-semibold text-gray-800 mb-2">Aucune analyse enregistrée</div>
                                            <p class="text-gray-600 mb-6">
                                                Commencez par ajouter votre première analyse médicale
                                            </p>
                                            <a href="{{ route('doctor.analyses.create') }}" 
                                               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300">
                                                <span>➕</span>
                                                Ajouter une analyse
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>