<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <script>
        async function login(event) {
            
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

          

            try {
                const response = await fetch('http://127.0.0.1:8000/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email, password }),
                });

                if (!response.ok) {
                    throw new Error('Login failed. Please check your credentials.');
                }
                
                const data = await response.json();
                localStorage.setItem('access_token', data.access_token);

                // Redirect to index page
                window.location.href = "{{ url('/index') }}";
            } catch (error) {
                alert(error.message);
            }
        }
    </script>
</head>
<body>
    <h1>Login</h1>
    <form onsubmit="login(event)">
    @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
