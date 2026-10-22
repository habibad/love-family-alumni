/**
 * Love Family Alumni — Member Portal & Authentication Interactive Script
 * Phase 02 · Task 01: Complete Static Frontend
 *
 * Handles:
 * - Multi-step registration workflow (Steps 01-04)
 * - Step-by-step and live form validation
 * - Dynamic Step 04 review generation and step jump editing
 * - Conditional Couple Membership spouse details visibility
 * - Password Show/Hide toggle with accessible ARIA
 * - Live password strength and confirmation match indicators
 * - Login form client validation & demo preview triggers
 * - Forgot password email validation & demonstration notice
 * - Zero database writes, zero password persistence, zero fake email dispatch
 */

(function () {
	'use strict';

	// Helper: DOM selector
	const $ = (selector, context = document) => context.querySelector(selector);
	const $$ = (selector, context = document) => Array.from(context.querySelectorAll(selector));

	// Helper: Email format validator regex
	const isValidEmail = (email) => {
		const re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;
		return re.test(String(email).trim());
	};

	// Helper: Clear error state on a field
	const clearFieldError = (inputEl, errorEl) => {
		if (inputEl) {
			inputEl.classList.remove('input-error');
		}
		if (errorEl) {
			errorEl.textContent = '';
			errorEl.classList.remove('show');
		}
	};

	// Helper: Set error state on a field
	const setFieldError = (inputEl, errorEl, message) => {
		if (inputEl) {
			inputEl.classList.add('input-error');
		}
		if (errorEl) {
			errorEl.textContent = message;
			errorEl.classList.add('show');
		}
	};

	/* ==========================================================================
	   1. Password Visibility Toggle (Show / Hide)
	   ========================================================================== */
	function initPasswordToggles() {
		const toggleButtons = $$('.btn-toggle-password');
		toggleButtons.forEach((btn) => {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				const targetId = this.getAttribute('data-target');
				const inputEl = document.getElementById(targetId);
				if (!inputEl) return;

				const isPassword = inputEl.type === 'password';
				inputEl.type = isPassword ? 'text' : 'password';

				this.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
				this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');

				const showIcon = $('.icon-eye-show', this);
				const hideIcon = $('.icon-eye-hide', this);

				if (showIcon && hideIcon) {
					showIcon.style.display = isPassword ? 'none' : 'block';
					hideIcon.style.display = isPassword ? 'block' : 'none';
				}
			});
		});
	}

	/* ==========================================================================
	   2. Screen 01: Member Login Client Validation & Demo Dashboard
	   ========================================================================== */
	function initLoginForm() {
		const loginForm = $('#lfa-login-form');
		if (!loginForm) return;

		const emailInput = $('#login_email');
		const emailError = $('#login_email_error');
		const passwordInput = $('#login_password');
		const passwordError = $('#login_password_error');
		const alertBox = $('#login-alert-box');

		// Live error clearing
		if (emailInput) {
			emailInput.addEventListener('input', () => clearFieldError(emailInput, emailError));
		}
		if (passwordInput) {
			passwordInput.addEventListener('input', () => clearFieldError(passwordInput, passwordError));
		}

		loginForm.addEventListener('submit', function (e) {
			let isValid = true;
			clearFieldError(emailInput, emailError);
			clearFieldError(passwordInput, passwordError);

			if (alertBox) {
				alertBox.style.display = 'none';
				alertBox.className = 'auth-alert-box';
			}

			// Validate Email
			const emailVal = emailInput ? emailInput.value.trim() : '';
			if (!emailVal) {
				setFieldError(emailInput, emailError, 'Please enter your registered email address.');
				isValid = false;
			} else if (!isValidEmail(emailVal)) {
				setFieldError(emailInput, emailError, 'Please enter a valid email address (e.g. member@domain.com).');
				isValid = false;
			}

			// Validate Password
			const passwordVal = passwordInput ? passwordInput.value : '';
			if (!passwordVal) {
				setFieldError(passwordInput, passwordError, 'Please enter your account password.');
				isValid = false;
			}

			if (!isValid) {
				e.preventDefault();
				const firstError = $('.input-error', loginForm);
				if (firstError) firstError.focus();
				return;
			}

			const submitBtn = $('#btn-login-submit');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.innerHTML = '<span>Signing In...</span>';
			}
		});

		// Demo Dashboard Modal Triggers
		const demoDashBtn = $('#btn-demo-dashboard');
		const dashModal = $('#demo-dashboard-modal');
		const closeDashBtn = $('#modal-close-btn');
		const dismissDashBtn = $('#modal-dismiss-btn');

		const openDashModal = () => {
			if (dashModal) {
				dashModal.style.display = 'flex';
				document.body.style.overflow = 'hidden';
			}
		};

		const closeDashModal = () => {
			if (dashModal) {
				dashModal.style.display = 'none';
				document.body.style.overflow = '';
			}
		};

		if (demoDashBtn) demoDashBtn.addEventListener('click', openDashModal);
		if (closeDashBtn) closeDashBtn.addEventListener('click', closeDashModal);
		if (dismissDashBtn) dismissDashBtn.addEventListener('click', closeDashModal);

		if (dashModal) {
			dashModal.addEventListener('click', (e) => {
				if (e.target === dashModal) closeDashModal();
			});
		}
	}

	/* ==========================================================================
	   3. Screen 02: Multi-Step Registration Workflow
	   ========================================================================== */
	function initRegistrationForm() {
		const regForm = $('#lfa-registration-form');
		if (!regForm) return;

		let currentStep = 1;
		const totalSteps = 4;
		const maxVisitedStep = { value: 1 };

		// Stepper elements
		const stepperItems = $$('.stepper-item');
		const stepPanels = $$('.registration-step-content');
		const alertBox = $('#register-alert-box');

		// Password strength & live match elements
		const regPassInput = $('#reg_password');
		const regConfirmInput = $('#reg_confirmpassword');
		const passMeterBar = $('#reg-password-meter');

		// Live Password Strength Calculation
		if (regPassInput && passMeterBar) {
			regPassInput.addEventListener('input', function () {
				const val = this.value;
				passMeterBar.className = 'password-meter-bar';

				if (val.length === 0) {
					passMeterBar.style.width = '0%';
					return;
				}

				let score = 0;
				if (val.length >= 8) score++;
				if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
				if (/[0-9]/.test(val) || /[^A-Za-z0-9]/.test(val)) score++;

				if (score <= 1) {
					passMeterBar.classList.add('meter-weak');
				} else if (score === 2) {
					passMeterBar.classList.add('meter-medium');
				} else {
					passMeterBar.classList.add('meter-strong');
				}
			});
		}

		// Live password match check
		if (regConfirmInput && regPassInput) {
			regConfirmInput.addEventListener('input', function () {
				const confirmError = $('#reg_confirmpassword_error');
				if (this.value && this.value !== regPassInput.value) {
					setFieldError(regConfirmInput, confirmError, 'Passwords do not match.');
				} else {
					clearFieldError(regConfirmInput, confirmError);
				}
			});
		}

		// Conditional Couple Membership Handler
		const tierRadios = $$('input[name="membership_tier"]');
		const spouseSection = $('#spouse-details-section');
		const spouseNameInput = $('#reg_spouse_name');
		const spouseNameError = $('#reg_spouse_name_error');

		function updateSpouseVisibility() {
			const selectedTier = $('input[name="membership_tier"]:checked');
			const isCouple = selectedTier && selectedTier.value === 'couple';

			if (spouseSection) {
				spouseSection.style.display = isCouple ? 'block' : 'none';
			}
			if (!isCouple && spouseNameInput) {
				clearFieldError(spouseNameInput, spouseNameError);
			}
		}

		tierRadios.forEach((radio) => {
			radio.addEventListener('change', updateSpouseVisibility);
		});
		updateSpouseVisibility();

		// Step Validation Functions
		function validateStep(stepNum) {
			let isStepValid = true;

			if (stepNum === 1) {
				// Step 1: Personal Details
				const nameInput = $('#reg_fullname');
				const nameError = $('#reg_fullname_error');
				const emailInput = $('#reg_email');
				const emailError = $('#reg_email_error');
				const phoneInput = $('#reg_phone');
				const phoneError = $('#reg_phone_error');
				const countryInput = $('#reg_country');
				const countryError = $('#reg_country_error');
				const citystateInput = $('#reg_citystate');
				const citystateError = $('#reg_citystate_error');
				const passInput = $('#reg_password');
				const passError = $('#reg_password_error');
				const confirmInput = $('#reg_confirmpassword');
				const confirmError = $('#reg_confirmpassword_error');

				// Name
				if (!nameInput.value.trim() || nameInput.value.trim().length < 3) {
					setFieldError(nameInput, nameError, 'Please enter your full legal or professional name.');
					isStepValid = false;
				} else {
					clearFieldError(nameInput, nameError);
				}

				// Email
				if (!emailInput.value.trim()) {
					setFieldError(emailInput, emailError, 'Please enter your email address.');
					isStepValid = false;
				} else if (!isValidEmail(emailInput.value.trim())) {
					setFieldError(emailInput, emailError, 'Please enter a valid email format.');
					isStepValid = false;
				} else {
					clearFieldError(emailInput, emailError);
				}

				// Phone
				if (!phoneInput.value.trim() || phoneInput.value.trim().length < 7) {
					setFieldError(phoneInput, phoneError, 'Please provide a contact phone number.');
					isStepValid = false;
				} else {
					clearFieldError(phoneInput, phoneError);
				}

				// Country
				if (!countryInput.value) {
					setFieldError(countryInput, countryError, 'Please select your country of residence.');
					isStepValid = false;
				} else {
					clearFieldError(countryInput, countryError);
				}

				// City / State
				if (!citystateInput.value.trim()) {
					setFieldError(citystateInput, citystateError, 'Please enter your city and state or province.');
					isStepValid = false;
				} else {
					clearFieldError(citystateInput, citystateError);
				}

				// Password
				if (!passInput.value || passInput.value.length < 12) {
					setFieldError(passInput, passError, 'Password must be at least 12 characters.');
					isStepValid = false;
				} else {
					clearFieldError(passInput, passError);
				}

				// Confirm Password
				if (!confirmInput.value) {
					setFieldError(confirmInput, confirmError, 'Please confirm your password.');
					isStepValid = false;
				} else if (confirmInput.value !== passInput.value) {
					setFieldError(confirmInput, confirmError, 'Passwords do not match.');
					isStepValid = false;
				} else {
					clearFieldError(confirmInput, confirmError);
				}
			} else if (stepNum === 2) {
				// Step 2: Alumni Information
				const affilInput = $('#reg_affiliation');
				const affilError = $('#reg_affiliation_error');
				const profInput = $('#reg_profession');
				const profError = $('#reg_profession_error');

				if (!affilInput.value) {
					setFieldError(affilInput, affilError, 'Please choose your alumni connection or affiliation.');
					isStepValid = false;
				} else {
					clearFieldError(affilInput, affilError);
				}

				if (!profInput.value) {
					setFieldError(profInput, profError, 'Please select your professional field.');
					isStepValid = false;
				} else {
					clearFieldError(profInput, profError);
				}
			} else if (stepNum === 3) {
				// Step 3: Membership Category & Spouse validation
				const selectedTier = $('input[name="membership_tier"]:checked');
				if (selectedTier && selectedTier.value === 'couple') {
					if (!spouseNameInput.value.trim()) {
						setFieldError(spouseNameInput, spouseNameError, 'Please provide your spouse or partner\'s full name.');
						isStepValid = false;
					} else {
						clearFieldError(spouseNameInput, spouseNameError);
					}
				}
			} else if (stepNum === 4) {
				// Step 4: Consent Checkbox
				const consentCheckbox = $('#reg_consent');
				const consentError = $('#reg_consent_error');
				const consentBlock = $('#group-reg-consent');

				if (!consentCheckbox.checked) {
					if (consentError) {
						consentError.textContent = 'Please confirm agreement with the membership terms to preview.';
						consentError.classList.add('show');
					}
					if (consentBlock) consentBlock.classList.add('consent-error');
					isStepValid = false;
				} else {
					if (consentError) consentError.classList.remove('show');
					if (consentBlock) consentBlock.classList.remove('consent-error');
				}
			}

			if (!isStepValid) {
				const currentPanel = $(`#step-panel-${stepNum}`);
				const firstError = $('.input-error', currentPanel) || $('.form-error-msg.show', currentPanel);
				if (firstError) {
					firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
					if (typeof firstError.focus === 'function') firstError.focus();
				}
			}

			return isStepValid;
		}

		// Step Navigation Switcher
		function goToStep(targetStep) {
			if (targetStep < 1 || targetStep > totalSteps) return;

			// Update Stepper List UI
			stepperItems.forEach((item, index) => {
				const stepIndex = index + 1;
				const btn = $('.stepper-btn', item);
				item.classList.remove('step-active');

				if (stepIndex < targetStep) {
					item.classList.add('step-completed');
					if (btn) btn.setAttribute('aria-current', 'false');
				} else if (stepIndex === targetStep) {
					item.classList.add('step-active');
					item.classList.remove('step-completed');
					if (btn) btn.setAttribute('aria-current', 'step');
				} else {
					item.classList.remove('step-completed');
					if (btn) btn.setAttribute('aria-current', 'false');
				}
			});

			// Hide all panels, reveal target panel
			stepPanels.forEach((panel) => {
				const panelStep = parseInt(panel.getAttribute('data-step'), 10);
				panel.style.display = panelStep === targetStep ? 'block' : 'none';
			});

			currentStep = targetStep;
			if (targetStep > maxVisitedStep.value) {
				maxVisitedStep.value = targetStep;
			}

			// If moving to Step 4, compile live review details
			if (targetStep === 4) {
				populateReviewSummary();
			}

			// Scroll into view gently
			const card = $('.register-form-card');
			if (card) {
				card.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		}

		// Dynamic Step 04 Review Generator
		function populateReviewSummary() {
			// Section 1: Personal
			const nameVal = $('#reg_fullname') ? $('#reg_fullname').value.trim() : '';
			const emailVal = $('#reg_email') ? $('#reg_email').value.trim() : '';
			const phoneVal = $('#reg_phone') ? $('#reg_phone').value.trim() : '';
			const countryVal = $('#reg_country') ? $('#reg_country').value : '';
			const cityVal = $('#reg_citystate') ? $('#reg_citystate').value.trim() : '';

			const sumName = $('#sum-name');
			const sumEmail = $('#sum-email');
			const sumPhone = $('#sum-phone');
			const sumLocation = $('#sum-location');

			if (sumName) sumName.textContent = nameVal || 'Not provided';
			if (sumEmail) sumEmail.textContent = emailVal || 'Not provided';
			if (sumPhone) sumPhone.textContent = phoneVal || 'Not provided';
			if (sumLocation) sumLocation.textContent = [cityVal, countryVal].filter(Boolean).join(', ') || 'Not provided';

			// Section 2: Alumni
			const affilVal = $('#reg_affiliation') ? $('#reg_affiliation').value : '';
			const batchVal = $('#reg_batch') ? $('#reg_batch').value : '';
			const profVal = $('#reg_profession') ? $('#reg_profession').value : '';
			const employerVal = $('#reg_employer') ? $('#reg_employer').value.trim() : '';
			const isBizOwner = $('input[name="is_business_owner"]:checked');
			const introVal = $('#reg_intro') ? $('#reg_intro').value.trim() : '';

			const sumAffil = $('#sum-affiliation');
			const sumBatch = $('#sum-batch');
			const sumProf = $('#sum-profession');
			const sumEmployer = $('#sum-employer');
			const sumBiz = $('#sum-business');
			const sumIntro = $('#sum-intro');
			const sumRowIntro = $('#sum-row-intro');

			if (sumAffil) sumAffil.textContent = affilVal || 'Not selected';
			if (sumBatch) sumBatch.textContent = batchVal || 'Not specified';
			if (sumProf) sumProf.textContent = profVal || 'Not selected';
			if (sumEmployer) sumEmployer.textContent = employerVal || 'Self-Employed / Independent';
			if (sumBiz) sumBiz.textContent = isBizOwner && isBizOwner.value === 'yes' ? 'Yes, Business Owner (Eligible for Directory Listing)' : 'No, General Professional Member';
			
			if (introVal) {
				if (sumIntro) sumIntro.textContent = introVal;
				if (sumRowIntro) sumRowIntro.style.display = 'flex';
			} else {
				if (sumRowIntro) sumRowIntro.style.display = 'none';
			}

			// Section 3: Membership & Privacy
			const selectedTier = $('input[name="membership_tier"]:checked');
			const isCouple = selectedTier && selectedTier.value === 'couple';
			const sumTier = $('#sum-tier');
			const sumSpouse = $('#sum-spouse');
			const sumRowSpouse = $('#sum-row-spouse');
			const sumDues = $('#sum-dues');

			if (sumTier) sumTier.textContent = isCouple ? 'Couple Membership' : 'Individual Membership';

			if (isCouple) {
				const spName = $('#reg_spouse_name') ? $('#reg_spouse_name').value.trim() : '';
				const spEmail = $('#reg_spouse_email') ? $('#reg_spouse_email').value.trim() : '';
				const spAffil = $('#reg_spouse_affiliation') ? $('#reg_spouse_affiliation').value : '';
				
				let spouseDetails = spName;
				if (spAffil) spouseDetails += ` (${spAffil})`;
				if (spEmail) spouseDetails += ` · ${spEmail}`;

				if (sumSpouse) sumSpouse.textContent = spouseDetails || 'None provided';
				if (sumRowSpouse) sumRowSpouse.style.display = 'flex';
				if (sumDues) sumDues.textContent = 'Couple dues schedule pending Zonal Executive Council ratification (No payment charged today)';
			} else {
				if (sumRowSpouse) sumRowSpouse.style.display = 'none';
				if (sumDues) sumDues.textContent = '$100 Annual Dues requirement (No payment charged during preview)';
			}

			// Privacy
			const privacyOpt = $('input[name="directory_privacy"]:checked');
			const sumPrivacy = $('#sum-privacy');
			let privacyLabel = 'Members Only (Recommended)';
			if (privacyOpt) {
				if (privacyOpt.value === 'public') privacyLabel = 'Public Alumni Directory';
				if (privacyOpt.value === 'private') privacyLabel = 'Strictly Private (Executive Council Only)';
			}
			if (sumPrivacy) sumPrivacy.textContent = privacyLabel;
		}

		// Next Step Buttons
		$$('.btn-step-next').forEach((btn) => {
			btn.addEventListener('click', function () {
				const nextStep = parseInt(this.getAttribute('data-next'), 10);
				const stepToValidate = nextStep - 1;

				if (validateStep(stepToValidate)) {
					goToStep(nextStep);
				}
			});
		});

		// Prev Step Buttons
		$$('.btn-step-prev').forEach((btn) => {
			btn.addEventListener('click', function () {
				const prevStep = parseInt(this.getAttribute('data-prev'), 10);
				goToStep(prevStep);
			});
		});

		// Review Step "Edit" Jump Buttons
		$$('.btn-review-edit').forEach((btn) => {
			btn.addEventListener('click', function () {
				const targetStep = parseInt(this.getAttribute('data-target-step'), 10);
				goToStep(targetStep);
			});
		});

		// Stepper Clickable Headers (only for already visited steps)
		stepperItems.forEach((item) => {
			const btn = $('.stepper-btn', item);
			if (btn) {
				btn.addEventListener('click', function () {
					const clickedStep = parseInt(item.getAttribute('data-step'), 10);
					if (clickedStep <= maxVisitedStep.value) {
						goToStep(clickedStep);
					}
				});
			}
		});

		// Consent Checkbox Error Clearing
		const consentBox = $('#reg_consent');
		if (consentBox) {
			consentBox.addEventListener('change', function () {
				const consentError = $('#reg_consent_error');
				const consentBlock = $('#group-reg-consent');
				if (this.checked) {
					if (consentError) consentError.classList.remove('show');
					if (consentBlock) consentBlock.classList.remove('consent-error');
				}
			});
		}

		// Final Submit: "Review Registration Preview"
		const submitPreviewBtn = $('#btn-reg-preview-submit');
		const successModal = $('#reg-success-modal');
		const closeSuccessBtn = $('#reg-modal-close-btn');
		const dismissSuccessBtn = $('#reg-modal-dismiss-btn');

		const openSuccessModal = () => {
			if (successModal) {
				successModal.style.display = 'flex';
				document.body.style.overflow = 'hidden';
			}
		};

		const closeSuccessModal = () => {
			if (successModal) {
				successModal.style.display = 'none';
				document.body.style.overflow = '';
			}
		};

		if (submitPreviewBtn) {
			submitPreviewBtn.addEventListener('click', function (e) {
				if (!validateStep(4)) {
					e.preventDefault();
				} else {
					submitPreviewBtn.disabled = true;
					submitPreviewBtn.innerHTML = '<span>Submitting Registration...</span>';
					regForm.submit();
				}
			});
		}

		if (closeSuccessBtn) closeSuccessBtn.addEventListener('click', closeSuccessModal);
		if (dismissSuccessBtn) dismissSuccessBtn.addEventListener('click', closeSuccessModal);

		if (successModal) {
			successModal.addEventListener('click', (e) => {
				if (e.target === successModal) closeSuccessModal();
			});
		}
	}

	/* ==========================================================================
	   4. Screen 03: Password Recovery Client Validation
	   ========================================================================== */
	function initForgotPasswordForm() {
		const forgotForm = $('#lfa-forgot-form');
		if (!forgotForm) return;

		const emailInput = $('#forgot_email');
		const emailError = $('#forgot_email_error');
		const alertBox = $('#forgot-alert-box');

		if (emailInput) {
			emailInput.addEventListener('input', () => clearFieldError(emailInput, emailError));
		}

		forgotForm.addEventListener('submit', function (e) {
			clearFieldError(emailInput, emailError);

			if (alertBox) {
				alertBox.style.display = 'none';
				alertBox.className = 'auth-alert-box';
			}

			const emailVal = emailInput ? emailInput.value.trim() : '';
			if (!emailVal) {
				e.preventDefault();
				setFieldError(emailInput, emailError, 'Please enter your registered alumni email address.');
				if (emailInput) emailInput.focus();
				return;
			}

			if (!isValidEmail(emailVal)) {
				e.preventDefault();
				setFieldError(emailInput, emailError, 'Please enter a valid email address.');
				if (emailInput) emailInput.focus();
				return;
			}

			const submitBtn = $('#btn-forgot-submit');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.innerHTML = '<span>Sending Request...</span>';
			}
		});
	}

	// Helper: Escape HTML to avoid XSS in dynamic demo output
	function escapeHtml(str) {
		const div = document.createElement('div');
		div.textContent = str;
		return div.innerHTML;
	}

	// Keyboard Listener for ESC key on modals
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			const openModals = $$('.auth-modal-backdrop');
			openModals.forEach((m) => {
				if (m.style.display === 'flex') {
					m.style.display = 'none';
					document.body.style.overflow = '';
				}
			});
		}
	});

	// URL Query Parameters Demonstration Helper (for client review & QA)
	function initDemoUrlTriggers() {
		const params = new URLSearchParams(window.location.search);

		// Login Demo Triggers
		if (params.get('demo') === 'dashboard') {
			const modal = $('#demo-dashboard-modal');
			if (modal) modal.style.display = 'flex';
		}
		if (params.get('test') === 'error') {
			const submitBtn = $('#btn-login-submit');
			if (submitBtn) submitBtn.click();
		}

		// Registration Step Triggers (?step=2, ?step=3, ?step=4)
		const stepParam = parseInt(params.get('step'), 10);
		if (stepParam && stepParam >= 1 && stepParam <= 4) {
			const nameInput = $('#reg_fullname');
			const emailInput = $('#reg_email');
			const phoneInput = $('#reg_phone');
			const countryInput = $('#reg_country');
			const citystateInput = $('#reg_citystate');
			const passInput = $('#reg_password');
			const confirmInput = $('#reg_confirmpassword');

			if (nameInput && !nameInput.value) nameInput.value = 'Dr. Emmanuel Osagie';
			if (emailInput && !emailInput.value) emailInput.value = 'emmanuel.osagie@lovefamilyalumni.org';
			if (phoneInput && !phoneInput.value) phoneInput.value = '+1 (832) 555-0192';
			if (countryInput && !countryInput.value) countryInput.value = 'United States';
			if (citystateInput && !citystateInput.value) citystateInput.value = 'Houston, Texas';
			if (passInput && !passInput.value) passInput.value = 'Alumni2026!Secure';
			if (confirmInput && !confirmInput.value) confirmInput.value = 'Alumni2026!Secure';

			const affilInput = $('#reg_affiliation');
			const batchInput = $('#reg_batch');
			const profInput = $('#reg_profession');
			const employerInput = $('#reg_employer');
			const bizInput = $('#business_owner_yes');
			const introInput = $('#reg_intro');

			if (affilInput && !affilInput.value) affilInput.value = 'Love Family / UNIBEN Alumnus / Alumna';
			if (batchInput && !batchInput.value) batchInput.value = 'Class of 2008';
			if (profInput && !profInput.value) profInput.value = 'Healthcare & Medicine';
			if (employerInput && !employerInput.value) employerInput.value = 'Memorial Hermann Health System';
			if (bizInput && params.get('biz') === '1') bizInput.checked = true;
			if (introInput && !introInput.value) introInput.value = 'Grateful for fellowship roots in Benin City. Passionate about diaspora healthcare initiatives and youth mentoring.';

			if (params.get('tier') === 'couple') {
				const coupleRadio = $('#tier_couple');
				if (coupleRadio) {
					coupleRadio.checked = true;
					coupleRadio.dispatchEvent(new Event('change'));
				}
				const spName = $('#reg_spouse_name');
				const spEmail = $('#reg_spouse_email');
				const spAffil = $('#reg_spouse_affiliation');
				if (spName && !spName.value) spName.value = 'Mrs. Grace Osagie';
				if (spEmail && !spEmail.value) spEmail.value = 'grace.osagie@example.com';
				if (spAffil && !spAffil.value) spAffil.value = 'Also Love Family / UNIBEN Alumnus/Alumna';
			}

			if (params.get('privacy')) {
				const pRadio = $(`#privacy_${params.get('privacy')}`);
				if (pRadio) pRadio.checked = true;
			}

			// Step sequentially through validation
			for (let s = 1; s < stepParam; s++) {
				const btn = $(`[data-next="${s + 1}"]`);
				if (btn) btn.click();
			}

			if (params.get('modal') === 'preview') {
				const consent = $('#reg_consent');
				if (consent) consent.checked = true;
				const previewBtn = $('#btn-reg-preview-submit');
				if (previewBtn) previewBtn.click();
			}
		}

		// Forgot Password Triggers
		if (params.get('forgot_test') === 'success') {
			const email = $('#forgot_email');
			if (email) email.value = 'alumnus@lovefamilyalumni.org';
			const btn = $('#btn-forgot-submit');
			if (btn) btn.click();
		}
		if (params.get('forgot_test') === 'error') {
			const btn = $('#btn-forgot-submit');
			if (btn) btn.click();
		}
	}

	// Initialize on DOMContentLoaded
	document.addEventListener('DOMContentLoaded', function () {
		initPasswordToggles();
		initLoginForm();
		initRegistrationForm();
		initForgotPasswordForm();
		initDemoUrlTriggers();
	});
})();
