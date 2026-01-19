<x-guest-layout>
    
    <h2 class="auth-title">Connexion</h2>
    <p class="auth-subtitle">Accédez à votre espace professionnel</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="status-message">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="label-modern">
                <span style="font-size: 1.125rem;">📧</span> Adresse email
            </label>
            <input id="email" 
                   class="input-modern" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="exemple@email.com" />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
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
                   autocomplete="current-password"
                   placeholder="••••••••" />
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div style="display: flex; align-items: center;">
            <input id="remember_me" 
                   type="checkbox" 
                   class="checkbox-modern" 
                   name="remember"
                   style="width: 1.125rem; height: 1.125rem; cursor: pointer;">
            <label for="remember_me" style="margin-left: 0.625rem; font-size: 0.875rem; color: #6b7280; font-weight: 500; cursor: pointer;">
                Se souvenir de moi
            </label>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 0.5rem;">
            <button type="submit" class="btn-primary-auth">
                <span style="font-size: 1.25rem;">✓</span>
                Se connecter
            </button>
            
            @if (Route::has('password.request'))
                <div style="text-align: center;">
                    <a class="link-modern" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                </div>
            @endif
        </div>
    </form>

    <!-- Lien d'inscription -->
    @if (Route::has('register'))
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(16, 185, 129, 0.1); text-align: center;">
            <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.75rem;">
                Vous n'avez pas encore de compte ?
            </p>
            <a href="{{ route('register') }}" 
               style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); color: #047857; border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.875rem; border: 2px solid rgba(16, 185, 129, 0.2); transition: all 0.3s ease;"
               onmouseover="this.style.background='linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%)'; this.style.borderColor='rgba(16, 185, 129, 0.3)'"
               onmouseout="this.style.background='linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)'; this.style.borderColor='rgba(16, 185, 129, 0.2)'">
                <span style="font-size: 1.125rem;">➕</span>
                Créer un compte
            </a>
        </div>
    @endif

</x-guest-layout>