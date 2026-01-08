<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                👑 Tableau de bord - Administrateur
            </h2>
            <p class="text-sm text-gray-600 mt-1">Vue d'ensemble et gestion de la plateforme</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Message de bienvenue --}}
            <div class="card-modern p-8 mb-8 animate-in" 
                 style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none;">
                <div class="flex items-start gap-4">
                    <div class="text-6xl">👋</div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-2">
                            Bienvenue, Administrateur !
                        </h3>
                        <p class="text-white/90 text-lg">
                            Vous avez un contrôle total sur la plateforme MediConnect
                        </p>
                    </div>
                </div>
            </div>

            {{-- Statistiques globales --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="stat-card animate-in" style="animation-delay: 0.1s;">
                    <div class="stat-card-icon" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);">
                        👨‍⚕️
                    </div>
                    <div class="stat-card-value">0</div>
                    <div class="stat-card-label">Médecins actifs</div>
                </div>

                <div class="stat-card animate-in" style="animation-delay: 0.2s;">
                    <div class="stat-card-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                        📊
                    </div>
                    <div class="stat-card-value">0</div>
                    <div class="stat-card-label">Analyses totales</div>
                </div>

                <div class="stat-card animate-in" style="animation-delay: 0.3s;">
                    <div class="stat-card-icon" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                        ⏳
                    </div>
                    <div class="stat-card-value">0</div>
                    <div class="stat-card-label">En attente validation</div>
                </div>

                <div class="stat-card animate-in" style="animation-delay: 0.4s;">
                    <div class="stat-card-icon" style="background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);">
                        👥
                    </div>
                    <div class="stat-card-value">0</div>
                    <div class="stat-card-label">Patients actifs</div>
                </div>

            </div>

            {{-- Fonctionnalités à venir --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Gestion des médecins --}}
                <div class="card-modern p-6 animate-in" style="animation-delay: 0.5s;">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl"
                             style="background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);">
                            👨‍⚕️
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">
                                Gestion des médecins
                            </h3>
                            <p class="text-sm text-gray-600">
                                Validez et gérez les comptes médecins
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Validation des nouvelles inscriptions</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Suspension / Activation de comptes</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Historique des activités</span>
                        </div>
                    </div>
                    
                    <button class="btn-secondary-modern w-full" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <span>🚧</span>
                        Bientôt disponible
                    </button>
                </div>

                {{-- Gestion des analyses --}}
                <div class="card-modern p-6 animate-in" style="animation-delay: 0.6s;">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl"
                             style="background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);">
                            📊
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">
                                Supervision des analyses
                            </h3>
                            <p class="text-sm text-gray-600">
                                Consultez toutes les analyses de la plateforme
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Vue globale de toutes les analyses</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Statistiques détaillées</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Exports et rapports</span>
                        </div>
                    </div>
                    
                    <button class="btn-secondary-modern w-full" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <span>🚧</span>
                        Bientôt disponible
                    </button>
                </div>

                {{-- Paramètres système --}}
                <div class="card-modern p-6 animate-in" style="animation-delay: 0.7s;">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl"
                             style="background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);">
                            ⚙️
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">
                                Paramètres système
                            </h3>
                            <p class="text-sm text-gray-600">
                                Configuration de la plateforme
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Configuration des emails</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Gestion des notifications SMS</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Paramètres de sécurité</span>
                        </div>
                    </div>
                    
                    <button class="btn-secondary-modern w-full" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <span>🚧</span>
                        Bientôt disponible
                    </button>
                </div>

                {{-- Logs et activités --}}
                <div class="card-modern p-6 animate-in" style="animation-delay: 0.8s;">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl"
                             style="background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);">
                            📝
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">
                                Logs & Activités
                            </h3>
                            <p class="text-sm text-gray-600">
                                Surveillance et audit de la plateforme
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Journal des connexions</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Historique des modifications</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-green-500">✓</span>
                            <span>Alertes de sécurité</span>
                        </div>
                    </div>
                    
                    <button class="btn-secondary-modern w-full" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <span>🚧</span>
                        Bientôt disponible
                    </button>
                </div>

            </div>

            {{-- Note de développement --}}
            <div class="card-modern p-6 mt-8 animate-in" 
                 style="background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%); animation-delay: 0.9s;">
                <div class="flex items-start gap-4">
                    <span class="text-4xl">🚀</span>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 mb-2">Développement en cours</h3>
                        <p class="text-gray-600 mb-3">
                            Les fonctionnalités de gestion des médecins, validation des comptes et supervision 
                            des analyses sont actuellement en développement. Elles seront ajoutées dans les 
                            prochaines versions de la plateforme.
                        </p>
                        <p class="text-sm text-gray-500">
                            💡 En attendant, vous pouvez tester les autres espaces (Patient et Médecin) pour 
                            avoir un aperçu complet du système.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>