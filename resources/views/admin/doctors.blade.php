{{-- resources/views/admin/doctors.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                👨‍⚕️ Validation des médecins
            </h2>
            <p class="text-sm text-gray-600 mt-1">
                Gérez les comptes médecins (validation / suivi)
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash success --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- EN ATTENTE --}}
            <div class="card-modern p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">⏳ Médecins en attente</h3>
                    <span class="badge-modern badge-info">
                        {{ $pending->count() }} en attente
                    </span>
                </div>

                @if($pending->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">✅</div>
                        <div class="empty-state-title">Aucun médecin en attente</div>
                        <div class="empty-state-text">Tout est à jour.</div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date inscription</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pending as $doc)
                                    <tr>
                                        <td class="font-semibold text-gray-800">{{ $doc->name }}</td>
                                        <td>{{ $doc->email }}</td>
                                        <td>{{ optional($doc->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.doctors.validate', $doc) }}">
                                                @csrf
                                                <button class="btn-primary-modern" type="submit">
                                                    ✅ Valider
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- VALIDÉS --}}
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">✅ Médecins validés</h3>
                    <span class="badge-modern badge-success">
                        {{ $validated->count() }} validés
                    </span>
                </div>

                @if($validated->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">👨‍⚕️</div>
                        <div class="empty-state-title">Aucun médecin validé</div>
                        <div class="empty-state-text">Validez d’abord des comptes.</div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date validation</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($validated as $doc)
                                    <tr>
                                        <td class="font-semibold text-gray-800">{{ $doc->name }}</td>
                                        <td>{{ $doc->email }}</td>
                                        <td>{{ optional($doc->updated_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge-modern badge-success">✅ Validé</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
