<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800">👥 Patients</h2>
                <p class="text-sm text-gray-600 mt-1">Liste des patients et état des analyses</p>
            </div>

            <a href="{{ route('doctor.patients.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow hover:shadow-lg transition">
                ➕ Nouveau patient
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Patient</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Contact</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Analyses</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Dernière analyse</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Statut</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($patients as $patient)
                                @php
                                    $lastAnalyse = $patient->analyses->first(); // car on a trié latest()
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $patient->full_name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $patient->id }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-gray-800">{{ $patient->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $patient->phone ?? '—' }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-semibold border border-blue-200">
                                            {{ $patient->analyses_count }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($lastAnalyse)
                                            <div class="font-semibold text-gray-800">
                                                {{ $lastAnalyse->created_at->format('d/m/Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID accès: {{ $lastAnalyse->access_id }}
                                            </div>
                                        @else
                                            <span class="text-gray-500">—</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($patient->analyses_count > 0)
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-50 text-green-700 text-sm font-semibold border border-green-200">
                                                ✅ Analyse disponible
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-sm font-semibold border border-amber-200">
                                                ⏳ Aucune analyse
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-14 text-center text-gray-600">
                                        Aucun patient pour le moment.
                                        <div class="mt-4">
                                            <a href="{{ route('doctor.patients.create') }}"
                                               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl">
                                                ➕ Créer un patient
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
