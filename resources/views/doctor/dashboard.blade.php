<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl" style="color: #047857; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 2rem;">👨‍⚕️</span>
                    Espace Médecin
                </h2>
                <p class="text-sm mt-2" style="color: #6b7280; font-weight: 500;">
                    Gérez vos analyses médicales et suivez vos patients
                </p>
            </div>
            <a href="{{ route('doctor.analyses.create') }}" class="btn-primary-modern">
                <span style="font-size: 1.25rem;">➕</span>
                Nouvelle analyse
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- KPI Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 animate-in">
                
                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af;">
                            📊
                        </div>
                        <div class="badge-info" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            Total
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $totalAnalyses }}</div>
                    <div class="stat-card-label">Analyses totales</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        Depuis le début
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #047857;">
                            📅
                        </div>
                        <div class="badge-success" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            ● Ce mois
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $analysesMois }}</div>
                    <div class="stat-card-label">Analyses du mois</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('MMMM YYYY') }}
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between mb-4">
                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); color: #9f1239;">
                            ⚡
                        </div>
                        <div class="badge-warning" style="padding: 0.375rem 0.75rem; font-size: 0.75rem;">
                            7 jours
                        </div>
                    </div>
                    <div class="stat-card-value">{{ $analysesSemaine }}</div>
                    <div class="stat-card-label">Cette semaine</div>
                    <div style="margin-top: 0.875rem; padding-top: 0.875rem; border-top: 1px solid rgba(16, 185, 129, 0.08); font-size: 0.8125rem; color: #9ca3af;">
                        Activité récente
                    </div>
                </div>

            </div>

            {{-- Liste des analyses --}}
            <div class="card-modern animate-in" style="animation-delay: 0.1s;">
                
                <div style="padding: 2rem; border-bottom: 1px solid rgba(16, 185, 129, 0.1);">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 800; color: #1f2937; display: flex; align-items: center; gap: 0.75rem;">
                                <span style="font-size: 1.75rem;">📋</span>
                                Liste des analyses
                            </h3>
                            <p style="font-size: 0.9375rem; color: #6b7280; margin-top: 0.5rem;">
                                Historique complet de vos résultats d'analyses
                            </p>
                        </div>
                        <div class="badge-info" style="padding: 0.625rem 1.25rem; font-size: 0.9375rem;">
                            {{ $analyses->total() }} résultats
                        </div>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>ID d'accès</th>
                                <th>Date & Heure</th>
                                <th>Patient</th>
                                <th>Document</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($analyses as $analyse)
                                <tr>
                                    <td>
                                        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 50px; border: 1px solid #93c5fd;">
                                            <span style="color: #1e40af; font-weight: 700; font-size: 0.8125rem; font-family: monospace;">
                                                {{ $analyse->access_id }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <span style="font-size: 1rem;">📅</span>
                                            <div>
                                                <div style="font-weight: 600; color: #374151;">
                                                    {{ $analyse->created_at->format('d/m/Y') }}
                                                </div>
                                                <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                    {{ $analyse->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); display: flex; align-items: center; justify-content: center; color: #047857; font-weight: 700; font-size: 0.875rem; border: 2px solid white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                                                {{ strtoupper(substr($analyse->patient->full_name ?? 'N/A', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #1f2937; font-size: 0.9375rem;">
                                                    {{ $analyse->patient->full_name ?? 'N/A' }}
                                                </div>
                                                <div style="font-size: 0.8125rem; color: #9ca3af;">
                                                    Patient
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/'.$analyse->pdf_path) }}" 
                                           target="_blank"
                                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.125rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.875rem; border: 1px solid #fcd34d; transition: all 0.3s ease;">
                                            <span style="font-size: 1.125rem;">📄</span>
                                            Voir le PDF
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn-secondary-modern" style="padding: 0.625rem 1.25rem; font-size: 0.875rem;">
                                            <span>👁️</span>
                                            Détails
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">📂</div>
                                            <div class="empty-state-title">Aucune analyse enregistrée</div>
                                            <div class="empty-state-text">
                                                Commencez par ajouter votre première analyse médicale
                                            </div>
                                            <a href="{{ route('doctor.analyses.create') }}" class="btn-primary-modern" style="margin-top: 1.5rem;">
                                                <span style="font-size: 1.25rem;">➕</span>
                                                Ajouter une analyse
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($analyses->count() > 0)
                    <div style="padding: 1.5rem 2rem; border-top: 1px solid rgba(16, 185, 129, 0.1);">
                        {{ $analyses->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>