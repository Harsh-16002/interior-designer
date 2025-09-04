<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | Ékta Interiors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#9A7B4F',
                        secondary: '#F8F4EC',
                        accent: '#D4C9B8',
                        dark: '#2A241B',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['"Playfair Display"', 'serif']
                    },
                }
            }
        }
    </script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace') no-repeat center center fixed;
            background-size: cover;
            position: relative;
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
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
        
        .auth-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary {
            background: #9A7B4F;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            background: #2A241B;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .input-field:focus {
            border-color: #9A7B4F;
            box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl auth-card max-w-md w-full p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-display font-semibold text-dark mb-2">
                <i class="fas fa-key mr-2 text-primary"></i>Password Reset
            </h2>
            <p class="text-gray-600">Enter your email to receive a OTP</p>
        </div>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('auth.sendotp')}}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" required placeholder="your@email.com"
                           class="input-field pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>

            <button type="submit"
                class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-lg shadow-lg">
                <i class="fas fa-paper-plane mr-2"></i> Send OTP
            </button>
        </form>

        <div class="text-center mt-6 pt-4 border-t border-gray-200">
            <a href="{{route('auth.login')}}" class="text-sm text-primary hover:underline font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to Login
            </a>
        </div>
    </div>

</body>
</html>