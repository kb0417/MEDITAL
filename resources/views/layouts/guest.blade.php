<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            * {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
            }
            
            body {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #d1fae5 100%);
                min-height: 100vh;
            }
            
            /* Éléments décoratifs */
            .auth-background {
                position: fixed;
                inset: 0;
                z-index: 0;
                overflow: hidden;
                pointer-events: none;
            }
            
            .auth-background::before,
            .auth-background::after {
                content: '';
                position: absolute;
                border-radius: 50%;
                opacity: 0.08;
            }
            
            .auth-background::before {
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, #10b981 0%, #059669 100%);
                top: -300px;
                right: -200px;
                animation: float 20s ease-in-out infinite;
            }
            
            .auth-background::after {
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, #34d399 0%, #10b981 100%);
                bottom: -250px;
                left: -150px;
                animation: float 25s ease-in-out infinite reverse;
            }
            
            @keyframes float {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                25% { transform: translate(30px, -30px) rotate(5deg); }
                50% { transform: translate(-20px, 20px) rotate(-5deg); }
                75% { transform: translate(40px, 10px) rotate(3deg); }
            }
            
            /* Croix médicales */
            .medical-cross {
                position: fixed;
                color: rgba(16, 185, 129, 0.06);
                font-size: 100px;
                z-index: 0;
                pointer-events: none;
                animation: pulse-medical 4s ease-in-out infinite;
                font-weight: 300;
            }
            
            .medical-cross:nth-child(1) { top: 10%; right: 15%; animation-delay: 0s; }
            .medical-cross:nth-child(2) { bottom: 15%; left: 10%; animation-delay: 1.5s; }
            .medical-cross:nth-child(3) { top: 60%; right: 8%; animation-delay: 3s; }
            
            @keyframes pulse-medical {
                0%, 100% { opacity: 0.04; transform: scale(1) rotate(0deg); }
                50% { opacity: 0.08; transform: scale(1.05) rotate(5deg); }
            }
            
            /* Logo container */
            .logo-container {
                position: relative;
                z-index: 1;
                margin-bottom: 2rem;
            }
            
            .logo-box {
                width: 100px;
                height: 100px;
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                border-radius: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);
                border: 5px solid white;
                animation: logo-float 3s ease-in-out infinite;
            }
            
            @keyframes logo-float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            
            .logo-icon {
                font-size: 3.5rem;
            }
            
            .logo-text {
                margin-top: 1rem;
                font-size: 1.75rem;
                font-weight: 800;
                background: linear-gradient(135deg, #047857 0%, #10b981 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            /* Carte d'authentification */
            .auth-card {
                position: relative;
                z-index: 1;
                background: white;
                border-radius: 24px;
                box-shadow: 0 12px 48px rgba(16, 185, 129, 0.15);
                border: 1px solid rgba(16, 185, 129, 0.1);
                padding: 3rem;
                max-width: 480px;
                width: 100%;
                animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .auth-card:hover {
                box-shadow: 0 20px 60px rgba(16, 185, 129, 0.2);
            }
            
            /* Titre */
            .auth-title {
                font-size: 2rem;
                font-weight: 800;
                color: #047857;
                margin-bottom: 0.5rem;
                text-align: center;
            }
            
            .auth-subtitle {
                font-size: 0.9375rem;
                color: #6b7280;
                text-align: center;
                margin-bottom: 2rem;
                font-weight: 500;
            }
            
            /* Inputs */
            .input-modern {
                width: 100%;
                padding: 0.875rem 1.125rem;
                border: 2px solid rgba(16, 185, 129, 0.2);
                border-radius: 12px;
                font-size: 0.9375rem;
                transition: all 0.3s ease;
                background: #f9fafb;
            }
            
            .input-modern:focus {
                outline: none;
                border-color: #10b981;
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
                background: white;
            }
            
            .label-modern {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #1f2937;
                font-size: 0.9375rem;
            }
            
            /* Boutons */
            .btn-primary-auth {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                padding: 0.875rem 1.75rem;
                border-radius: 12px;
                font-weight: 600;
                box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: none;
                display: inline-flex;
                align-items: center;
                gap: 0.625rem;
                cursor: pointer;
                font-size: 0.9375rem;
                width: 100%;
                justify-content: center;
            }
            
            .btn-primary-auth:hover {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
                transform: translateY(-2px);
            }
            
            /* Liens */
            .link-modern {
                color: #10b981;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.875rem;
                transition: color 0.2s ease;
            }
            
            .link-modern:hover {
                color: #059669;
            }
            
            /* Checkbox */
            .checkbox-modern {
                border-radius: 6px;
                border: 2px solid rgba(16, 185, 129, 0.3);
                color: #10b981;
            }
            
            .checkbox-modern:checked {
                background-color: #10b981;
                border-color: #10b981;
            }
            
            .checkbox-modern:focus {
                ring-color: rgba(16, 185, 129, 0.5);
            }
            
            /* Messages d'erreur */
            .error-message {
                color: #dc2626;
                font-size: 0.8125rem;
                margin-top: 0.375rem;
                font-weight: 500;
            }
            
            /* Message de statut */
            .status-message {
                padding: 0.875rem 1.125rem;
                background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
                border: 2px solid #6ee7b7;
                border-radius: 12px;
                color: #047857;
                font-weight: 600;
                font-size: 0.875rem;
                margin-bottom: 1.5rem;
            }
            
            /* Responsive */
            @media (max-width: 640px) {
                .auth-card {
                    padding: 2rem 1.5rem;
                }
                
                .auth-title {
                    font-size: 1.75rem;
                }
                
                .logo-box {
                    width: 80px;
                    height: 80px;
                }
                
                .logo-icon {
                    font-size: 2.75rem;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="auth-background">
            <div class="medical-cross">✚</div>
            <div class="medical-cross">✚</div>
            <div class="medical-cross">✚</div>
        </div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="position: relative; z-index: 1;">
            <div class="logo-container">
                <a href="/">
                    <div class="logo-box">
                        <span class="logo-icon">🏥</span>
                    </div>
                    <div class="logo-text">MediCare</div>
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>