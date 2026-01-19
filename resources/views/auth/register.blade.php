<x-guest-layout>
    
    <h2 class="auth-title">Inscription</h2>
    <p class="auth-subtitle">Créez votre compte professionnel</p>

    <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="label-modern">
                <span style="font-size: 1.125rem;">👤</span> Nom complet
            </label>
            <input id="name" 
                   class="input-modern" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Dr. Jean Dupont" />
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="label-modern">
                <span style="font-size: 1.125rem;">📧</span> Adresse email professionnelle
            </label>
            <input id="email" 
                   class="input-modern" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="dr.dupont@hopital.ma" />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
            <p style="margin-top: 0.625rem; font-size: 0.8125rem; color: #6b7280; display: flex; align-items: center; gap: 0.5rem;">
                <span>💡</span>
                <span>Utilisez votre email professionnel pour la validation</span>
            </p>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="label-modern">
                <span style="font-size: 1.125rem;">🔒</span> Mot de passe
            </label>
            <input id="password" 
                   class="input-modern"
                   type="password"
                   name="password"
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="label-modern">
                <span style="font-size: 1.125rem;">✓</span> Confirmer le mot de passe
            </label>
            <input id="password_confirmation" 
                   class="input-modern"
                   type="password"
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            @error('password_confirmation')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Info de validation -->
        <div style="padding: 1.125rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 12px; border: 2px solid #fcd34d;">
            <div style="display: flex; align-items: start; gap: 0.75rem;">
                <span style="font-size: 1.25rem; flex-shrink: 0;">ℹ️</span>
                <div style="font-size: 0.8125rem; color: #78350f; font-weight: 500; line-height: 1.5;">
                    <strong style="display: block; margin-bottom: 0.375rem; color: #92400e;">Validation requise</strong>
                    Votre compte sera validé par un administrateur avant l'accès à la plateforme. 
                    Vous recevrez un email de confirmation.
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 0.5rem;">
            <button type="submit" class="btn-primary-auth">
                <span style="font-size: 1.25rem;">✓</span>
                Créer mon compte
            </button>
            
            <div style="text-align: center;">
                <a class="link-modern" href="{{ route('login') }}">
                    Vous avez déjà un compte ? Se connecter
                </a>
            </div>
        </div>
    </form>

</x-guest-layout>