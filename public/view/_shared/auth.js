import { applyFeatureVisibility, canAccessFeature, fetchSession } from './permissions.js';

const publicPaths = new Set(['/', '/login']);
const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

export const authReady = (async function() {
    if (publicPaths.has(currentPath)) return { public: true };

    document.body.style.visibility = 'hidden';
    const session = await fetchSession();
    if (!session) {
        window.addEventListener('online', () => window.location.reload(), { once: true });
        return new Promise(() => {});
    }

    if (!session.logged) {
        window.location.replace('/login');
        return new Promise(() => {});
    }

    if (!canAccessFeature(currentPath, session.modo)) {
        window.location.replace('/home');
        return new Promise(() => {});
    }

    applyFeatureVisibility(document, session.modo);
    document.body.style.visibility = 'visible';
    return session;
})();

window.atnAuthReady = authReady;
