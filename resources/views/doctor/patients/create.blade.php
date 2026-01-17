{{-- resources/views/doctor/patients/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('doctor.analyses.create') }}"
               class="text-gray-600 hover:text-gray-800 transition-colors font-medium">
                ← Retour
            </a>
            <div class="h-6 w-px bg-gray-300"></div>
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    👤 Ajouter un patient
                </h2>
                <p class="text-sm text-gray-600 mt-1">Créer un patient pour l’associer à une analyse</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            {{-- Flash success --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="card-modern p-8">
                <form method="POST" action="{{ route('doctor.patients.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block mb-2 font-semibold text-gray-800">Nom complet</label>
                        <input type="text"
                               name="full_name"
                               value="{{ old('full_name') }}"
                               class="input-modern"
                               placeholder="Ex: Sarah Benali"
                               required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-800">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="input-modern"
                               placeholder="Ex: sarah@email.com"
                               required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-800">Téléphone (optionnel)</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="input-modern"
                               placeholder="Ex: +212 6XX XX XX XX">
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="btn-primary-modern">
                            ✅ Enregistrer
                        </button>

                        <a href="{{ route('doctor.analyses.create') }}" class="btn-secondary-modern">
                            Annuler
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 mt-2">
                        💡 Après création, vous pourrez sélectionner ce patient dans “Ajouter une analyse”.
                    </p>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
