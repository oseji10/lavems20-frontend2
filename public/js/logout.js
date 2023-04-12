const logoutButton = document.getElementById('logout-button');

logoutButton.addEventListener('click', () => {
    // Remove user data from session storage
    sessionStorage.removeItem('user');

    // Redirect to login page
    window.location.href = '/Pages/Authentication/Login';
});
