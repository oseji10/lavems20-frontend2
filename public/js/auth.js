const API_BASE_URL = 'http://127.0.0.1:8001/';

const form = document.getElementById('login-form');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const email = form.email.value;
    const password = form.password.value;

    fetch(API_BASE_URL + 'api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
        const token = data.token;
        localStorage.setItem('token', token);
        fetch(`${API_BASE_URL}api/user`, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        })
        .then(response => response.json())
        .then(user => {
          localStorage.setItem('user', JSON.stringify(user));
          // Add this line to store user data in the session
          sessionStorage.setItem('user', JSON.stringify(user));
          window.location = `/Dashboards/Default`;
        })
        .catch(error => console.error(error));
    })
    .catch(error => console.error(error));
});

if (localStorage.getItem('token')) {
    const token = localStorage.getItem('token');
    fetch(API_BASE_URL + 'api/user', {
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        localStorage.setItem('user', JSON.stringify(data));
    })
    .catch(error => console.error(error));
}
