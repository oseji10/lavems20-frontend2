
    const user2 = JSON.parse(sessionStorage.getItem('user'));
    if (user2) {
        const first_name = user2.first_name;
        const last_name = user2.last_name;
        const user_id = user2.id;
        // display the username in the HTML element
        document.getElementById('first_name').innerHTML = first_name;
        document.getElementById('last_name').innerHTML = last_name;
        document.getElementById('user_id').innerHTML = user_id;
        document.getElementByName('user_id').innerHTML = user_id;
    } else {
        // redirect to login page
        window.location.href = '/Pages/Authentication/Login';
    }

