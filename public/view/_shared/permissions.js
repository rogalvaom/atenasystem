export const FEATURES = [
    { id: 'home', path: '/home', label: 'Início', icon: 'fa-house', modes: ['representate', 'monitore', 'comissao'] },
    { id: 'representante', path: '/representante', label: 'Representante', icon: 'fa-user-plus', modes: ['representate'] },
    { id: 'comissao', path: '/comissao', label: 'Comissão de Faltas', icon: 'fa-address-book', modes: ['representate'] },
    { id: 'monitore', path: '/monitore', label: 'Monitore', icon: 'fa-user-circle', modes: ['representate'] },
    { id: 'tutore', path: '/tutore', label: 'Tutore', icon: 'fa-user', modes: ['representate', 'monitore'] },
    { id: 'tutore-justificar', path: '/tutore/justificar', label: 'Justificar presença de tutore', icon: 'fa-clipboard-check', modes: ['representate', 'comissao'] },
    { id: 'tutore-presenca', path: '/tutore/presenca', label: 'Editar presença de tutore', icon: 'fa-calendar-check', modes: ['representate', 'monitore'] },
    { id: 'alune', path: '/alune', label: 'Alune', icon: 'fa-graduation-cap', modes: ['representate', 'monitore'] },
    { id: 'alune-justificar', path: '/alune/justificar', label: 'Justificar presença de alune', icon: 'fa-clipboard-check', modes: ['representate', 'monitore'] },
    { id: 'disciplina', path: '/disciplina', label: 'Disciplina', icon: 'fa-book-open', modes: ['representate', 'monitore'] },
    { id: 'sala', path: '/sala', label: 'Sala', icon: 'fa-university', modes: ['representate', 'monitore'] },
    { id: 'presenca-alune', path: '/presenca/alune', label: 'Presença de alunes', icon: 'fa-calendar', modes: ['representate', 'monitore'] },
    { id: 'presenca-tutore', path: '/presenca/tutore', label: 'Presença de tutores', icon: 'fa-calendar', modes: ['representate', 'monitore'] },
    { id: 'presenca-monitore', path: '/presenca/monitore', label: 'Presença de monitores', icon: 'fa-calendar', modes: ['representate'] },
    { id: 'presenca-reuniao', path: '/presenca/reuniao', label: 'Presença de reunião', icon: 'fa-calendar', modes: ['representate', 'comissao'] },
    { id: 'certificado-monitore', path: '/certificado', label: 'Certificado de monitore', icon: 'fa-file-pdf', modes: ['representate', 'monitore'] },
    { id: 'certificado-tutore', path: '/certificado/tutore', label: 'Certificado de tutore', icon: 'fa-file-pdf', modes: ['representate', 'monitore'] },
    { id: 'relatorio-alune', path: '/relatorio/alune', label: 'Relatório de alunes', icon: 'fa-chart-column', modes: ['representate', 'monitore'] },
    { id: 'relatorio-tutore', path: '/relatorio/tutore', label: 'Relatório de tutores', icon: 'fa-chart-column', modes: ['representate', 'monitore'] },
    { id: 'relatorio-monitore', path: '/relatorio/monitore', label: 'Relatório de monitores', icon: 'fa-chart-column', modes: ['representate'] },
    { id: 'relatorio-reuniao', path: '/relatorio/reuniao', label: 'Relatório de reunião', icon: 'fa-chart-column', modes: ['representate', 'comissao'] }
];

export const MENU_ITEMS = [
    { path: '/representante', label: 'Representante', icon: 'fa-user-plus', modes: ['representate'] },
    { path: '/comissao', label: 'Comissão de Faltas', icon: 'fa-address-book', modes: ['representate'] },
    { path: '/monitore', label: 'Monitore', icon: 'fa-user-circle', modes: ['representate'] },
    { path: '/tutore', modePaths: { comissao: '/tutore/justificar' }, label: 'Tutore', icon: 'fa-user', modes: ['representate', 'monitore', 'comissao'] },
    { path: '/alune', label: 'Alune', icon: 'fa-graduation-cap', modes: ['representate', 'monitore'] },
    { path: '/disciplina', label: 'Disciplina', icon: 'fa-book-open', modes: ['representate', 'monitore'] },
    { path: '/sala', label: 'Sala', icon: 'fa-university', modes: ['representate', 'monitore'] },
    { path: '/presenca', modePaths: { comissao: '/presenca/reuniao' }, label: 'Presença', icon: 'fa-calendar', modes: ['representate', 'monitore', 'comissao'] },
    { path: '/certificado', label: 'Certificado', icon: 'fa-file-pdf', modes: ['representate', 'monitore'] },
    { path: '/relatorio', modePaths: { comissao: '/relatorio/reuniao' }, label: 'Relatório', icon: 'fa-chart-column', modes: ['representate', 'monitore', 'comissao'] }
];

const featureById = new Map(FEATURES.map(feature => [feature.id, feature]));

export function getFeatureForPath(path) {
    const normalizedPath = path.replace(/\/+$/, '') || '/';
    const aliases = {
        '/presenca': '/presenca/alune',
        '/relatorio': '/relatorio/alune'
    };
    const resolvedPath = aliases[normalizedPath] || normalizedPath;

    return FEATURES
        .filter(feature => resolvedPath === feature.path || resolvedPath.startsWith(`${feature.path}/`))
        .sort((first, second) => second.path.length - first.path.length)[0] || null;
}

export function canAccessFeature(featureOrPath, mode) {
    const feature = featureById.get(featureOrPath) || getFeatureForPath(featureOrPath);
    return !feature || feature.modes.includes(mode);
}

export function applyFeatureVisibility(root, mode) {
    root.querySelectorAll('[data-feature], a[href]').forEach(element => {
        const featureId = element.dataset.feature;
        const path = featureId
            ? featureById.get(featureId)?.path
            : new URL(element.href, window.location.origin).pathname;
        if (!path || canAccessFeature(featureId || path, mode)) return;

        element.hidden = true;
        element.setAttribute('aria-hidden', 'true');
        element.style.display = 'none';
    });
}

let sessionRequest;

export function fetchSession() {
    if (!sessionRequest) {
        sessionRequest = fetch('/api/session', {
            credentials: 'same-origin',
            cache: 'no-store',
            headers: { Accept: 'application/json' }
        })
            .then(response => response.ok ? response.json() : null)
            .catch(() => null)
            .finally(() => {
                sessionRequest = null;
            });
    }

    return sessionRequest;
}