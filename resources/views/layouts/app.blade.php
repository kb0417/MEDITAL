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
                position: relative;
            }

            /* Éléments décoratifs santé */
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

            main {
                position: relative;
                z-index: 1;
            }

            /* Header */
            header {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(16, 185, 129, 0.1);
                box-shadow: 0 2px 12px rgba(16, 185, 129, 0.05);
            }

            /* Cartes modernes santé */
            .card-modern {
                background: white;
                border-radius: 20px;
                box-shadow: 0 4px 24px rgba(16, 185, 129, 0.08);
                border: 1px solid rgba(16, 185, 129, 0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
            }

            .card-modern:hover {
                box-shadow: 0 12px 40px rgba(16, 185, 129, 0.15);
                transform: translateY(-4px);
                border-color: rgba(16, 185, 129, 0.2);
            }

            /* Statistiques cards */
            .stat-card {
                background: white;
                border-radius: 18px;
                padding: 1.5rem;
                border: 1px solid rgba(16, 185, 129, 0.1);
                box-shadow: 0 4px 16px rgba(16, 185, 129, 0.06);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.4s ease;
            }

            .stat-card:hover::before {
                transform: scaleX(1);
            }

            .stat-card:hover {
                box-shadow: 0 12px 32px rgba(16, 185, 129, 0.12);
                transform: translateY(-5px);
            }

            .stat-card-icon {
                width: 56px;
                height: 56px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                margin-bottom: 1rem;
                transition: transform 0.3s ease;
            }

            .stat-card:hover .stat-card-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .stat-card-value {
                font-size: 2.25rem;
                font-weight: 800;
                color: #047857;
                margin-bottom: 0.5rem;
                line-height: 1;
            }

            .stat-card-label {
                font-size: 0.9375rem;
                color: #6b7280;
                font-weight: 500;
            }

            /* Boutons modernes santé */
            .btn-primary-modern {
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
                text-decoration: none;
            }

            .btn-primary-modern:hover {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
                transform: translateY(-2px);
            }

            .btn-secondary-modern {
                background: white;
                color: #10b981;
                padding: 0.875rem 1.75rem;
                border-radius: 12px;
                font-weight: 600;
                border: 2px solid rgba(16, 185, 129, 0.2);
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.625rem;
                cursor: pointer;
                font-size: 0.9375rem;
                text-decoration: none;
            }

            .btn-secondary-modern:hover {
                background: rgba(16, 185, 129, 0.05);
                border-color: #10b981;
            }

            .btn-danger-modern {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
                padding: 0.875rem 1.75rem;
                border-radius: 12px;
                font-weight: 600;
                box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
                transition: all 0.3s ease;
                border: none;
                display: inline-flex;
                align-items: center;
                gap: 0.625rem;
                cursor: pointer;
                font-size: 0.9375rem;
            }

            .btn-danger-modern:hover {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
                box-shadow: 0 8px 24px rgba(239, 68, 68, 0.4);
                transform: translateY(-2px);
            }

            /* Tables modernes */
            .table-modern {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .table-modern thead {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            }

            .table-modern thead th {
                padding: 1.125rem 1.25rem;
                text-align: left;
                font-weight: 700;
                color: #047857;
                font-size: 0.8125rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border-bottom: 2px solid rgba(16, 185, 129, 0.15);
            }

            .table-modern thead th:first-child {
                border-top-left-radius: 14px;
            }

            .table-modern thead th:last-child {
                border-top-right-radius: 14px;
            }

            .table-modern tbody tr {
                transition: all 0.2s ease;
                border-bottom: 1px solid rgba(16, 185, 129, 0.06);
            }

            .table-modern tbody tr:hover {
                background: rgba(16, 185, 129, 0.03);
            }

            .table-modern tbody td {
                padding: 1.125rem 1.25rem;
                color: #374151;
                font-size: 0.9375rem;
            }

            /* Badges santé */
            .badge-modern {
                display: inline-flex;
                align-items: center;
                gap: 0.375rem;
                padding: 0.5rem 1rem;
                border-radius: 50px;
                font-size: 0.8125rem;
                font-weight: 600;
            }

            .badge-success {
                background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
                color: #047857;
                border: 1px solid #6ee7b7;
            }

            .badge-info {
                background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                color: #1e40af;
                border: 1px solid #93c5fd;
            }

            .badge-warning {
                background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                color: #92400e;
                border: 1px solid #fcd34d;
            }

            .badge-danger {
                background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
                color: #991b1b;
                border: 1px solid #fca5a5;
            }

            .badge-pending {
                background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                color: #92400e;
                border: 1px solid #fcd34d;
            }

            /* Input moderne */
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
                animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Empty state */
            .empty-state {
                text-align: center;
                padding: 4rem 2rem;
            }

            .empty-state-icon {
                font-size: 5rem;
                opacity: 0.2;
                margin-bottom: 1.5rem;
                color: #10b981;
            }

            .empty-state-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #047857;
                margin-bottom: 0.75rem;
            }

            .empty-state-text {
                color: #6b7280;
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            /* Modal overlay */
            .modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(4px);
                z-index: 99999;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .modal-container {
                background: white;
                border-radius: 20px;
                max-width: 600px;
                width: 100%;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 20px 60px rgba(16, 185, 129, 0.2);
                animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(40px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .modal-header {
                padding: 2rem;
                border-bottom: 1px solid rgba(16, 185, 129, 0.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .modal-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #047857;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .modal-close {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                border: none;
                background: rgba(16, 185, 129, 0.08);
                color: #6b7280;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
            }

            .modal-close:hover {
                background: rgba(239, 68, 68, 0.1);
                color: #ef4444;
            }

            .modal-body {
                padding: 2rem;
            }

            .modal-footer {
                padding: 1.5rem 2rem;
                border-top: 1px solid rgba(16, 185, 129, 0.1);
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="decorative-dots"></div>
        
        <div class="min-h-screen" style="position: relative; z-index: 1;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>