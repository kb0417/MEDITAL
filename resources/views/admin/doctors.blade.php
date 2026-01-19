{{-- resources/views/admin/doctors.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl" style="color: #047857; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 2rem;">👨‍⚕️</span>
                    Validation des médecins
                </h2>
                <p class="text-sm mt-2" style="color: #6b7280; font-weight: 500;">
                    Gérez les inscriptions et suivez les comptes médecins actifs
                </p>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <div style="text-align: right;">
                    <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Total médecins</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: #047857;">
                        {{ $pending->count() + $validated->count() }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash success --}}
            @if(session('success'))
                <div class="animate-in" style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; border-radius: 16px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border: 2px solid #6ee7b7; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                        ✅
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #047857; font-size: 1rem; margin-bottom: 0.25rem;">Succès !</div>
                        <div style="color: #059669; font-size: 0.9375rem;">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            {{-- Statistiques rapides --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-in">
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">
                            ⏳
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $pending->count() }}</div>
                    <div class="stat-card-label">En attente de validation</div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #047857;">
                            ✅
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $validated->count() }}</div>
                    <div class="stat-card-label">Médecins validés</div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af;">
                            📊
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $pending->count() + $validated->count() }}</div>
                    <div class="stat-card-label">Total comptes médecins</div>
                </div>
            </div>

            {{-- EN ATTENTE --}}
            <div class="card-modern animate-in" style="padding: 2rem; margin-bottom: 2rem; animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 800; color: #1f2937; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <span style="font-size: 1.75rem;">⏳</span>
                            Médecins en attente de validation
                        </h3>
                        <p style="font-size: 0.9375rem; color: #6b7280;">
                            Comptes en attente de votre approbation pour accéder à la plateforme
                        </p>
                    </div>
                    <div class="badge-warning" style="padding: 0.625rem 1.25rem; font-size: 0.9375rem;">
                        <span style="font-size: 1.125rem;">⏱️</span>
                        {{ $pending->count() }} en attente
                    </div>
                </div>

                @if($pending->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">✅</div>
                        <div class="empty-state-title">Aucun médecin en attente</div>
                        <div class="empty-state-text">Toutes les demandes d'inscription ont été traitées. Excellent travail !</div>
                    </div>
                @else
                    <div style="overflow-x: auto; border-radius: 14px; border: 1px solid rgba(16, 185, 129, 0.1);">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Médecin</th>
                                    <th>Contact</th>
                                    <th>Date d'inscription</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pending as $doc)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.875rem;">
                                                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); display: flex; align-items: center; justify-content: center; color: #92400e; font-weight: 700; font-size: 1rem; border: 2px solid white; box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);">
                                                    {{ strtoupper(substr($doc->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 700; color: #1f2937; font-size: 0.9375rem;">
                                                        Dr. {{ $doc->name }}
                                                    </div>
                                                    <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                        Compte en attente
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 500; color: #374151; margin-bottom: 0.25rem;">
                                                {{ $doc->email }}
                                            </div>
                                            <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                Email professionnel
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span style="font-size: 1rem;">📅</span>
                                                <div>
                                                    <div style="font-weight: 600; color: #374151;">
                                                        {{ optional($doc->created_at)->format('d/m/Y') }}
                                                    </div>
                                                    <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                        {{ optional($doc->created_at)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <form method="POST" action="{{ route('admin.doctors.validate', $doc) }}">
                                                @csrf
                                                <button class="btn-primary-modern" type="submit" style="padding: 0.75rem 1.5rem;">
                                                    <span style="font-size: 1.125rem;">✅</span>
                                                    Valider le compte
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($pending->count() > 0)
                        <div style="margin-top: 1.5rem; padding: 1.25rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 12px; border: 1px solid #fcd34d;">
                            <div style="display: flex; align-items: start; gap: 1rem;">
                                <span style="font-size: 1.5rem;">💡</span>
                                <div>
                                    <div style="font-weight: 700; color: #92400e; margin-bottom: 0.25rem;">
                                        Information importante
                                    </div>
                                    <div style="font-size: 0.875rem; color: #78350f;">
                                        Après validation, le médecin recevra un email de confirmation et pourra accéder à son espace professionnel.
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- VALIDÉS --}}
            <div class="card-modern animate-in" style="padding: 2rem; animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 800; color: #1f2937; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <span style="font-size: 1.75rem;">✅</span>
                            Médecins validés et actifs
                        </h3>
                        <p style="font-size: 0.9375rem; color: #6b7280;">
                            Professionnels de santé ayant accès à la plateforme
                        </p>
                    </div>
                    <div class="badge-success" style="padding: 0.625rem 1.25rem; font-size: 0.9375rem;">
                        <span style="font-size: 1.125rem;">✓</span>
                        {{ $validated->count() }} validés
                    </div>
                </div>

                @if($validated->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">👨‍⚕️</div>
                        <div class="empty-state-title">Aucun médecin validé</div>
                        <div class="empty-state-text">
                            Commencez par valider les comptes en attente pour voir apparaître les médecins actifs ici.
                        </div>
                    </div>
                @else
                    <div style="overflow-x: auto; border-radius: 14px; border: 1px solid rgba(16, 185, 129, 0.1);">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Médecin</th>
                                    <th>Contact</th>
                                    <th>Date de validation</th>
                                    <th>Statut</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($validated as $doc)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.875rem;">
                                                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); display: flex; align-items: center; justify-content: center; color: #047857; font-weight: 700; font-size: 1rem; border: 2px solid white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                                                    {{ strtoupper(substr($doc->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 700; color: #1f2937; font-size: 0.9375rem;">
                                                        Dr. {{ $doc->name }}
                                                    </div>
                                                    <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                        Compte actif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 500; color: #374151; margin-bottom: 0.25rem;">
                                                {{ $doc->email }}
                                            </div>
                                            <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                Email professionnel
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span style="font-size: 1rem;">📅</span>
                                                <div>
                                                    <div style="font-weight: 600; color: #374151;">
                                                        {{ optional($doc->updated_at)->format('d/m/Y') }}
                                                    </div>
                                                    <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                        {{ optional($doc->updated_at)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge-success" style="display: inline-flex;">
                                                <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; display: inline-block; animation: pulse 2s ease-in-out infinite;"></span>
                                                <span style="margin-left: 0.5rem;">Actif</span>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                                <button class="btn-secondary-modern" style="padding: 0.625rem 1.25rem; font-size: 0.875rem;">
                                                    <span>👁️</span>
                                                    Voir détails
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 1.5rem; padding: 1.25rem; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 12px; border: 1px solid #6ee7b7;">
                        <div style="display: flex; align-items: start; gap: 1rem;">
                            <span style="font-size: 1.5rem;">📊</span>
                            <div>
                                <div style="font-weight: 700; color: #047857; margin-bottom: 0.25rem;">
                                    Médecins opérationnels
                                </div>
                                <div style="font-size: 0.875rem; color: #059669;">
                                    Ces professionnels peuvent créer des dossiers patients et saisir des résultats d'analyses sur la plateforme.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</x-app-layout>