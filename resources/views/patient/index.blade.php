@extends('layouts.public')

@section('title', 'Accès aux résultats')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 animate-in">
            
            {{-- Carte principale --}}
            <div class="hero-card">
                <div class="card-header-custom">
                    <h4>🔐 Accès Sécurisé</h4>
                    <p class="subtitle">Consultez vos résultats médicaux en toute confidentialité</p>
                </div>
                
                <div class="icon-box">
                    🔒
                </div>
                
                <div class="card-body px-4 pb-4">
                    
                    {{-- ERREUR ID --}}
                    @if($errors->has('access_id'))
                        <div class="alert-custom mb-4">
                            {{ $errors->first('access_id') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('patient.search') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label-custom">
                                <span style="font-size: 1.125rem;">🔑</span> Votre identifiant unique
                            </label>
                            <input
                                type="text"
                                name="access_id"
                                class="form-control form-control-custom"
                                placeholder="Ex: ABC123XYZ"
                                required
                                autofocus
                                style="text-transform: uppercase; letter-spacing: 0.05em;"
                            >
                            <small class="d-block mt-3" style="color: #6b7280; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                                <span style="font-size: 1.125rem;">💡</span>
                                <span>Entrez l'ID reçu par email ou SMS après votre consultation</span>
                            </small>
                        </div>

                        <button type="submit" class="btn btn-custom w-100">
                            <span style="font-size: 1.25rem;">📄</span> Télécharger mes résultats (PDF)
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <span class="security-badge">
                            🔒 Connexion sécurisée SSL · Données cryptées
                        </span>
                    </div>

                </div>
            </div>

            {{-- Informations complémentaires --}}
            <div class="info-box animate-in" style="animation-delay: 0.2s;">
                <div class="info-box-title">
                    <span style="font-size: 1.5rem;">ℹ️</span>
                    Comment accéder à vos résultats ?
                </div>
                <div class="info-item">
                    Votre ID unique vous a été envoyé par email ou SMS après votre consultation médicale
                </div>
                <div class="info-item">
                    Vos résultats sont disponibles 24h/24 et 7j/7 sur notre plateforme sécurisée
                </div>
                <div class="info-item">
                    Toutes vos données médicales sont cryptées selon les normes RGPD et protégées
                </div>
                <div class="info-item">
                    En cas de perte de votre ID, contactez directement votre médecin traitant
                </div>
            </div>

            {{-- Points forts de la plateforme --}}
            <div class="row g-3 mt-2 animate-in" style="animation-delay: 0.3s;">
                <div class="col-md-6">
                    <div class="feature-highlight">
                        <div class="feature-highlight-icon">⚡</div>
                        <div class="feature-highlight-text">
                            <strong>Accès instantané</strong>
                            <small>Résultats disponibles en temps réel</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-highlight">
                        <div class="feature-highlight-icon">🛡️</div>
                        <div class="feature-highlight-text">
                            <strong>100% sécurisé</strong>
                            <small>Protection maximale de vos données</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-highlight">
                        <div class="feature-highlight-icon">📱</div>
                        <div class="feature-highlight-text">
                            <strong>Multi-support</strong>
                            <small>Accessible PC, mobile et tablette</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-highlight">
                        <div class="feature-highlight-icon">🔔</div>
                        <div class="feature-highlight-text">
                            <strong>Notifications</strong>
                            <small>Alerte email/SMS automatique</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Note de confidentialité --}}
            <div class="animate-in" style="margin-top: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 16px; border: 2px solid #fcd34d; animation-delay: 0.4s;">
                <div style="display: flex; align-items: start; gap: 1rem;">
                    <span style="font-size: 2rem; flex-shrink: 0;">🔐</span>
                    <div>
                        <div style="font-weight: 700; color: #92400e; margin-bottom: 0.5rem; font-size: 1rem;">
                            Confidentialité garantie
                        </div>
                        <p style="margin: 0; color: #78350f; font-size: 0.875rem; line-height: 1.6; font-weight: 500;">
                            Vos résultats médicaux ne sont accessibles qu'avec votre identifiant unique. 
                            Aucune donnée personnelle n'est partagée avec des tiers. Conformité RGPD totale.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection