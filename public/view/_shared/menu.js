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

document.addEventListener('DOMContentLoaded', function() {
    renderNavbar();
    renderMenu();
    renderPageEyebrow();
});

document.addEventListener('atn:content-loaded', renderPageEyebrow);
