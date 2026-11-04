import { renderNavbar } from './navbar.js';

function renderMenu() {
    const nav = document.getElementById('atn-sidebar-nav');
    if (!nav) return;
    nav.innerHTML = `
        <ul style="list-style:none; padding:0; margin:0; font-family:'Inter',sans-serif;">
            <li class="atn-menu-item"><a href="/representante"><i class="fas fa-user-plus"></i> Representante</a></li>
            <li class="atn-menu-item"><a href="/comissao"><i class="fas fa-address-book"></i> Comissão de Faltas</a></li>
            <li class="atn-menu-item"><a href="/monitore"><i class="fas fa-user-circle"></i> Monitore</a></li>
            <li class="atn-menu-item"><a href="/tutore"><i class="fas fa-user"></i> Tutore</a></li>
            <li class="atn-menu-item"><a href="/alune"><i class="fas fa-graduation-cap"></i> Alune</a></li>
            <li class="atn-menu-item"><a href="/disciplina"><i class="fas fa-newspaper"></i> Disciplina</a></li>
            <li class="atn-menu-item"><a href="/sala"><i class="fas fa-university"></i> Sala</a></li>
            <li class="atn-menu-item"><a href="/presenca"><i class="fas fa-calendar"></i> Presença</a></li>
            <li class="atn-menu-item"><a href="/certificado"><i class="fas fa-file-pdf"></i> Certificado</a></li>
            <li class="atn-menu-item"><a href="/relatorio"><i class="fas fa-bar-chart"></i> Relatório</a></li>
            <li class="atn-menu-item logout"><a href="#" onclick="if(window.atnAuth) window.atnAuth.logout(); else window.location.assign('/login'); return false;"><i class="fas fa-power-off"></i> Logout</a></li>
        </ul>
    `;
}

const pageSections = [
    { path: '/home', label: 'Visão geral', icon: 'fa-house' },
    { path: '/alune', label: 'Gestão de alunes', icon: 'fa-graduation-cap' },
    { path: '/comissao', label: 'Controle de faltas', icon: 'fa-address-book' },
    { path: '/disciplina', label: 'Gestão acadêmica', icon: 'fa-book-open' },
    { path: '/monitore', label: 'Gestão de monitores', icon: 'fa-user-circle' },
    { path: '/representante', label: 'Equipe de coordenação', icon: 'fa-user-plus' },
    { path: '/sala', label: 'Gestão de salas', icon: 'fa-university' },
    { path: '/tutore', label: 'Gestão de tutores', icon: 'fa-user' },
    { path: '/presenca', label: 'Controle de presença', icon: 'fa-clipboard-check' },
    { path: '/certificado', label: 'Emissão de certificados', icon: 'fa-award' },
    { path: '/relatorio', label: 'Indicadores de frequência', icon: 'fa-chart-column' }
];

function renderPageEyebrow() {
    const main = document.querySelector('.atn-main');
    if (!main || main.querySelector('.atn-page-eyebrow, .report-eyebrow, .attendance-eyebrow, .certificate-eyebrow')) return;

    const path = window.location.pathname.replace(/\/+$/, '') || '/';
    const section = pageSections.find(item => path === item.path || path.startsWith(`${item.path}/`));
    const heading = main.querySelector('h2, h1');
    if (!section || !heading || !heading.parentElement) return;

    const eyebrow = document.createElement('p');
    eyebrow.className = 'atn-page-eyebrow';
    const icon = document.createElement('i');
    icon.className = `fas ${section.icon}`;
    icon.setAttribute('aria-hidden', 'true');
    eyebrow.append(icon, document.createTextNode(section.label));
    heading.parentElement.insertBefore(eyebrow, heading);
}

function initializeResponsiveMenu() {
    const sidebar = document.querySelector('.atn-sidebar');
    const toggle = document.getElementById('sidebar-toggle');
    if (!sidebar || !toggle) return;

    sidebar.id = 'atn-sidebar';
    sidebar.querySelector('.atn-sidebar-header')?.remove();
    sidebar.querySelector('.atn-sidebar-close')?.remove();

    let overlay = document.querySelector('.atn-sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'atn-sidebar-overlay';
        overlay.id = 'sidebar-overlay';
        overlay.setAttribute('aria-hidden', 'true');
        document.body.append(overlay);
    }

    toggle.setAttribute('aria-controls', sidebar.id);

    function closeMenu(restoreFocus = false) {
        const wasOpen = sidebar.classList.contains('show');
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('atn-sidebar-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menu');
        if (restoreFocus && wasOpen) toggle.focus();
    }

    function openMenu() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('atn-sidebar-open');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Fechar menu');
        sidebar.querySelector('a')?.focus();
    }

    toggle.addEventListener('click', function() {
        if (sidebar.classList.contains('show')) {
            closeMenu();
        } else {
            openMenu();
        }
    });
    overlay.addEventListener('click', function() {
        closeMenu(true);
    });
    sidebar.addEventListener('click', function(event) {
        if (event.target.closest('a') && window.matchMedia('(max-width: 767.98px)').matches) {
            closeMenu();
        }
    });
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeMenu(true);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    renderNavbar();
    renderMenu();
    renderPageEyebrow();
    initializeResponsiveMenu();
});

document.addEventListener('atn:content-loaded', renderPageEyebrow);
