<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #04201b, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        .form-title {
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .form-text {
            text-align: center;
            margin-top: 10px;
            color: #666;
        }

        .form-text a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .form-text a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger" style="margin-left: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-container">
        <!-- Displaying the alert messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 

        <h2 class="form-title">Create Your Account</h2>
        <form id="registerForm" action="{{ route('registerSave') }}" method="POST">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                <div class="invalid-feedback" id="passwordError" style="display: none;"></div> <!-- Error message -->
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                <div class="invalid-feedback" id="passwordConfirmationError" style="display: none;"></div> <!-- Error message -->
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn btn-custom">Register</button>

            <!-- Optional: Link to Login -->
            <p class="form-text">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission for validation
    
            // Clear previous error messages
            document.getElementById('passwordError').style.display = 'none';
            document.getElementById('passwordConfirmationError').style.display = 'none';
    
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            let hasError = false;
    
            // Regular expressions for password validation
            const uppercasePattern = /^[A-Z]/; // First character must be uppercase
            const numberPattern = /[0-9]/; // At least one number
            const specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/; // At least one special character
            const minLength = 8; // Minimum password length
    
            // Password validation
            if (!password) {
                hasError = true;
                document.getElementById('passwordError').innerText = 'Password is required.';
                document.getElementById('passwordError').style.display = 'block';
            } else if (password.length < minLength) {
                hasError = true;
                document.getElementById('passwordError').innerText = `Password must be at least ${minLength} characters long.`;
                document.getElementById('passwordError').style.display = 'block';
            } else if (!uppercasePattern.test(password)) {
                hasError = true;
                document.getElementById('passwordError').innerText = 'Password must start with an uppercase letter.';
                document.getElementById('passwordError').style.display = 'block';
            } else if (!numberPattern.test(password)) {
                hasError = true;
                document.getElementById('passwordError').innerText = 'Password must include at least one number.';
                document.getElementById('passwordError').style.display = 'block';
            } else if (!specialCharPattern.test(password)) {
                hasError = true;
                document.getElementById('passwordError').innerText = 'Password must include at least one special character.';
                document.getElementById('passwordError').style.display = 'block';
            }
    
            // Confirm Password validation
            if (password !== passwordConfirmation) {
                hasError = true;
                document.getElementById('passwordConfirmationError').innerText = 'Passwords do not match.';
                document.getElementById('passwordConfirmationError').style.display = 'block';
            }
    
            // If there are no errors, submit the form
            if (!hasError) {
                this.submit(); // Submit the form
            }
        });
    </script>
    </body>
</html>
