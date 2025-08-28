document.addEventListener('DOMContentLoaded', () => {
    checkAuth();

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email === 'admin@gmail.com' && password === '1234') {
                localStorage.setItem('isLoggedIn', true);
                window.location.href = 'index.html';
            } else {
                alert('Invalid login credentials!');
            }
        });
    }
});

window.addEventListener('pageshow', () => {
    checkAuth();
});

function checkAuth() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const path = window.location.pathname;

    if ((path === '/' || path.includes('index.html')) && !isLoggedIn) {
        window.location.href = 'login.html';
    }

    if (path.includes('auth-login.html') && isLoggedIn) {
        window.location.href = 'index.html';
    }
}

// ✅ Logout function
function logout() {
    localStorage.removeItem('isLoggedIn');
    window.location.href = 'login.html';
}
