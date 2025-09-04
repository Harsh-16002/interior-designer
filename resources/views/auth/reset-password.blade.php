<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Élégance Interiors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #9A7B4F; /* Rich bronze */
            --secondary: #F8F4EC; /* Luxe ivory */
            --accent: #D4C9B8; /* Warm stone */
            --dark: #2A241B; /* Espresso */
        }
        
        body {
            background: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            position: relative;
            min-height: 100vh;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(42,36,27,0.85) 0%, rgba(154,123,79,0.7) 100%);
            z-index: -1;
        }
        
        .auth-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            max-width: 500px;
            width: 100%;
        }
        
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            background: var(--primary);
            color: white;
            padding: 1.75rem;
            text-align: center;
            border-bottom: 3px solid var(--dark);
        }
        
        .card-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 2.5rem;
            background: white;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.75rem;
            display: block;
        }
        
        .password-input {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            cursor: pointer;
            z-index: 10;
        }
        
        .form-control {
            padding: 0.85rem 1rem;
            border: 2px solid var(--accent);
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
            outline: none;
        }
        
        .btn-reset {
            background: var(--primary);
            border: none;
            padding: 1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }
        
        .btn-reset:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }
        
        .btn-reset::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-reset:hover::before {
            left: 100%;
        }
        
        .alert {
            border-left: 4px solid transparent;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border-left-color: #dc3545;
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border-left-color: #28a745;
        }
        
        .password-strength {
            height: 4px;
            background: #e9ecef;
            margin-top: 0.5rem;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card shadow">
            <div class="card-header">
                <h4 class="card-title">RESET YOUR PASSWORD</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{route('update.password')}}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">New Password</label>
                        <div class="password-input">
                            <input type="password" name="password" class="form-control" id="password" required minlength="6" placeholder="Enter your new password">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        <div class="password-strength">
                            <div class="strength-meter" id="strengthMeter"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="password-input">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required placeholder="Re-enter your new password">
                            <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-reset text-white">
                        <i class="fas fa-lock me-2"></i> UPDATE PASSWORD
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password toggle visibility
        const togglePassword = document.querySelector('#togglePassword');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const password = document.querySelector('#password');
        const passwordConfirm = document.querySelector('#password_confirmation');
        const strengthMeter = document.querySelector('#strengthMeter');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
        
        toggleConfirmPassword.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
        
        // Password strength meter
        password.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            strengthMeter.style.width = `${strength}%`;
            
            if (strength < 30) {
                strengthMeter.style.backgroundColor = '#dc3545';
            } else if (strength < 70) {
                strengthMeter.style.backgroundColor = '#fd7e14';
            } else {
                strengthMeter.style.backgroundColor = '#28a745';
            }
        });
        
        function calculatePasswordStrength(password) {
            let strength = 0;
            
            // Length contributes up to 50%
            strength += Math.min(50, (password.length * 5));
            
            // Contains both lower and uppercase
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 10;
            
            // Contains numbers
            if (password.match(/([0-9])/)) strength += 10;
            
            // Contains special chars
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 20;
            
            // Contains both letters and numbers
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 10;
            
            return Math.min(100, strength);
        }
    </script>
</body>
</html>