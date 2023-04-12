
    const user = JSON.parse(sessionStorage.getItem('user'));
    if (user) {
        const first_name = user.first_name;
        const last_name = user.last_name;
        // display the username in the HTML element
        document.getElementById('first_name').innerHTML = first_name;
        document.getElementById('last_name').innerHTML = last_name;
    } else {
        // redirect to login page
        window.location.href = '/Pages/Authentication/Login';
    }

