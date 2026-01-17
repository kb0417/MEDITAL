<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-900">
                    👋 Tableau de bord
                </h2>
                <p class="text-sm text-gray-600 mt-1">Bienvenue dans votre espace administrateur</p>
            </div>
            <a href="{{ route('admin.doctors') }}" 
               class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition-all">
                👨‍⚕️ Gérer les médecins
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Statistiques en grille compacte --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                
                {{-- Médecins actifs --}}
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Médecins actifs</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $doctorsActive }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-2xl">👨‍⚕️</span>
                        </div>
                    </div>
                </div>

                {{-- Analyses totales --}}
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Analyses totales</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-2xl">📊</span>
                        </div>
                    </div>
                </div>

                {{-- En attente --}}
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">En validation</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $doctorsPending }}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-2xl">⏳</span>
                        </div>
                    </div>
                </div>

                {{-- Patients --}}
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Patients</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-500 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-2xl">👥</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Modules en grille 2x2 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Gestion des médecins (ACTIF) --}}
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-lg transition-all">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-2xl">👨‍⚕️</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Gestion des médecins</h3>
                            <p class="text-sm text-gray-600">Validation et suivi des comptes</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <span class="text-green-500">✓</span>
                            <span>Valider les nouvelles inscriptions</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <span class="text-green-500">✓</span>
                            <span>Gérer les comptes actifs</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <span class="text-green-500">✓</span>
                            <span>Suivre l'activité des médecins</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('admin.doctors') }}" 
                       class="block w-full px-4 py-3 bg-blue-600 text-white text-sm font-semibold text-center rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition-all">
                        Accéder au module →
                    </a>
                </div>

                {{-- Supervision des analyses --}}
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm opacity-70">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-2xl">📊</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Supervision analyses</h3>
                            <p class="text-sm text-gray-600">Vue globale et statistiques</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Consulter toutes les analyses</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Générer des rapports</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Exports de données</span>
                        </div>
                    </div>
                    
                    <div class="block w-full px-4 py-3 bg-gray-200 text-gray-500 text-sm font-semibold text-center rounded-lg cursor-not-allowed">
                        🚧 Bientôt disponible
                    </div>
                </div>

                {{-- Paramètres système --}}
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm opacity-70">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-2xl">⚙️</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Paramètres système</h3>
                            <p class="text-sm text-gray-600">Configuration plateforme</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Configurer emails & SMS</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Gérer la sécurité</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Permissions utilisateurs</span>
                        </div>
                    </div>
                    
                    <div class="block w-full px-4 py-3 bg-gray-200 text-gray-500 text-sm font-semibold text-center rounded-lg cursor-not-allowed">
                        🚧 Bientôt disponible
                    </div>
                </div>

                {{-- Logs & Activités --}}
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm opacity-70">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-2xl">📝</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Logs & Activités</h3>
                            <p class="text-sm text-gray-600">Audit et surveillance</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Journal des connexions</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Historique modifications</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-gray-400">○</span>
                            <span>Alertes de sécurité</span>
                        </div>
                    </div>
                    
                    <div class="block w-full px-4 py-3 bg-gray-200 text-gray-500 text-sm font-semibold text-center rounded-lg cursor-not-allowed">
                        🚧 Bientôt disponible
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>