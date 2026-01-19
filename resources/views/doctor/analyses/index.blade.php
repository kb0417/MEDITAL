<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800">🧪 Analyses</h2>
                <p class="text-sm text-gray-600 mt-1">Toutes vos analyses enregistrées</p>
            </div>

            <a href="{{ route('doctor.analyses.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all">
                ➕ Ajouter une analyse
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">ID Analyse</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Patient</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">PDF</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($analyses as $analyse)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-semibold border border-blue-200">
                                            {{ $analyse->access_id }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $analyse->created_at->format('d/m/Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $analyse->created_at->format('H:i') }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($analyse->patient)
                                            <div class="font-semibold text-gray-800">{{ $analyse->patient->full_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $analyse->patient->email }}</div>
                                        @else
                                            <span class="text-gray-500">—</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <a class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold"
                                           href="{{ asset('storage/'.$analyse->pdf_path) }}"
                                           target="_blank">
                                            📄 Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-14 text-center text-gray-600">
                                        Aucune analyse pour le moment.
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
