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

    <style>
        body {
            background: linear-gradient(135deg, #0b1020, #1a2340);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: "Inter", sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.45);
            animation: fadeIn 1s ease;
        }

        .auth-title {
            font-weight: 700;
            color: #facc15;
        }

        .btn-gold {
            background: #d4a017;
            color: #0b1020;
            font-weight: 600;
            border-radius: 30px;
            padding: 10px;
        }

        .btn-gold:hover {
            background: #e0b329;
        }

        .link-light:hover {
            color: #facc15 !important;
        }

        @keyframes fadeIn {
            from { opacity:0; transform: translateY(20px); }
            to   { opacity:1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="auth-card">
    @yield('content')
</div>

</body>
</html>
