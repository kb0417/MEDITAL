<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Consultation des résultats')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #d1fae5 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Éléments décoratifs médicaux */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            opacity: 0.08;
            pointer-events: none;
        }
        
        body::before {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #10b981 0%, #059669 100%);
            top: -300px;
            right: -200px;
            animation: float 20s ease-in-out infinite;
        }
        
        body::after {
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
        
        /* Motif de points décoratif */
        .decorative-dots {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        
        /* Croix médicales décoratives */
        .medical-cross {
            position: fixed;
            color: rgba(16, 185, 129, 0.06);
            font-size: 100px;
            z-index: 0;
            pointer-events: none;
            animation: pulse-medical 4s ease-in-out infinite;
            font-weight: 300;
        }
        
        .medical-cross:nth-child(1) { top: 15%; right: 20%; animation-delay: 0s; }
        .medical-cross:nth-child(2) { bottom: 20%; left: 15%; animation-delay: 1.5s; }
        .medical-cross:nth-child(3) { top: 55%; right: 10%; animation-delay: 3s; }
        
        @keyframes pulse-medical {
            0%, 100% { opacity: 0.04; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.08; transform: scale(1.05) rotate(5deg); }
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #047857 !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .navbar-brand .logo-icon {
            font-size: 2rem;
            filter: drop-shadow(0 2px 4px rgba(16, 185, 129, 0.3));
        }
        
        main {
            position: relative;
            z-index: 1;
        }
        
        footer {
            position: relative;
            z-index: 1;
            color: #6b7280 !important;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            margin-top: 4rem;
            border-top: 1px solid rgba(16, 185, 129, 0.1);
        }
        
        footer a {
            color: #10b981;
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 600;
        }
        
        footer a:hover {
            color: #059669;
        }

        /* Styles pour les cartes */
        .hero-card {
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(16, 185, 129, 0.1);
            box-shadow: 
                0 12px 48px rgba(16, 185, 129, 0.12),
                0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hero-card:hover {
            transform: translateY(-8px);
            box-shadow: 
                0 20px 60px rgba(16, 185, 129, 0.18),
                0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: rgba(16, 185, 129, 0.2);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -50px;
            animation: pulse-slow 6s ease-in-out infinite;
        }
        
        .card-header-custom::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -75px;
            left: -30px;
            animation: pulse-slow 8s ease-in-out infinite reverse;
        }
        
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }
        
        .card-header-custom h4 {
            color: white;
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
        }
        
        .card-header-custom .subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.0625rem;
            margin-top: 0.75rem;
            position: relative;
            z-index: 1;
            font-weight: 500;
        }
        
        .icon-box {
            width: 110px;
            height: 110px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            margin: -65px auto 2.5rem;
            box-shadow: 
                0 20px 40px rgba(16, 185, 129, 0.35),
                0 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            border: 5px solid white;
            animation: icon-float 3s ease-in-out infinite;
        }
        
        @keyframes icon-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .form-control-custom {
            padding: 1.125rem 1.5rem;
            border: 2px solid rgba(16, 185, 129, 0.2);
            border-radius: 14px;
            font-size: 1.0625rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            font-weight: 500;
        }
        
        .form-control-custom:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            background: white;
            outline: none;
        }
        
        .form-label-custom {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.875rem;
            font-size: 1.0625rem;
        }
        
        .btn-custom {
            padding: 1.125rem 2.25rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.125rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
            position: relative;
            overflow: hidden;
        }
        
        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(16, 185, 129, 0.45);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        
        .btn-custom:hover::before {
            left: 100%;
        }
        
        .btn-custom:active {
            transform: translateY(-1px);
        }
        
        .alert-custom {
            border-radius: 14px;
            border: none;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 2px solid #fca5a5;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 600;
            font-size: 0.9375rem;
        }
        
        .alert-custom::before {
            content: '⚠️';
            font-size: 1.75rem;
            flex-shrink: 0;
        }
        
        .info-box {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(16, 185, 129, 0.1);
            margin-top: 2rem;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.08);
        }
        
        .info-box-title {
            font-weight: 800;
            color: #047857;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
        }
        
        .info-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            margin-bottom: 1.125rem;
            color: #374151;
            font-size: 0.9375rem;
            line-height: 1.6;
            font-weight: 500;
        }
        
        .info-item:last-child {
            margin-bottom: 0;
        }
        
        .info-item::before {
            content: '✓';
            color: #10b981;
            font-weight: bold;
            flex-shrink: 0;
            margin-top: 2px;
            font-size: 1.25rem;
        }
        
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #047857;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9375rem;
            font-weight: 700;
            margin-top: 1.5rem;
            border: 2px solid #6ee7b7;
        }
        
        /* Indicateurs visuels */
        .feature-highlight {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 14px;
            margin-top: 1.5rem;
            border: 1px solid rgba(16, 185, 129, 0.15);
            transition: all 0.3s ease;
        }
        
        .feature-highlight:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }
        
        .feature-highlight-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }
        
        .feature-highlight-text {
            flex: 1;
        }
        
        .feature-highlight-text strong {
            display: block;
            color: #047857;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            font-weight: 700;
        }
        
        .feature-highlight-text small {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-in {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @media (max-width: 768px) {
            body::before,
            body::after {
                width: 350px;
                height: 350px;
            }
            
            .card-header-custom {
                padding: 2.5rem 1.5rem;
            }
            
            .card-header-custom h4 {
                font-size: 1.75rem;
            }
            
            .icon-box {
                width: 90px;
                height: 90px;
                font-size: 2.75rem;
                margin-top: -55px;
            }
            
            .feature-highlight {
                flex-direction: column;
                text-align: center;
            }
            
            .medical-cross {
                font-size: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="decorative-dots"></div>
    <div class="medical-cross">✚</div>
    <div class="medical-cross">✚</div>
    <div class="medical-cross">✚</div>
    
    {{-- HEADER PUBLIC --}}
    <nav class="navbar navbar-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <span class="logo-icon">🏥</span>
                MediCare
            </span>
        </div>
    </nav>

    {{-- CONTENU --}}
    <main class="py-5">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center py-4">
        <div class="container">
            <p class="mb-2" style="font-weight: 700; color: #047857 !important;">
                <span style="font-size: 1.25rem;">🏥</span> MediCare
            </p>
            <p class="mb-2" style="color: #6b7280 !important; font-size: 0.9375rem;">
                Votre santé en toute sécurité et confidentialité
            </p>
            <p class="mb-1" style="font-size: 0.875rem; color: #9ca3af !important;">
                © {{ date('Y') }} Tous droits réservés
            </p>
            <small style="color: #9ca3af;">
                Questions ? Contactez-nous : <a href="mailto:support@medicare.ma">support@medicare.ma</a>
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>