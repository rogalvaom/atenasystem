const publicPaths = new Set(['/', '/login']);
const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

if (!publicPaths.has(currentPath)) {
    let intervalId;
    let requestPending = false;

    function redirectToLogin() {
        if (intervalId) {
            window.clearInterval(intervalId);
        }
        window.location.replace('/login');
    }

    async function checkSession() {
        if (requestPending) return;
        requestPending = true;

        try {
            const response = await fetch('/api/session', {
                credentials: 'same-origin',
                cache: 'no-store',
                headers: { Accept: 'application/json' }
            });

            if (response.status === 401) {
                redirectToLogin();
                return;
            }
            if (!response.ok) return;

            const session = await response.json();
            if (!session || !session.logged) {
                redirectToLogin();
            }
        } catch {
            // Retry on the next interval if the session endpoint is temporarily unavailable.
        } finally {
            requestPending = false;
        }
    }

    checkSession();
    intervalId = window.setInterval(checkSession, 1000);
    window.addEventListener('pageshow', checkSession);
}
