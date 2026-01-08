<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('doctor.dashboard') }}" 
               class="text-gray-600 hover:text-gray-800 transition-colors font-medium">
                ← Retour
            </a>
            <div class="h-6 w-px bg-gray-300"></div>
            <div>
                <h2 class="font-semibold text-2xl text-gray-800">
                    ➕ Ajouter une analyse
                </h2>
                <p class="text-sm text-gray-600 mt-1">Importer un résultat d'analyse au format PDF</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Messages d'erreur --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-red-100 border border-red-200 shadow-md">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">⚠️</span>
                        <div>
                            <h3 class="font-semibold text-red-800 mb-1">Erreur lors de l'enregistrement</h3>
                            <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Carte principale --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">

                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-4 shadow-lg">
                        <span class="text-4xl">📄</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        Nouveau résultat d'analyse
                    </h3>
                    <p class="text-gray-600">
                        Importez le document PDF contenant les résultats
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('doctor.analyses.store') }}"
                      enctype="multipart/form-data"
                      class="space-y-6">

                    @csrf

                    {{-- Zone d'upload --}}
                    <div>
                        <label class="block mb-3 font-semibold text-gray-800 text-base">
                            📎 Fichier PDF
                        </label>

                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-12 bg-gray-50 hover:bg-gray-100 hover:border-indigo-400 transition-all duration-300">
                            <input type="file"
                                   name="pdf"
                                   required
                                   accept=".pdf"
                                   id="pdf-input"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="text-center pointer-events-none" id="upload-placeholder">
                                <span class="text-6xl block mb-3">📤</span>
                                <p class="font-semibold text-gray-700 mb-1">Cliquez pour choisir un fichier</p>
                                <p class="text-sm text-gray-500">Format accepté : PDF uniquement</p>
                            </div>
                        </div>

                        <p class="mt-3 text-sm text-gray-600 flex items-start gap-2 bg-blue-50 p-3 rounded-lg border border-blue-100">
                            <span class="text-lg">💡</span>
                            <span>Un identifiant unique sera généré automatiquement pour ce résultat</span>
                        </p>
                    </div>

                    {{-- Informations --}}
                    <div class="p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
                        <div class="flex items-start gap-3">
                            <span class="text-2xl">ℹ️</span>
                            <div class="text-sm">
                                <p class="font-semibold text-blue-900 mb-2">À savoir :</p>
                                <ul class="space-y-1.5 text-blue-700">
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1">•</span>
                                        <span>Le patient recevra automatiquement un email avec son ID d'accès</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1">•</span>
                                        <span>Le document sera stocké de manière sécurisée</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1">•</span>
                                        <span>L'accès sera limité au patient concerné uniquement</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300">
                            <span>✓</span>
                            Enregistrer l'analyse
                        </button>
                        
                        <a href="{{ route('doctor.dashboard') }}" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-200">
                            <span>✕</span>
                            Annuler
                        </a>
                    </div>

                </form>

            </div>

            {{-- Aide rapide --}}
            <div class="mt-6 p-5 bg-white rounded-xl shadow-md border border-gray-200">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <span>🎯</span>
                    Conseils d'utilisation
                </h4>
                <div class="space-y-2 text-sm text-gray-600">
                    <p class="flex items-start gap-2">
                        <span class="text-green-600 font-bold text-base">✓</span>
                        <span>Vérifiez que le PDF est lisible et complet avant de l'importer</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="text-green-600 font-bold text-base">✓</span>
                        <span>Assurez-vous que toutes les informations sensibles sont bien présentes</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="text-green-600 font-bold text-base">✓</span>
                        <span>Le nom du fichier sera conservé tel quel dans le système</span>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Afficher le nom du fichier sélectionné
        document.getElementById('pdf-input').addEventListener('change', function(e) {
            const placeholder = document.getElementById('upload-placeholder');
            if (this.files.length > 0) {
                placeholder.innerHTML = `
                    <span class="text-6xl block mb-3">✓</span>
                    <p class="font-semibold text-green-600 mb-1">Fichier sélectionné</p>
                    <p class="text-sm text-gray-700">${this.files[0].name}</p>
                `;
            }
        });
    </script>

</x-app-layout>