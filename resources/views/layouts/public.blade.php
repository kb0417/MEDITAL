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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Éléments décoratifs flottants */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            opacity: 0.08;
        }
        
        body::before {
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            top: -300px;
            right: -200px;
            animation: float 20s ease-in-out infinite;
        }
        
        body::after {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #06B6D4 0%, #3B82F6 100%);
            bottom: -200px;
            left: -100px;
            animation: float 15s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
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
            background-image: radial-gradient(circle, rgba(79, 70, 229, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(79, 70, 229, 0.1);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.03);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #1e293b !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-brand .logo-icon {
            font-size: 1.8rem;
            filter: drop-shadow(0 2px 4px rgba(79, 70, 229, 0.2));
        }
        
        main {
            position: relative;
            z-index: 1;
        }
        
        footer {
            position: relative;
            z-index: 1;
            color: #64748b !important;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            margin-top: 4rem;
        }
        
        footer a {
            color: #4F46E5;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        footer a:hover {
            color: #3730a3;
        }

        /* Styles pour les cartes */
        .hero-card {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .hero-card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 20px 50px rgba(0, 0, 0, 0.12),
                0 4px 12px rgba(0, 0, 0, 0.06);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
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
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
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
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
        }
        
        .card-header-custom .subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 0.95rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
            font-weight: 400;
        }
        
        .icon-box {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            margin: -55px auto 2rem;
            box-shadow: 
                0 15px 35px rgba(79, 70, 229, 0.3),
                0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            border: 4px solid white;
        }
        
        .form-control-custom {
            padding: 1rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-weight: 500;
        }
        
        .form-control-custom:focus {
            border-color: #4F46E5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background: white;
            outline: none;
        }
        
        .form-label-custom {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .btn-custom {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.6s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
            background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
        }
        
        .btn-custom:hover::before {
            left: 100%;
        }
        
        .btn-custom:active {
            transform: translateY(0);
        }
        
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: #DC2626;
            border: 1px solid #FCA5A5;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }
        
        .alert-custom::before {
            content: '⚠️';
            font-size: 1.5rem;
        }
        
        .info-box {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            border: 1px solid #e2e8f0;
            margin-top: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }
        
        .info-box-title {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.05rem;
        }
        
        .info-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .info-item:last-child {
            margin-bottom: 0;
        }
        
        .info-item::before {
            content: '✓';
            color: #4F46E5;
            font-weight: bold;
            flex-shrink: 0;
            margin-top: 2px;
            font-size: 1.1rem;
        }
        
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
            color: #4F46E5;
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 1.25rem;
            border: 1px solid #C7D2FE;
        }
        
        /* Petits indicateurs visuels */
        .feature-highlight {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #F8FAFC;
            border-radius: 12px;
            margin-top: 1.5rem;
            border: 1px solid #E2E8F0;
        }
        
        .feature-highlight-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        
        .feature-highlight-text {
            flex: 1;
        }
        
        .feature-highlight-text strong {
            display: block;
            color: #1e293b;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }
        
        .feature-highlight-text small {
            color: #64748b;
            font-size: 0.85rem;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @media (max-width: 768px) {
            body::before,
            body::after {
                width: 300px;
                height: 300px;
            }
            
            .card-header-custom h4 {
                font-size: 1.5rem;
            }
            
            .icon-box {
                width: 75px;
                height: 75px;
                font-size: 2.2rem;
                margin-top: -45px;
            }
            
            .feature-highlight {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="decorative-dots"></div>
    
    {{-- HEADER PUBLIC --}}
    <nav class="navbar navbar-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <span class="logo-icon">🏥</span>
                MediConnect
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
            <p class="mb-2">
                <strong>MediConnect</strong> — Votre santé en toute sécurité
            </p>
            <p class="mb-1" style="font-size: 0.9rem;">
                © {{ date('Y') }} Tous droits réservés
            </p>
            <small style="color: #94a3b8;">
                Questions ? Contactez-nous : <a href="mailto:support@mediconnect.ma">support@mediconnect.ma</a>
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>