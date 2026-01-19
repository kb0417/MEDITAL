<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('doctor.dashboard') }}" 
               style="padding: 0.625rem 1rem; background: rgba(16, 185, 129, 0.08); color: #047857; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; font-size: 0.9375rem;"
               onmouseover="this.style.background='rgba(16, 185, 129, 0.15)'"
               onmouseout="this.style.background='rgba(16, 185, 129, 0.08)'">
                <span>←</span> Retour
            </a>
            <div style="width: 1px; height: 32px; background: rgba(16, 185, 129, 0.2);"></div>
            <div>
                <h2 class="font-bold text-3xl" style="color: #047857; display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 2rem;">📋</span>
                    Ajouter une analyse
                </h2>
                <p class="text-sm mt-1" style="color: #6b7280; font-weight: 500;">
                    Importer un résultat d'analyse au format PDF
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Messages d'erreur --}}
            @if ($errors->any())
                <div class="animate-in" style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; border-radius: 16px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 2px solid #fca5a5; display: flex; align-items: start; gap: 1rem;">
                    <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);">
                        ⚠️
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #991b1b; font-size: 1rem; margin-bottom: 0.5rem;">Erreur lors de l'enregistrement</div>
                        <div style="color: #dc2626; font-size: 0.9375rem;">{{ $errors->first() }}</div>
                    </div>
                </div>
            @endif

            {{-- Carte principale --}}
            <div class="card-modern animate-in" style="padding: 3rem; animation-delay: 0.1s;">

                <div style="text-align: center; margin-bottom: 3rem;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 96px; height: 96px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 24px; margin-bottom: 1.5rem; box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);">
                        <span style="font-size: 3rem;">📄</span>
                    </div>
                    <h3 style="font-size: 2rem; font-weight: 800; color: #1f2937; margin-bottom: 0.75rem;">
                        Nouveau résultat d'analyse
                    </h3>
                    <p style="font-size: 1.125rem; color: #6b7280; font-weight: 500;">
                        Importez le document PDF contenant les résultats médicaux
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('doctor.analyses.store') }}"
                      enctype="multipart/form-data"
                      style="display: flex; flex-direction: column; gap: 2rem;">

                    @csrf
                    
                    {{-- Sélection du patient --}}
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.875rem;">
                            <label style="font-weight: 700; color: #1f2937; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                                <span style="font-size: 1.5rem;">👤</span>
                                Patient concerné
                            </label>
                            <button type="button"
                                    onclick="openPatientModal()"
                                    style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #047857; border-radius: 10px; font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #6ee7b7; transition: all 0.3s ease; cursor: pointer;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.2)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <span>➕</span> Nouveau patient
                            </button>
                        </div>
                        
                        <select name="patient_id"
                                id="patient-select"
                                required
                                class="input-modern"
                                style="appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2310b981%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5rem; padding-right: 3rem;">
                            <option value="">— Choisir un patient —</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->full_name }} — {{ $patient->email }}
                                </option>
                            @endforeach
                        </select>

                        <div style="margin-top: 0.875rem; padding: 1rem; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 12px; border: 1px solid #93c5fd; display: flex; align-items: start; gap: 0.75rem;">
                            <span style="font-size: 1.25rem; flex-shrink: 0;">💡</span>
                            <p style="font-size: 0.875rem; color: #1e40af; font-weight: 500;">
                                Le patient recevra automatiquement un email avec l'ID d'accès pour consulter ses résultats
                            </p>
                        </div>
                    </div>

                    {{-- Zone d'upload --}}
                    <div>
                        <label style="display: block; margin-bottom: 1rem; font-weight: 700; color: #1f2937; font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.5rem;">📎</span>
                            Fichier PDF
                        </label>

                        <div style="position: relative; border: 3px dashed rgba(16, 185, 129, 0.3); border-radius: 20px; padding: 4rem 2rem; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); transition: all 0.3s ease; cursor: pointer;"
                             onmouseover="this.style.background='linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%)'; this.style.borderColor='rgba(16, 185, 129, 0.5)'"
                             onmouseout="this.style.background='linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)'; this.style.borderColor='rgba(16, 185, 129, 0.3)'">
                            
                            <input type="file"
                                   name="pdf"
                                   required
                                   accept=".pdf"
                                   id="pdf-input"
                                   style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10;">
                            
                            <div style="text-align: center; pointer-events: none;" id="upload-placeholder">
                                <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background: white; border-radius: 20px; margin-bottom: 1.5rem; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);">
                                    <span style="font-size: 3rem;">📤</span>
                                </div>
                                <p style="font-weight: 700; color: #047857; margin-bottom: 0.5rem; font-size: 1.25rem;">
                                    Cliquez pour choisir un fichier
                                </p>
                                <p style="font-size: 0.9375rem; color: #6b7280; font-weight: 500;">
                                    Format accepté : <strong style="color: #10b981;">PDF uniquement</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div style="display: flex; gap: 1rem; padding-top: 1rem;">
                        <button type="submit" class="btn-primary-modern" style="flex: 1; padding: 1.125rem 2rem; font-size: 1.125rem; justify-content: center;">
                            <span style="font-size: 1.5rem;">✓</span>
                            Enregistrer l'analyse
                        </button>
                        
                        <a href="{{ route('doctor.dashboard') }}" 
                           class="btn-secondary-modern" style="padding: 1.125rem 2rem; font-size: 1.125rem;">
                            <span style="font-size: 1.25rem;">✕</span>
                            Annuler
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

    {{-- ========================================
         MODAL CRÉER PATIENT
         ======================================== --}}
    <div id="patient-modal" class="modal-overlay" style="display: none;">
        <div class="modal-container" style="max-width: 600px;" onclick="event.stopPropagation()">
            
            {{-- Header --}}
            <div class="modal-header">
                <h3 class="modal-title">
                    <span style="font-size: 1.75rem;">👤</span>
                    Nouveau patient
                </h3>
                <button type="button" class="modal-close" onclick="closePatientModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form id="patient-form" onsubmit="handlePatientSubmit(event)" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <label style="display: block; margin-bottom: 0.625rem; font-weight: 700; color: #1f2937; font-size: 0.9375rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span>📝</span>
                            Nom complet
                            <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text"
                               name="full_name"
                               id="patient-full-name"
                               class="input-modern"
                               placeholder="Ex: Sarah Benali"
                               required>
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.625rem; font-weight: 700; color: #1f2937; font-size: 0.9375rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span>📧</span>
                            Adresse email
                            <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               id="patient-email"
                               class="input-modern"
                               placeholder="Ex: sarah.benali@email.com"
                               required>
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.625rem; font-weight: 700; color: #1f2937; font-size: 0.9375rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span>📱</span>
                            Téléphone
                            <span style="font-size: 0.8125rem; color: #9ca3af; font-weight: 500;">(optionnel)</span>
                        </label>
                        <input type="text"
                               name="phone"
                               id="patient-phone"
                               class="input-modern"
                               placeholder="Ex: +212 6XX XX XX XX">
                    </div>

                    <div style="padding: 1.25rem; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 12px; border: 1px solid #6ee7b7;">
                        <div style="display: flex; align-items: start; gap: 0.875rem;">
                            <span style="font-size: 1.25rem; flex-shrink: 0;">💡</span>
                            <p style="font-size: 0.875rem; color: #047857; font-weight: 500;">
                                Après création, le patient sera automatiquement ajouté à la liste et sélectionné
                            </p>
                        </div>
                    </div>

                    <div id="modal-error" style="display: none; padding: 1rem; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 12px; border: 1px solid #fca5a5; color: #dc2626; font-size: 0.875rem; font-weight: 500;">
                    </div>

                </form>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-secondary-modern" onclick="closePatientModal()">
                    <span>✕</span>
                    Annuler
                </button>
                <button type="submit" form="patient-form" class="btn-primary-modern" id="submit-patient-btn">
                    <span>✅</span>
                    Créer le patient
                </button>
            </div>

        </div>
    </div>

    <script>
        // ========================================
        // GESTION DU MODAL
        // ========================================
        function openPatientModal() {
            document.getElementById('patient-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closePatientModal() {
            document.getElementById('patient-modal').style.display = 'none';
            document.body.style.overflow = 'auto';
            document.getElementById('patient-form').reset();
            document.getElementById('modal-error').style.display = 'none';
        }

        // Fermer au clic sur l'overlay
        document.getElementById('patient-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePatientModal();
            }
        });

        // Fermer avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePatientModal();
            }
        });

        // ========================================
        // SOUMISSION AJAX DU FORMULAIRE PATIENT
        // ========================================
        async function handlePatientSubmit(event) {
            event.preventDefault();
            
            const form = event.target;
            const submitBtn = document.getElementById('submit-patient-btn');
            const errorDiv = document.getElementById('modal-error');
            
            // Désactiver le bouton
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
            submitBtn.innerHTML = '<span>⏳</span> Création...';
            
            // Cacher les erreurs
            errorDiv.style.display = 'none';
            
            try {
                const formData = new FormData(form);
                
                const response = await fetch('{{ route("doctor.patients.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // ✅ Ajouter le nouveau patient au select
                    const select = document.getElementById('patient-select');
                    const option = new Option(
                        `${data.patient.full_name} — ${data.patient.email}`,
                        data.patient.id,
                        true,  // defaultSelected
                        true   // selected
                    );
                    select.add(option);
                    
                    // ✅ Afficher notification de succès
                    showSuccessNotification('✅ Patient créé avec succès !');
                    
                    // ✅ Fermer le modal
                    closePatientModal();
                    
                } else {
                    // ❌ Afficher l'erreur
                    errorDiv.textContent = data.message || 'Une erreur est survenue';
                    errorDiv.style.display = 'block';
                }
                
            } catch (error) {
                console.error('Erreur:', error);
                errorDiv.textContent = 'Erreur de connexion au serveur';
                errorDiv.style.display = 'block';
            } finally {
                // Réactiver le bouton
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.innerHTML = '<span>✅</span> Créer le patient';
            }
        }

        // ========================================
        // NOTIFICATION DE SUCCÈS (TOAST)
        // ========================================
        function showSuccessNotification(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 2rem;
                right: 2rem;
                padding: 1.25rem 1.75rem;
                background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
                border: 2px solid #6ee7b7;
                border-radius: 14px;
                color: #047857;
                font-weight: 700;
                font-size: 1rem;
                box-shadow: 0 12px 32px rgba(16, 185, 129, 0.3);
                z-index: 999999;
                animation: slideInRight 0.4s ease, fadeOut 0.4s ease 2.6s;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            `;
            toast.innerHTML = message;
            document.body.appendChild(toast);
            
            setTimeout(() => toast.remove(), 3000);
        }

        // ========================================
        // AFFICHAGE DU FICHIER PDF SÉLECTIONNÉ
        // ========================================
        document.getElementById('pdf-input').addEventListener('change', function(e) {
            const placeholder = document.getElementById('upload-placeholder');
            if (this.files.length > 0) {
                placeholder.innerHTML = `
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background: white; border-radius: 20px; margin-bottom: 1.5rem; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);">
                        <span style="font-size: 3rem;">✓</span>
                    </div>
                    <p style="font-weight: 700; color: #10b981; margin-bottom: 0.5rem; font-size: 1.25rem;">
                        Fichier sélectionné !
                    </p>
                    <p style="font-size: 0.9375rem; color: #047857; font-weight: 600;">
                        ${this.files[0].name}
                    </p>
                    <p style="font-size: 0.8125rem; color: #6b7280; margin-top: 0.5rem;">
                        Cliquez sur "Enregistrer" pour finaliser
                    </p>
                `;
            }
        });

        // ========================================
        // ANIMATIONS CSS
        // ========================================
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes fadeOut {
                from {
                    opacity: 1;
                }
                to {
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</x-app-layout>