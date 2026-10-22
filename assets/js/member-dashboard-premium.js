(()=>{
const icons={
 squares:'<rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="8" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/><rect x="13" y="13" width="8" height="8" rx="1.5"/>',
 badge:'<rect x="4" y="3" width="16" height="18" rx="2"/><circle cx="12" cy="9" r="2.5"/><path d="M8 17c.5-2.7 7.5-2.7 8 0"/>',
 shield:'<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
 user:'<circle cx="12" cy="7.5" r="4"/><path d="M4 21v-1c0-5 16-5 16 0v1"/>',
 wallet:'<rect x="3" y="6" width="18" height="15" rx="2"/><path d="M3 9V5a2 2 0 0 1 2-2h13"/><path d="M16 14h5"/>',
 calendar:'<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18M8 14h2M14 14h2"/>',
 building:'<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-5h6v5M8 7h1M15 7h1M8 12h1M15 12h1"/>',
 gear:'<path d="M10 2h4l1 3 2 1 3-1 2 4-2 2v2l2 2-2 4-3-1-2 1-1 3h-4l-1-3-2-1-3 1-2-4 2-2v-2L2 9l2-4 3 1 2-1Z"/><circle cx="12" cy="12" r="3"/>',
 arrowleft:'<path d="m12 19-7-7 7-7M5 12h14"/>',
 menu:'<path d="M4 6h16M4 12h16M4 18h16"/>',
 chevron:'<path d="m6 9 6 6 6-6"/>',
 spark:'<path d="m12 2 1.9 6.1L20 10l-6.1 1.9L12 18l-1.9-6.1L4 10l6.1-1.9L12 2Z"/><path d="m20 18 .6 1.4L22 20l-1.4.6L20 22l-.6-1.4L18 20l1.4-.6L20 18Z"/>',
 life:'<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v5M12 16v5M3 12h5M16 12h5"/>',
 award:'<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>'
};
document.querySelectorAll('[data-icon]').forEach(el=>{const p=icons[el.dataset.icon];if(p)el.innerHTML=`<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">${p}</svg>`});
const known=['overview','alumni-id','membership','profile','dues','conference','businesses','scholarships','settings'];
const names={'overview':'Overview','alumni-id':'Alumni ID','membership':'Membership','profile':'My Profile','dues':'Dues & Receipts','conference':'2027 Conference','businesses':'My Businesses','scholarships':'Scholarships','settings':'Account Settings'};
const nav=document.querySelector('#sideNav'),overlay=document.querySelector('#sidebarBackdrop'),toggle=document.querySelector('#menuToggle'),work=document.querySelector('#workarea');
let lastFocused=null;
function closeNav(){nav.classList.remove('is-open');overlay.hidden=true;toggle.setAttribute('aria-expanded','false');if(lastFocused&&document.activeElement?.closest('#sideNav'))lastFocused.focus()}
function openNav(){lastFocused=document.activeElement;nav.classList.add('is-open');overlay.hidden=false;toggle.setAttribute('aria-expanded','true');nav.querySelector('.nav-link.is-active')?.focus()}
function render(name){let nameSafe=known.includes(name)?name:'overview';document.querySelectorAll('[data-view]').forEach(el=>{let active=el.dataset.view===nameSafe;el.classList.toggle('is-visible',active);el.hidden=!active});document.querySelectorAll('[data-route]').forEach(el=>{let active=el.dataset.route===nameSafe;el.classList.toggle('is-active',active);if(active)el.setAttribute('aria-current','page');else el.removeAttribute('aria-current')});document.querySelector('#crumbName').textContent=names[nameSafe];window.scrollTo({top:0,behavior:'instant'});closeNav()}
function go(name){if(!known.includes(name))return;if(location.hash.slice(1)!==name)location.hash=name;else render(name)}
document.querySelectorAll('[data-go]').forEach(el=>el.addEventListener('click',()=>go(el.dataset.go)));
window.addEventListener('hashchange',()=>render(location.hash.slice(1)));render(location.hash.slice(1));
toggle.addEventListener('click',()=>nav.classList.contains('is-open')?closeNav():openNav());overlay.addEventListener('click',closeNav);document.addEventListener('keydown',e=>{if(e.key==='Escape'&&nav.classList.contains('is-open'))closeNav();if(e.key==='Tab'&&nav.classList.contains('is-open')){let focusables=[...nav.querySelectorAll('a,button')].filter(x=>x.getClientRects().length);let first=focusables[0],last=focusables[focusables.length-1];if(e.shiftKey&&document.activeElement===first){e.preventDefault();last.focus()}else if(!e.shiftKey&&document.activeElement===last){e.preventDefault();first.focus()}}});
let toastTimer;const toast=document.querySelector('#toast');function showToast(s){toast.textContent=s;toast.hidden=false;clearTimeout(toastTimer);toastTimer=setTimeout(()=>toast.hidden=true,3600)}
document.querySelector('#copyId')?.addEventListener('click',async()=>{const val=document.querySelector('#card-alumni-id-val')?.textContent?.trim()||document.querySelector('.sample-card-center div span')?.textContent?.trim()||'';try{await navigator.clipboard.writeText(val);showToast('Alumni ID copied: '+val)}catch{showToast('Alumni ID: '+val)}});
document.querySelector('#profileDemo').addEventListener('submit',e=>{e.preventDefault();const f=e.currentTarget;if(!f.reportValidity())return;const vals=new FormData(f);const summary=`PREVIEW ONLY — NOTHING WAS SAVED\nName: ${vals.get('fullName')}\nEmail: ${vals.get('email')}\nProfession: ${vals.get('profession')}\nDirectory privacy: ${vals.get('visibility')}`;const review=document.querySelector('#profileReview');review.textContent=summary;review.hidden=false;review.scrollIntoView({behavior:'smooth',block:'nearest'})});
document.querySelector('#profileDemo').addEventListener('reset',()=>{document.querySelector('#profileReview').hidden=true;showToast('Demo fields reset. Nothing was saved.')});
document.querySelectorAll('[data-demo-action]').forEach(el=>el.addEventListener('click',()=>showToast(el.dataset.demoAction)));
document.querySelectorAll('[data-demo-link]').forEach(el=>el.addEventListener('click',e=>{e.preventDefault();showToast('On WordPress, this link will return to the official public website.')}));
})();
