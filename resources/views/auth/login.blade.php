<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Ékta Interiors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #9A7B4F; /* Rich bronze */
            --secondary: #F8F4EC; /* Luxe ivory */
            --accent: #D4C9B8; /* Warm stone */
            --dark: #2A241B; /* Espresso */
            --light: #FFFFFF;
        }
        
        body {
            background: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(42,36,27,0.85) 0%, rgba(154,123,79,0.7) 100%);
            z-index: -2;
        }
        
        .auth-container {
            width: 420px;
            position: relative;
            z-index: 10;
        }
        
        .auth-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background: var(--light);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }
        
        .auth-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.3);
        }
        
        .auth-header {
            background: var(--primary);
            color: var(--light);
            text-align: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .auth-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 50%, var(--primary) 100%);
        }
        
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }
        
        .brand-logo::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--light);
        }
        
        .brand-tagline {
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 1rem;
            opacity: 0.8;
        }
        
        .auth-body {
            padding: 2.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-group-text {
            background: transparent;
            border-right: none;
            color: var(--primary);
        }
        
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s;
            background: var(--secondary);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
            background: var(--light);
        }
        
        .btn-auth {
            background: var(--primary);
            color: var(--light);
            border: none;
            padding: 1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 6px;
            transition: all 0.3s;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .btn-auth::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-auth:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }
        
        .btn-auth:hover::before {
            left: 100%;
        }
        
        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .forgot-link:hover {
            color: var(--dark);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--accent);
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider-text {
            padding: 0 1rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .decorative-element {
            position: absolute;
            width: 200px;
            height: 200px;
            border: 2px solid rgba(154, 123, 79, 0.3);
            border-radius: 50%;
            z-index: -1;
        }
        
        .decorative-element.top-right {
            top: -80px;
            right: -80px;
        }
        
        .decorative-element.bottom-left {
            bottom: -80px;
            left: -80px;
        }
        
        .floating-objects {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .floating-object {
            position: absolute;
            opacity: 0.1;
        }
        
        .object-1 {
            top: 20%;
            left: 10%;
            font-size: 3rem;
            color: var(--primary);
            transform: rotate(15deg);
        }
        
        .object-2 {
            bottom: 15%;
            right: 10%;
            font-size: 2.5rem;
            color: var(--primary);
            transform: rotate(-10deg);
        }
        
        .error-message {
            background: rgba(220, 53, 69, 0.1);
            border-left: 3px solid #dc3545;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border-radius: 0 4px 4px 0;
            font-size: 0.9rem;
        }
        
        .error-message div {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="floating-objects">
        <div class="floating-object object-1">
            <i class="fas fa-couch"></i>
        </div>
        <div class="floating-object object-2">
            <i class="fas fa-paint-roller"></i>
        </div>
    </div>
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="brand">
                    <div class="brand-logo">Ékta</div>
                    <div class="brand-tagline">Interior Design Studio</div>
                </div>
            </div>
            <div class="auth-body">
                <h5 class="text-center mb-4" style="color: var(--dark); font-weight: 500;">Admin Portal</h5>
                
                @if($errors->any())
                    <div class="error-message">
                        @foreach($errors->all() as $err)
                            <div><i class="fas fa-exclamation-circle me-2"></i>{{ $err }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">EMAIL ADDRESS</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="admin@elegance.com">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                        </div>
                    </div>
                    <button class="btn-auth mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i> ACCESS PORTAL
                    </button>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('forget.password') }}" class="forgot-link">
                            <i class="fas fa-key me-2"></i>Forgot your password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>