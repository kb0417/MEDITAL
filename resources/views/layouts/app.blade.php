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
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
            }
            
            /* Éléments décoratifs */
            body::before,
            body::after {
                content: '';
                position: fixed;
                border-radius: 50%;
                z-index: 0;
                opacity: 0.06;
                pointer-events: none;
            }
            
            body::before {
                width: 500px;
                height: 500px;
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                top: -250px;
                right: -150px;
            }
            
            body::after {
                width: 400px;
                height: 400px;
                background: linear-gradient(135deg, #06B6D4 0%, #3B82F6 100%);
                bottom: -200px;
                left: -100px;
            }
            
            .decorative-dots {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 0;
                pointer-events: none;
                background-image: radial-gradient(circle, rgba(79, 70, 229, 0.04) 1px, transparent 1px);
                background-size: 30px 30px;
            }
            
            main {
                position: relative;
                z-index: 1;
            }
            
            /* Cartes améliorées */
            .card-modern {
                background: white;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
                border: 1px solid rgba(226, 232, 240, 0.8);
                transition: all 0.3s ease;
            }
            
            .card-modern:hover {
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }
            
            /* Boutons modernes */
            .btn-primary-modern {
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 10px;
                font-weight: 600;
                box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
                transition: all 0.3s ease;
                border: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .btn-primary-modern:hover {
                background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
                box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
                transform: translateY(-2px);
            }
            
            .btn-secondary-modern {
                background: white;
                color: #4F46E5;
                padding: 0.75rem 1.5rem;
                border-radius: 10px;
                font-weight: 600;
                border: 2px solid #E0E7FF;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .btn-secondary-modern:hover {
                background: #F5F7FF;
                border-color: #C7D2FE;
            }
            
            /* Tables modernes */
            .table-modern {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            
            .table-modern thead {
                background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            }
            
            .table-modern thead th {
                padding: 1rem;
                text-align: left;
                font-weight: 700;
                color: #1e293b;
                font-size: 0.875rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border-bottom: 2px solid #E2E8F0;
            }
            
            .table-modern thead th:first-child {
                border-top-left-radius: 12px;
            }
            
            .table-modern thead th:last-child {
                border-top-right-radius: 12px;
            }
            
            .table-modern tbody tr {
                transition: all 0.2s ease;
            }
            
            .table-modern tbody tr:hover {
                background: #F8FAFC;
            }
            
            .table-modern tbody td {
                padding: 1rem;
                border-bottom: 1px solid #F1F5F9;
                color: #475569;
            }
            
            .table-modern tbody tr:last-child td:first-child {
                border-bottom-left-radius: 12px;
            }
            
            .table-modern tbody tr:last-child td:last-child {
                border-bottom-right-radius: 12px;
            }
            
            /* Badge */
            .badge-modern {
                display: inline-flex;
                align-items: center;
                gap: 0.375rem;
                padding: 0.375rem 0.875rem;
                border-radius: 50px;
                font-size: 0.8125rem;
                font-weight: 600;
            }
            
            .badge-success {
                background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
                color: #059669;
                border: 1px solid #A7F3D0;
            }
            
            .badge-info {
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
                color: #2563EB;
                border: 1px solid #BFDBFE;
            }
            
            /* Statistiques cards */
            .stat-card {
                background: white;
                border-radius: 16px;
                padding: 1.5rem;
                border: 1px solid #E2E8F0;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
            }
            
            .stat-card:hover {
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
                transform: translateY(-3px);
            }
            
            .stat-card-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
            
            .stat-card-value {
                font-size: 2rem;
                font-weight: 700;
                color: #1e293b;
                margin-bottom: 0.25rem;
            }
            
            .stat-card-label {
                font-size: 0.875rem;
                color: #64748b;
                font-weight: 500;
            }
            
            /* Input moderne */
            .input-modern {
                width: 100%;
                padding: 0.875rem 1rem;
                border: 2px solid #E2E8F0;
                border-radius: 10px;
                font-size: 0.9375rem;
                transition: all 0.3s ease;
                background: #F8FAFC;
            }
            
            .input-modern:focus {
                outline: none;
                border-color: #4F46E5;
                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
                background: white;
            }
            
            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-in {
                animation: fadeInUp 0.5s ease-out;
            }
            
            /* Empty state */
            .empty-state {
                text-align: center;
                padding: 3rem 1.5rem;
            }
            
            .empty-state-icon {
                font-size: 4rem;
                opacity: 0.3;
                margin-bottom: 1rem;
            }
            
            .empty-state-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: #1e293b;
                margin-bottom: 0.5rem;
            }
            
            .empty-state-text {
                color: #64748b;
                font-size: 0.9375rem;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="decorative-dots"></div>
        
        <div class="min-h-screen" style="position: relative; z-index: 1;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="shadow-sm" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(226, 232, 240, 0.8);">
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