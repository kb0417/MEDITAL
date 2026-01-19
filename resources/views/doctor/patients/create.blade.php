{{-- resources/views/doctor/patients/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('doctor.analyses.create') }}"
               style="padding: 0.625rem 1rem; background: rgba(16, 185, 129, 0.08); color: #047857; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; font-size: 0.9375rem;"
               onmouseover="this.style.background='rgba(16, 185, 129, 0.15)'"
               onmouseout="this.style.background='rgba(16, 185, 129, 0.08)'">
                <span>←</span> Retour
            </a>
            <div style="width: 1px; height: 32px; background: rgba(16, 185, 129, 0.2);"></div>
            <div>
                <h2 class="font-bold text-3xl" style="color: #047857; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 2rem;">👤</span>
                    Ajouter un patient
                </h2>
                <p class="text-sm mt-1" style="color: #6b7280; font-weight: 500;">
                    Créer un nouveau dossier patient pour l'associer à une analyse
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="animate-in" style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; border-radius: 16px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 2px solid #fca5a5; display: flex; align-items: start; gap: 1rem;">
                    <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);">
                        ⚠️
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #991b1b; font-size: 1rem; margin-bottom: 0.5rem;">Erreur de validation</div>
                        <div style="color: #dc2626; font-size: 0.9375rem;">{{ $errors->first() }}</div>
                    </div>
                </div>
            @endif

            {{-- Flash success --}}
            @if(session('success'))
                <div class="animate-in" style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; border-radius: 16px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border: 2px solid #6ee7b7; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                        ✅
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #047857; font-size: 1rem; margin-bottom: 0.25rem;">Succès !</div>
                        <div style="color: #059669; font-size: 0.9375rem;">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <div class="card-modern animate-in" style="padding: 3rem; animation-delay: 0.1s;">
                
                {{-- En-tête du formulaire --}}
                <div style="text-align: center; margin-bottom: 3rem;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 96px; height: 96px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 24px; margin-bottom: 1.5rem; box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3);">
                        <span style="font-size: 3rem;">👤</span>
                    </div>
                    <h3 style="font-size: 2rem; font-weight: 800; color: #1f2937; margin-bottom: 0.75rem;">
                        Nouveau patient
                    </h3>
                    <p style="font-size: 1.125rem; color: #6b7280; font-weight: 500;">
                        Remplissez les informations du patient pour créer son dossier
                    </p>
                </div>

                <form method="POST" action="{{ route('doctor.patients.store') }}" style="display: flex; flex-direction: column; gap: 2rem;">
                    @csrf

                    {{-- Nom complet --}}
                    <div>
                        <label style="display: block; margin-bottom: 0.875rem; font-weight: 700; color: #1f2937; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.5rem;">📝</span>
                            Nom complet
                            <span style="color: #ef4444; margin-left: 0.25rem;">*</span>
                        </label>
                        <input type="text"
                               name="full_name"
                               value="{{ old('full_name') }}"
                               class="input-modern"
                               placeholder="Ex: Sarah Benali"
                               required
                               style="font-size: 1rem;">
                        <p style="margin-top: 0.75rem; font-size: 0.875rem; color: #9ca3af; display: flex; align-items: center; gap: 0.5rem;">
                            <span>💡</span>
                            Saisissez le nom complet tel qu'il apparaît sur les documents officiels
                        </p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label style="display: block; margin-bottom: 0.875rem; font-weight: 700; color: #1f2937; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.5rem;">📧</span>
                            Adresse email
                            <span style="color: #ef4444; margin-left: 0.25rem;">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="input-modern"
                               placeholder="Ex: sarah.benali@email.com"
                               required
                               style="font-size: 1rem;">
                        <div style="margin-top: 0.75rem; padding: 1rem; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 12px; border: 1px solid #93c5fd; display: flex; align-items: start; gap: 0.75rem;">
                            <span style="font-size: 1.25rem; flex-shrink: 0;">📬</span>
                            <p style="font-size: 0.875rem; color: #1e40af; font-weight: 500;">
                                Le patient recevra l'ID d'accès à ses analyses sur cet email
                            </p>
                        </div>
                    </div>

                    {{-- Téléphone --}}
                    <div>
                        <label style="display: block; margin-bottom: 0.875rem; font-weight: 700; color: #1f2937; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.5rem;">📱</span>
                            Numéro de téléphone
                            <span style="font-size: 0.875rem; color: #9ca3af; font-weight: 500; margin-left: 0.5rem;">(optionnel)</span>
                        </label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="input-modern"
                               placeholder="Ex: +212 6XX XX XX XX"
                               style="font-size: 1rem;">
                        <p style="margin-top: 0.75rem; font-size: 0.875rem; color: #9ca3af; display: flex; align-items: center; gap: 0.5rem;">
                            <span>💡</span>
                            Utile pour les notifications SMS (fonctionnalité à venir)
                        </p>
                    </div>

                    {{-- Informations --}}
                    <div style="padding: 1.75rem; border-radius: 16px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border: 2px solid #6ee7b7;">
                        <div style="display: flex; align-items: start; gap: 1.25rem;">
                            <div style="width: 56px; height: 56px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                                ℹ️
                            </div>
                            <div>
                                <p style="font-weight: 700; color: #047857; margin-bottom: 1rem; font-size: 1.125rem;">
                                    À savoir
                                </p>
                                <ul style="display: flex; flex-direction: column; gap: 0.75rem; color: #059669; font-size: 0.9375rem;">
                                    <li style="display: flex; align-items: start; gap: 0.75rem;">
                                        <span style="color: #10b981; font-weight: 700; font-size: 1.25rem; flex-shrink: 0;">✓</span>
                                        <span>Après création, ce patient apparaîtra dans la liste de sélection lors de l'ajout d'une analyse</span>
                                    </li>
                                    <li style="display: flex; align-items: start; gap: 0.75rem;">
                                        <span style="color: #10b981; font-weight: 700; font-size: 1.25rem; flex-shrink: 0;">✓</span>
                                        <span>Les données du patient sont stockées de manière sécurisée et confidentielle</span>
                                    </li>
                                    <li style="display: flex; align-items: start; gap: 0.75rem;">
                                        <span style="color: #10b981; font-weight: 700; font-size: 1.25rem; flex-shrink: 0;">✓</span>
                                        <span>Vous pourrez gérer et modifier ces informations ultérieurement</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div style="display: flex; gap: 1rem; padding-top: 1rem;">
                        <button type="submit" class="btn-primary-modern" style="flex: 1; padding: 1.125rem 2rem; font-size: 1.125rem; justify-content: center;">
                            <span style="font-size: 1.5rem;">✅</span>
                            Créer le patient
                        </button>

                        <a href="{{ route('doctor.analyses.create') }}" class="btn-secondary-modern" style="padding: 1.125rem 2rem; font-size: 1.125rem;">
                            <span style="font-size: 1.25rem;">✕</span>
                            Annuler
                        </a>
                    </div>

                </form>
            </div>

            {{-- Info box --}}
            <div class="card-modern animate-in" style="padding: 2rem; margin-top: 2rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 2px solid #fcd34d; animation-delay: 0.2s;">
                <div style="display: flex; align-items: start; gap: 1.25rem;">
                    <div style="width: 56px; height: 56px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);">
                        🎯
                    </div>
                    <div>
                        <p style="font-weight: 700; color: #92400e; margin-bottom: 1rem; font-size: 1.125rem;">
                            Workflow recommandé
                        </p>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem; color: #78350f; font-size: 0.9375rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #f59e0b; flex-shrink: 0;">1</div>
                                <span style="font-weight: 500;">Créer le dossier patient avec ses informations</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #f59e0b; flex-shrink: 0;">2</div>
                                <span style="font-weight: 500;">Retourner à la page "Ajouter une analyse"</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #f59e0b; flex-shrink: 0;">3</div>
                                <span style="font-weight: 500;">Sélectionner le patient et importer le PDF de l'analyse</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>