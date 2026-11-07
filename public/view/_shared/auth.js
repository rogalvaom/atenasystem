import { applyFeatureVisibility, canAccessFeature, fetchSession } from './permissions.js';

const publicPaths = new Set(['/', '/login']);
const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

if (!publicPaths.has(currentPath)) {
    document.body.style.visibility = 'hidden';
    let intervalId;

    async function checkSession() {
        const session = await fetchSession();
        if (!session) return;

        if (!session.logged) {
            window.clearInterval(intervalId);
            window.location.replace('/login');
            return false;
        }

        if (!canAccessFeature(currentPath, session.modo)) {
            window.clearInterval(intervalId);
            window.location.replace('/home');
            return false;
        }

        applyFeatureVisibility(document, session.modo);
        document.body.style.visibility = 'visible';
        return true;
    }

    checkSession();
    intervalId = window.setInterval(checkSession, 1000);
    window.addEventListener('pageshow', checkSession);

    const observer = new MutationObserver(() => {
        fetchSession().then(session => {
            if (session?.logged) applyFeatureVisibility(document, session.modo);
        });
    });
    observer.observe(document.documentElement, { childList: true, subtree: true });
}
