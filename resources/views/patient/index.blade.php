@extends('layouts.public')

@section('title', 'Accès aux résultats')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 animate-in">
            
            {{-- Carte principale --}}
            <div class="hero-card">
                <div class="card-header-custom">
                    <h4>Accès Sécurisé</h4>
                    <p class="subtitle">Consultez vos résultats médicaux en toute confidentialité</p>
                </div>
                
                <div class="icon-box">
                    🔐
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
                            <label class="form-label-custom">Votre identifiant unique</label>
                            <input
                                type="text"
                                name="access_id"
                                class="form-control form-control-custom"
                                placeholder="Ex: ABC123XYZ"
                                required
                                autofocus
                            >
                            <small class="text-muted d-block mt-2" style="color: #64748b !important;">
                                💡 Entrez l'ID reçu par email ou SMS
                            </small>
                        </div>

                        <button type="submit" class="btn btn-custom w-100">
                            📄 Télécharger mes résultats (PDF)
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <span class="security-badge">
                            🔒 Connexion sécurisée SSL
                        </span>
                    </div>

                </div>
            </div>

            {{-- Informations complémentaires --}}
            <div class="info-box animate-in" style="animation-delay: 0.2s;">
                <div class="info-box-title">
                    ℹ️ Comment accéder à vos résultats ?
                </div>
                <div class="info-item">
                    Votre ID unique vous a été envoyé par email ou SMS après votre consultation
                </div>
                <div class="info-item">
                    Vos résultats sont disponibles 24h/24 et 7j/7 sur notre plateforme sécurisée
                </div>
                <div class="info-item">
                    Toutes vos données médicales sont cryptées selon les normes RGPD
                </div>
            </div>

            {{-- Points forts de la plateforme --}}
            <div class="row g-2 mt-3 animate-in" style="animation-delay: 0.3s;">
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
            </div>

        </div>
    </div>
</div>
@endsection