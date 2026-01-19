<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl" style="color: #047857; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 2rem;">🏥</span>
                    Tableau de bord administrateur
                </h2>
                <p class="text-sm mt-2" style="color: #6b7280; font-weight: 500;">
                    Bienvenue dans votre espace de gestion · {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                </p>
            </div>
            <a href="{{ route('admin.doctors') }}" class="btn-primary-modern">
                <span style="font-size: 1.25rem;">👨‍⚕️</span>
                Gérer les médecins
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- KPI Cards Modernes --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-in">
                
                {{-- Médecins actifs --}}
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af;">
                            👨‍⚕️
                        </div>
                        <div class="badge-success" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            ● Actifs
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $doctorsActive }}</div>
                    <div class="stat-card-label">Médecins validés</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        Comptes opérationnels
                    </div>
                </div>

                {{-- Analyses totales --}}
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #047857;">
                            📊
                        </div>
                        @php
                        $isUp = $analysesGrowthPct >= 0;
                        @endphp

                        <div class="{{ $isUp ? 'badge-success' : 'badge-warning' }}" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            {{ $isUp ? '+' : '' }}{{ $analysesGrowthPct }}%
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $analysesTotal }}</div>
                    <div class="stat-card-label">Analyses totales</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        {{ $analysesThisMonth }} ce mois-ci
                    </div>
                </div>

                {{-- En validation --}}
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">
                            ⏳
                        </div>
                        <div class="badge-warning" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            ● En attente
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $doctorsPending }}</div>
                    <div class="stat-card-label">Médecins à valider</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        Inscriptions en attente
                    </div>
                </div>

                {{-- Patients --}}
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); color: #9f1239;">
                            👥
                        </div>
                        @php
                        $pUp = $patientsGrowthPct >= 0;
                        @endphp

                        <div class="{{ $pUp ? 'badge-success' : 'badge-warning' }}" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            {{ $pUp ? '+' : '' }}{{ $patientsGrowthPct }}%
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $patientsTotal }}</div>
                    <div class="stat-card-label">Patients enregistrés</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        {{ $patientsThisMonth }} ce mois-ci
                    </div>
                </div>

            </div>

            <div class="card-modern animate-in" style="padding: 2rem; margin-top: 1.5rem;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 800; color: #1f2937;">
                            📈 Analyses par médecin
                        </h3>
                        <p style="font-size: 0.9375rem; color: #6b7280;">
                            Top médecins selon le nombre d’analyses enregistrées
                        </p>
                    </div>
                </div>

                <div style="overflow-x:auto; border-radius: 14px; border: 1px solid rgba(16, 185, 129, 0.1);">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Médecin</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th style="text-align:right;"># Analyses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($analysesByDoctor as $doc)
                                <tr>
                                    <td style="font-weight:700; color:#1f2937;">Dr. {{ $doc->name }}</td>
                                    <td>{{ $doc->email }}</td>
                                    <td>
                                        @if($doc->is_validated)
                                            <span class="badge-success">✅ Validé</span>
                                        @else
                                            <span class="badge-warning">⏳ En attente</span>
                                        @endif
                                    </td>
                                    <td style="text-align:right; font-weight:800; color:#047857;">
                                        {{ $doc->analyses_count }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 1rem; color:#6b7280;">
                                        Aucun médecin / analyse pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Modules en grille --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Gestion des médecins (ACTIF) --}}
                <div class="card-modern animate-in" style="padding: 2rem; animation-delay: 0.1s;">
                    <div class="flex items-start gap-4 mb-5">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                            <span style="font-size: 2rem;">👨‍⚕️</span>
                        </div>
                        <div class="flex-1">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <h3 style="font-weight: 800; font-size: 1.375rem; color: #1f2937;">Gestion des médecins</h3>
                                <span class="badge-success" style="font-size: 0.75rem;">● Actif</span>
                            </div>
                            <p style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">
                                Validation et supervision des comptes médicaux
                            </p>
                        </div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 1.25rem; border-radius: 14px; margin-bottom: 1.5rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.875rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                                    <span style="color: #10b981; font-size: 1rem;">✓</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #047857; font-weight: 500;">Valider les nouvelles inscriptions</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                                    <span style="color: #10b981; font-size: 1rem;">✓</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #047857; font-weight: 500;">Gérer les comptes actifs et suspendus</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                                    <span style="color: #10b981; font-size: 1rem;">✓</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #047857; font-weight: 500;">Suivre l'activité des professionnels</span>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('admin.doctors') }}" class="btn-primary-modern" style="width: 100%; justify-content: center; font-size: 1rem;">
                        Accéder au module
                        <span style="font-size: 1.125rem;">→</span>
                    </a>
                </div>

                {{-- Supervision des analyses --}}
                <div class="card-modern animate-in" style="padding: 2rem; opacity: 0.6; animation-delay: 0.2s;">
                    <div class="flex items-start gap-4 mb-5">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                            <span style="font-size: 2rem;">📊</span>
                        </div>
                        <div class="flex-1">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <h3 style="font-weight: 800; font-size: 1.375rem; color: #1f2937;">Supervision analyses</h3>
                                <span class="badge-warning" style="font-size: 0.75rem;">🚧 Bientôt</span>
                            </div>
                            <p style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">
                                Vue globale et statistiques détaillées
                            </p>
                        </div>
                    </div>
                    
                    <div style="background: #f9fafb; padding: 1.25rem; border-radius: 14px; margin-bottom: 1.5rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.875rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Consulter toutes les analyses</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Générer des rapports automatiques</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Exports de données (PDF, Excel)</span>
                            </div>
                        </div>
                    </div>
                    
                    <button disabled class="btn-secondary-modern" style="width: 100%; justify-content: center; font-size: 1rem; opacity: 0.5; cursor: not-allowed; background: #f3f4f6; color: #9ca3af; border-color: #e5e7eb;">
                        🚧 Module en développement
                    </button>
                </div>

                {{-- Paramètres système --}}
                <div class="card-modern animate-in" style="padding: 2rem; opacity: 0.6; animation-delay: 0.3s;">
                    <div class="flex items-start gap-4 mb-5">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);">
                            <span style="font-size: 2rem;">⚙️</span>
                        </div>
                        <div class="flex-1">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <h3 style="font-weight: 800; font-size: 1.375rem; color: #1f2937;">Paramètres système</h3>
                                <span class="badge-warning" style="font-size: 0.75rem;">🚧 Bientôt</span>
                            </div>
                            <p style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">
                                Configuration complète de la plateforme
                            </p>
                        </div>
                    </div>
                    
                    <div style="background: #f9fafb; padding: 1.25rem; border-radius: 14px; margin-bottom: 1.5rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.875rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Configurer emails & notifications SMS</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Gérer la sécurité et authentification</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Définir permissions utilisateurs</span>
                            </div>
                        </div>
                    </div>
                    
                    <button disabled class="btn-secondary-modern" style="width: 100%; justify-content: center; font-size: 1rem; opacity: 0.5; cursor: not-allowed; background: #f3f4f6; color: #9ca3af; border-color: #e5e7eb;">
                        🚧 Module en développement
                    </button>
                </div>

                {{-- Logs & Activités --}}
                <div class="card-modern animate-in" style="padding: 2rem; opacity: 0.6; animation-delay: 0.4s;">
                    <div class="flex items-start gap-4 mb-5">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(236, 72, 153, 0.2);">
                            <span style="font-size: 2rem;">📝</span>
                        </div>
                        <div class="flex-1">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <h3 style="font-weight: 800; font-size: 1.375rem; color: #1f2937;">Logs & Activités</h3>
                                <span class="badge-warning" style="font-size: 0.75rem;">🚧 Bientôt</span>
                            </div>
                            <p style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">
                                Audit et surveillance en temps réel
                            </p>
                        </div>
                    </div>
                    
                    <div style="background: #f9fafb; padding: 1.25rem; border-radius: 14px; margin-bottom: 1.5rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.875rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Journal des connexions utilisateurs</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Historique des modifications</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 28px; height: 28px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #e5e7eb;">
                                    <span style="color: #9ca3af; font-size: 0.75rem;">○</span>
                                </div>
                                <span style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">Alertes de sécurité automatiques</span>
                            </div>
                        </div>
                    </div>
                    
                    <button disabled class="btn-secondary-modern" style="width: 100%; justify-content: center; font-size: 1rem; opacity: 0.5; cursor: not-allowed; background: #f3f4f6; color: #9ca3af; border-color: #e5e7eb;">
                        🚧 Module en développement
                    </button>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>