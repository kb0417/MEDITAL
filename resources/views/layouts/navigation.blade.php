<nav x-data="{ open: false }" class="medical-navbar">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <!-- Logo Medical -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="medical-logo">
                        <div class="medical-logo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 3H11V11H3V13H11V21H13V13H21V11H13V3Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="medical-logo-text">MediCare</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link-modern {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="nav-icon">🏥</span>
                            <span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('admin.doctors') }}" 
                           class="nav-link-modern {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
                            <span class="nav-icon">👨‍⚕️</span>
                            <span>Médecins</span>
                        </a>
                    @endif

                    @if(auth()->user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" 
                           class="nav-link-modern {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                            <span class="nav-icon">🏥</span>
                            <span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('doctor.patients.index') }}"
                        class="nav-link-modern {{ request()->routeIs('doctor.patients*') ? 'active' : '' }}">
                            <span class="nav-icon">👥</span>
                            <span>Patients</span>
                        </a>
                        <a href="{{ route('doctor.analyses.index') }}"
                        class="nav-link-modern {{ request()->routeIs('doctor.analyses*') ? 'active' : '' }}">
                            <span class="nav-icon">🧪</span>
                            <span>Analyses</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                
                <!-- Notifications Badge -->
                <button class="notification-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span class="notification-badge">3</span>
                </button>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="user-menu-trigger">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">
                                    @if(auth()->user()->role === 'admin')
                                        Administrateur
                                    @elseif(auth()->user()->role === 'doctor')
                                        Médecin
                                    @else
                                        Utilisateur
                                    @endif
                                </div>
                            </div>
                            <svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="dropdown-modern">
                            <div class="dropdown-header">
                                <div class="dropdown-user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="dropdown-user-name">{{ Auth::user()->name }}</div>
                                    <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <span>Mon profil</span>
                            </a>
                            
                            <a href="#" class="dropdown-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M12 1v6m0 6v6m8.66-9.66l-5.2 3m-6.93 4l-5.2 3m13.13-13.13l-5.2 3m-6.93 4l-5.2 3"/>
                                </svg>
                                <span>Paramètres</span>
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item dropdown-item-danger">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16 17 21 12 16 7"/>
                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                    </svg>
                                    <span>Se déconnecter</span>
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="mobile-menu-btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mobile-nav">
        <div class="pt-2 pb-3 space-y-1 px-3">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" 
                   class="mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏥</span>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{ route('admin.doctors') }}" 
                   class="mobile-nav-link {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
                    <span class="nav-icon">👨‍⚕️</span>
                    <span>Médecins</span>
                </a>
            @endif

            @if(auth()->user()->role === 'doctor')
                <a href="{{ route('doctor.dashboard') }}" 
                   class="mobile-nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏥</span>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{ route('doctor.patients.index') }}"
                 class="mobile-nav-link {{ request()->routeIs('doctor.patients*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span>
                    <span>Patients</span>
                </a>
                <a href="{{ route('doctor.analyses.index') }}"
                 class="mobile-nav-link {{ request()->routeIs('doctor.analyses*') ? 'active' : '' }}">
                    <span class="nav-icon">🧪</span>
                    <span>Analyses</span>
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-100">
            <div class="px-4 mb-3">
                <div class="user-avatar-mobile">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="font-semibold text-base text-gray-900 mt-2">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-3">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Mon profil</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-nav-link w-full text-left text-red-600">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        <span>Se déconnecter</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
/* Navbar moderne medical */
.medical-navbar {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(16, 185, 129, 0.1);
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.08);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Logo */
.medical-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.medical-logo:hover {
    transform: scale(1.05);
}

.medical-logo-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.medical-logo-text {
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #047857 0%, #10b981 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Navigation Links */
.nav-link-modern {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1.125rem;
    border-radius: 10px;
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9375rem;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link-modern:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #047857;
}

.nav-link-modern.active {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.nav-link-modern .nav-icon {
    font-size: 1.125rem;
}

/* Notifications */
.notification-btn {
    position: relative;
    padding: 0.625rem;
    border-radius: 10px;
    color: #6b7280;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-btn:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #047857;
}

.notification-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 0.625rem;
    font-weight: 700;
    padding: 0.125rem 0.375rem;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

/* User Menu */
.user-menu-trigger {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0.75rem;
    border-radius: 12px;
    background: transparent;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-menu-trigger:hover {
    background: rgba(16, 185, 129, 0.05);
    border-color: rgba(16, 185, 129, 0.2);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    border: 2px solid white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.user-info {
    text-align: left;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.9375rem;
    line-height: 1.2;
}

.user-role {
    font-size: 0.75rem;
    color: #6b7280;
}

.dropdown-arrow {
    color: #9ca3af;
    transition: transform 0.3s ease;
}

.user-menu-trigger:hover .dropdown-arrow {
    color: #10b981;
    transform: translateY(2px);
}

/* Dropdown moderne */
.dropdown-modern {
    background: white;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(16, 185, 129, 0.15);
    border: 1px solid rgba(16, 185, 129, 0.1);
    padding: 0.75rem;
    min-width: 260px;
}

.dropdown-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-radius: 12px;
    margin-bottom: 0.5rem;
}

.dropdown-user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1rem;
}

.dropdown-user-name {
    font-weight: 700;
    color: #047857;
    font-size: 0.9375rem;
}

.dropdown-user-email {
    font-size: 0.8125rem;
    color: #6b7280;
}

.dropdown-divider {
    height: 1px;
    background: rgba(16, 185, 129, 0.1);
    margin: 0.5rem 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    color: #374151;
    text-decoration: none;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
}

.dropdown-item:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #047857;
}

.dropdown-item svg {
    color: #9ca3af;
    flex-shrink: 0;
}

.dropdown-item:hover svg {
    color: #10b981;
}

.dropdown-item-danger {
    color: #dc2626;
}

.dropdown-item-danger:hover {
    background: rgba(220, 38, 38, 0.08);
    color: #dc2626;
}

.dropdown-item-danger svg {
    color: #ef4444;
}

/* Mobile Menu */
.mobile-menu-btn {
    display: inline-flex;
    align-items: center;
    justify-center: center;
    padding: 0.5rem;
    border-radius: 10px;
    color: #6b7280;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mobile-menu-btn:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #047857;
}

.mobile-nav {
    background: rgba(255, 255, 255, 0.98);
    border-top: 1px solid rgba(16, 185, 129, 0.1);
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    border-radius: 10px;
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9375rem;
    transition: all 0.2s ease;
}

.mobile-nav-link:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #047857;
}

.mobile-nav-link.active {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.mobile-nav-link svg {
    flex-shrink: 0;
}

.user-avatar-mobile {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}
</style>