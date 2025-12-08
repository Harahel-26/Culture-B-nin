<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') • Culture Bénin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a365d;
            --secondary: #d4af37;
            --accent: #c53030;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
            font-family: "Inter", sans-serif;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.8s ease;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--secondary), #b8941f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            display: block;
        }

        .auth-tagline {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.1);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
        }

        .auth-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .auth-subtitle {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--secondary), #b8941f);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.8rem;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-auth:hover {
            background: linear-gradient(135deg, #b8941f, #9a7b1a);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .form-check-input:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .auth-link {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-link:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .auth-footer {
            text-align: center;
            margin-top: 30px;
            color: var(--gray);
            font-size: 0.85rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #38a169, #2f855a);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #e53e3e, #c53030);
            color: white;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
        }

        .password-wrapper {
            position: relative;
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .auth-card {
                padding: 30px 20px;
            }

            .auth-logo {
                font-size: 2rem;
            }

            .auth-title {
                font-size: 1.5rem;
            }
        }

        .text-muted {
            color: var(--gray) !important;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--gray);
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .separator span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <a href="{{ route('front.home') }}" class="auth-logo text-decoration-none">
                Culture Bénin
            </a>
            <p class="auth-tagline">Patrimoine • Tradition • Modernité</p>
        </div>

        <div class="auth-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <div class="auth-footer">
            <p class="mb-0">
                &copy; {{ date('Y') }} Culture Bénin •
                <a href="#" class="auth-link">Mentions légales</a> •
                <a href="#" class="auth-link">Confidentialité</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.password-wrapper').forEach(wrapper => {
            const input = wrapper.querySelector('input[type="password"]');
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'password-toggle';
            toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';

            toggleBtn.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            });

            wrapper.appendChild(toggleBtn);
        });

        // Add password wrapper to password fields
        document.querySelectorAll('input[type="password"]').forEach(input => {
            const wrapper = document.createElement('div');
            wrapper.className = 'password-wrapper';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
        });
    </script>
</body>
</html>
