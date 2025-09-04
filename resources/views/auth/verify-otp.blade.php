<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification | Ékta Interiors</title>
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
            max-width: 450px;
            width: 100%;
        }
        
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            background: var(--primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-bottom: 3px solid var(--dark);
        }
        
        .card-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin: 0;
        }
        
        .card-body {
            padding: 2rem;
            background: white;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .otp-input {
            letter-spacing: 2px;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            padding: 0.75rem;
            border: 2px solid var(--accent);
            border-radius: 8px;
            color: var(--dark);
            transition: all 0.3s;
        }
        
        .otp-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
            outline: none;
        }
        
        .btn-verify {
            background: var(--primary);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .btn-verify:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }
        
        .btn-verify::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-verify:hover::before {
            left: 100%;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border-left: 3px solid #dc3545;
            border-radius: 0 4px 4px 0;
        }
        
        .otp-instruction {
            color: #6c757d;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .otp-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card shadow">
            <div class="card-header">
                <h4 class="card-title">OTP VERIFICATION</h4>
            </div>
            <div class="card-body p-4">
                @if(session('error'))
                    <div class="alert alert-danger mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                <div class="text-center">
                    <div class="otp-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <p class="otp-instruction">Enter the 6-digit verification code sent to your email</p>
                </div>

                <form method="POST" action="{{route('verify.otp')}}">
                    @csrf
                    <div class="mb-4">
                        <input type="text" 
                               name="otp" 
                               class="form-control otp-input" 
                               maxlength="6" 
                               required 
                               pattern="\d{6}" 
                               placeholder="••••••"
                               inputmode="numeric">
                    </div>
                    <button type="submit" class="btn btn-verify text-white">
                        <i class="fas fa-check-circle me-2"></i> VERIFY CODE
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto move between OTP digits
        document.querySelector('.otp-input').addEventListener('input', function(e) {
            if (this.value.length === 6) {
                this.blur();
                document.querySelector('form').submit();
            }
        });
    </script>
</body>
</html>