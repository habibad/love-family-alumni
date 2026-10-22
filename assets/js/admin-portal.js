/**
 * Love Family Alumni — Admin Portal JavaScript Controller
 * Handles client-side navigation, role simulation, interactive drawers, receipt modal, and toasts.
 */
(function() {
	'use strict';

	const ICONS = {
		dashboard: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>',
		users: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
		'credit-card': '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>',
		gift: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>',
		calendar: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
		bell: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>',
		award: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>',
		folder: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>',
		film: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect><line x1="7" y1="2" x2="7" y2="22"></line><line x1="17" y1="2" x2="17" y2="22"></line><line x1="2" y1="12" x2="22" y2="12"></line><line x1="2" y1="7" x2="7" y2="7"></line><line x1="2" y1="17" x2="7" y2="17"></line><line x1="17" y1="17" x2="22" y2="17"></line><line x1="17" y1="7" x2="22" y2="7"></line></svg>',
		heart: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
		mail: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
		'bar-chart': '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>',
		shield: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
		settings: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>',
	};

	const ROLES_INFO = {
		super_admin: { name: 'Super Administrator', badge: 'Full Access', color: '#AB1640', desc: 'Full System Authority' },
		president: { name: 'President / Zonal President', badge: 'Executive', color: '#0A203A', desc: 'Executive Oversight' },
		general_secretary: { name: 'General Secretary', badge: 'Secretariat', color: '#2563EB', desc: 'Records & Minutes' },
		treasurer: { name: 'Treasurer', badge: 'Finance Desk', color: '#C6933D', desc: 'Disbursements & Accounts' },
		financial_sec: { name: 'Financial Secretary', badge: 'Dues & Receipts', color: '#059669', desc: 'Dues Collection & Verification' },
		communications_pro: { name: 'Communications / PRO', badge: 'Media & PR', color: '#7C3AED', desc: 'News & Announcements' },
		scholarship_admin: { name: 'Scholarship Administrator', badge: 'Akpo Committee', color: '#D97706', desc: 'Scholarship Applications Review' },
		conference_admin: { name: 'Conference Administrator', badge: '2027 Committee', color: '#DC2626', desc: '2027 Conference Logistics' }
	};

	function injectIcons() {
		document.querySelectorAll('[data-icon]').forEach(el => {
			const name = el.getAttribute('data-icon');
			if (ICONS[name]) el.innerHTML = ICONS[name];
		});
	}

	function showToast(msg) {
		const toast = document.getElementById('lfa-admin-toast');
		if (!toast) return;
		toast.textContent = msg;
		toast.classList.add('show');
		clearTimeout(window.__lfaToastTimeout);
		window.__lfaToastTimeout = setTimeout(() => {
			toast.classList.remove('show');
		}, 3800);
	}

	function closeSidebarDrawer() {
		const sidebar = document.getElementById('lfa-admin-sidebar');
		const backdrop = document.getElementById('lfa-admin-backdrop');
		if (sidebar) sidebar.classList.remove('open');
		if (backdrop) backdrop.classList.remove('active');
	}

	function switchView(viewId) {
		const targetPanel = document.getElementById(viewId) || document.getElementById('panel-' + viewId);
		if (!targetPanel) return;

		document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('active'));
		document.querySelectorAll('.lfa-admin-nav-link').forEach(l => l.classList.remove('active'));

		targetPanel.classList.add('active');

		const activeLink = document.querySelector(`.lfa-admin-nav-link[data-view="${viewId}"]`);
		if (activeLink) activeLink.classList.add('active');

		const heading = document.getElementById('topbar-page-heading');
		if (heading && activeLink) {
			const label = activeLink.querySelector('.nav-label');
			if (label) heading.textContent = label.textContent.trim();
		}

		closeSidebarDrawer();
		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	function setupRouting() {
		const handleHash = () => {
			const hash = (window.location.hash || '#overview').replace('#', '').trim();
			switchView(hash || 'overview');
		};

		window.addEventListener('hashchange', handleHash);
		document.querySelectorAll('.lfa-admin-nav-link').forEach(link => {
			link.addEventListener('click', function(e) {
				const view = this.getAttribute('data-view');
				if (view) {
					window.location.hash = '#' + view;
				}
			});
		});

		handleHash();
	}

	function setupDrawer() {
		const toggle = document.getElementById('lfa-admin-drawer-toggle');
		const close = document.getElementById('lfa-admin-drawer-close');
		const backdrop = document.getElementById('lfa-admin-backdrop');
		const sidebar = document.getElementById('lfa-admin-sidebar');

		function openDrawer() {
			if (sidebar) sidebar.classList.add('open');
			if (backdrop) backdrop.classList.add('active');
		}

		function closeDrawer() {
			if (sidebar) sidebar.classList.remove('open');
			if (backdrop) backdrop.classList.remove('active');
		}

		if (toggle) toggle.addEventListener('click', openDrawer);
		if (close) close.addEventListener('click', closeDrawer);
		if (backdrop) backdrop.addEventListener('click', closeDrawer);

		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape') {
				closeDrawer();
				closeDrawers();
				closeModal();
			}
		});

		window.closeSidebarDrawer = closeDrawer;
	}

	function setupRoleSwitcher() {
		const select = document.getElementById('admin-role-select');
		if (!select) return;

		select.addEventListener('change', function() {
			const roleKey = this.value;
			const r = ROLES_INFO[roleKey];
			if (!r) return;

			const nameEl = document.getElementById('role-current-name');
			const badgeEl = document.getElementById('role-current-badge');
			const dotEl = document.getElementById('role-dot');
			const desigEl = document.getElementById('admin-designation');

			if (nameEl) nameEl.textContent = r.name;
			if (badgeEl) {
				badgeEl.textContent = r.badge;
				badgeEl.style.color = r.color;
				badgeEl.style.backgroundColor = r.color + '1A';
			}
			if (dotEl) dotEl.style.backgroundColor = r.color;
			if (desigEl) desigEl.textContent = r.name.split('/')[0].trim();

			showToast('Simulating Role: ' + r.name + ' (' + r.desc + ')');
		});
	}

	function openMemberDrawer(id) {
		const drawer = document.getElementById('member-drawer');
		const backdrop = document.getElementById('lfa-admin-backdrop');
		const content = document.getElementById('drawer-member-content');
		const name = document.getElementById('drawer-member-name');
		if (!drawer || !content) return;

		name.textContent = 'Alumnus Profile Review: ' + id;
		content.innerHTML = `
			<div style="display:flex;flex-direction:column;gap:14px;font-size:0.9rem;">
				<div><strong>Record ID:</strong> <code>${id}</code></div>
				<div><strong>Membership Category:</strong> Individual / Couple Registered</div>
				<div><strong>Annual Dues Status:</strong> <span style="color:#15803D;font-weight:700;">$100 Paid / Valid</span></div>
				<div><strong>Directory Visibility:</strong> Public / Protected Masking Active</div>
				<div><strong>UNIBEN Campus Affiliation:</strong> Verified Alumnus</div>
				<hr style="border:none;border-top:1px solid #E2E8F0;margin:6px 0;">
				<div><strong>Contact Safeguards:</strong> Under LFA Privacy Charter, personal telephone numbers and residential addresses are masked from public search.</div>
			</div>
		`;

		drawer.classList.add('open');
		if (backdrop) backdrop.classList.add('active');
	}

	function openScholarDrawer(id) {
		const drawer = document.getElementById('scholar-drawer');
		const backdrop = document.getElementById('lfa-admin-backdrop');
		const content = document.getElementById('drawer-scholar-content');
		const name = document.getElementById('drawer-scholar-name');
		if (!drawer || !content) return;

		name.textContent = 'Akpo Scholarship File: ' + id;
		content.innerHTML = `
			<div style="display:flex;flex-direction:column;gap:14px;font-size:0.9rem;">
				<div style="background:#FFF9EE;padding:12px;border-left:3px solid #C6933D;border-radius:4px;">
					<strong>Official Program:</strong> Akpo Family Scholarship Endowment (UNIBEN Undergraduate Support)
				</div>
				<div><strong>Application ID:</strong> <code>${id}</code></div>
				<div><strong>Academic Institution:</strong> University of Benin (UNIBEN)</div>
				<div><strong>Grade Point Average:</strong> <strong>4.82 / 5.00 (First Class Honors Division)</strong></div>
				<div><strong>Submitted Documents:</strong>
					<ul style="padding-left:20px;margin-top:6px;">
						<li>Official Verified University Transcript (.PDF)</li>
						<li>Dean of Faculty Recommendation (.PDF)</li>
						<li>Personal Statement of Purpose & Fellowship Leadership (.PDF)</li>
					</ul>
				</div>
				<div><strong>Statement Excerpt:</strong> <em>"Committed to biomedical research into regional health challenges, inspired by the Christian integrity and mentorship nurtured during my years in Love Family fellowship."</em></div>
				<div><strong>Committee Status:</strong> Shortlisted for Final Interview</div>
			</div>
		`;

		drawer.classList.add('open');
		if (backdrop) backdrop.classList.add('active');
	}

	function closeDrawers() {
		document.querySelectorAll('.lfa-admin-drawer').forEach(d => d.classList.remove('open'));
		const backdrop = document.getElementById('lfa-admin-backdrop');
		if (backdrop) backdrop.classList.remove('active');
	}

	function showReceiptModal(receiptId, memberName) {
		const backdrop = document.getElementById('receipt-modal-backdrop');
		const body = document.getElementById('receipt-modal-body');
		if (!backdrop || !body) return;

		body.innerHTML = `
			<div style="border:1px dashed #C6933D;padding:20px;background:#FFFDF9;border-radius:8px;font-family:'DM Sans',sans-serif;">
				<div style="display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #E2E8F0;padding-bottom:12px;margin-bottom:12px;">
					<div>
						<strong style="color:#0A203A;font-size:1rem;display:block;">THE LOVE FAMILY ALUMNI</strong>
						<span style="font-size:0.75rem;color:#AB1640;font-weight:700;">NORTH AMERICA ZONE</span>
					</div>
					<div style="text-align:right;">
						<span style="font-size:0.75rem;color:#64748B;">OFFICIAL RECEIPT</span>
						<strong style="display:block;font-size:0.85rem;color:#0A203A;">${receiptId}</strong>
					</div>
				</div>
				<div style="display:flex;flex-direction:column;gap:8px;font-size:0.88rem;">
					<div><strong>Received From:</strong> ${memberName}</div>
					<div><strong>Purpose:</strong> Annual Membership Dues (Year 2026/2027)</div>
					<div><strong>Amount Paid:</strong> <strong style="color:#15803D;font-size:1.1rem;">$100.00 USD</strong></div>
					<div><strong>Status:</strong> Verified & Settled (No Balance Due)</div>
				</div>
				<p style="font-size:0.72rem;color:#94A3B8;margin-top:14px;border-top:1px solid #EDF2F7;padding-top:8px;">
					This is a simulated digital receipt issued by the Love Family Alumni Secretariat.
				</p>
			</div>
		`;

		backdrop.classList.add('open');
	}

	function closeModal() {
		const backdrop = document.getElementById('receipt-modal-backdrop');
		if (backdrop) backdrop.classList.remove('open');
	}

	function setupMemberSearch() {
		const input = document.getElementById('member-search');
		const table = document.getElementById('members-table');
		if (!input || !table) return;

		input.addEventListener('input', function() {
			const term = this.value.toLowerCase().trim();
			const rows = table.querySelectorAll('tbody tr');
			rows.forEach(row => {
				const text = row.textContent.toLowerCase();
				row.style.display = text.includes(term) ? '' : 'none';
			});
		});
	}

	function setupExports() {
		const btn = document.getElementById('btn-export-members');
		if (btn) {
			btn.addEventListener('click', function() {
				showToast('Exporting simulated members register (CSV)...');
			});
		}
		const refBtn = document.getElementById('btn-demo-refresh');
		if (refBtn) {
			refBtn.addEventListener('click', function() {
				showToast('All administrative modules re-synchronized.');
			});
		}
	}

	// Expose public methods
	window.lfaAdmin = {
		showToast: showToast,
		switchView: switchView,
		openMemberDrawer: openMemberDrawer,
		openScholarDrawer: openScholarDrawer,
		closeDrawers: closeDrawers,
		showReceiptModal: showReceiptModal,
		closeModal: closeModal
	};

	document.addEventListener('DOMContentLoaded', function() {
		injectIcons();
		setupRouting();
		setupDrawer();
		setupRoleSwitcher();
		setupMemberSearch();
		setupExports();
	});

})();
