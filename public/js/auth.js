const API_BASE_URL = 'http://lavems.littlefingers.ng/';

const form = document.getElementById('login-form');

// form.addEventListener('submit', (event) => {
//     event.preventDefault();

//     const email = form.email.value;
//     const password = form.password.value;

//     fetch(API_BASE_URL + 'api/login', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ email, password })
//     })
//     .then(response => response.json())
//     .then(data => {
//         const token = data.token;
//         localStorage.setItem('token', token);
//         fetch(`${API_BASE_URL}api/user`, {
//           headers: {
//             'Authorization': `Bearer ${token}`
//           }
//         })
//         .then(response => response.json())
//         .then(user => {
//           localStorage.setItem('user', JSON.stringify(user));
//           // Add this line to store user data in the session
//           sessionStorage.setItem('user', JSON.stringify(user));
//         //   sessionStorage.setItem('user', JSON.stringify(user));
//           window.location = `/Dashboards/Default`;
//         })
//         .catch(error => console.error(error));
//     })
//     .catch(error => console.error(error));
// });


$(document).ready(function () {
    $("#login-btn").click(function (event) {
        event.preventDefault();
        $("#login-btn").prop('disabled', true);
        $("#login-btn").text('Please wait...');
        loginUser();
    });
});

function loginUser() {
    const email = $("#email").val();
    const password = $("#password").val();

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
        //   sessionStorage.setItem('user', JSON.stringify(user));
          window.location = `/Dashboards/Default`;
        })
        .catch(error => console.error(error));
    })
    .catch(error => console.error(error));
}
