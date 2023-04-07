<template>
jfjfjf


                <form method="POST" action="{{ route('login.fire') }}">
                    @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-cs-icon="email"></i>
                        <input class="form-control" placeholder="Email" name="email"/>
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-cs-icon="lock-off"></i>
                        <input class="form-control pe-7" name="password" type="password" placeholder="Password"/>
                        <a class="text-small position-absolute t-3 e-3"
                           href="{{ url('/Pages/Authentication/ForgotPassword') }}">Forgot?</a>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Login</button>
                </form>


  </template>

  <script>
    import axios from 'axios';

    export default {
      mounted() {
        // Listen for the form submission event
        document.querySelector('#login-form').addEventListener('submit', this.login);
      },
      methods: {
        login(event) {
          event.preventDefault(); // Prevent the form from submitting normally

          // Get the email and password fields from the form
          const email = document.querySelector('#email').value;
          const password = document.querySelector('#password').value;

          axios.post('/api/login', {
            email,
            password,
          })
          .then(response => {
            const token = response.data.access_token;
            localStorage.setItem('access_token', token);
            // Redirect the user to the dashboard page or any other authorized page
            window.location = '/dashboard';
          })
          .catch(error => {
            // Display the error message returned by the backend
            const errorMessage = error.response.data.error;
            alert(errorMessage);
          });
        }
      }
    }
  </script>
