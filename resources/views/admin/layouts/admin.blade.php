<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=orbitron:400,500,600,700,900&display=swap" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Orbitron', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Animated Background */
        .cyber-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(125deg, #0a0a0a 0%, #1a0033 40%, #000066 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Grid Overlay */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: translateY(0); }
            100% { transform: translateY(50px); }
        }

        /* Floating Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
            animation: float 20s infinite;
        }

        .orb1 {
            width: 400px;
            height: 400px;
            background: rgba(255, 0, 255, 0.3);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb2 {
            width: 500px;
            height: 500px;
            background: rgba(0, 255, 255, 0.3);
            bottom: -150px;
            right: -150px;
            animation-delay: -5s;
        }

        .orb3 {
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 0, 0.2);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(100px, 50px) scale(1.1); }
            50% { transform: translate(50px, 100px) scale(0.9); }
            75% { transform: translate(-50px, 50px) scale(1.1); }
        }

        /* Scanning Line */
        .scan-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent, 
                #00ffff, 
                #ff00ff, 
                #00ffff, 
                transparent
            );
            animation: scan 4s linear infinite;
            opacity: 0.5;
            z-index: -1;
        }

        @keyframes scan {
            0% { top: -10%; }
            100% { top: 110%; }
        }

        /* Main Container */
        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Glass Card */
        .cyber-card {
            max-width: 500px;
            width: 100%;
            background: rgba(10, 10, 20, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            animation: cardGlow 3s infinite;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            margin: auto; /* This ensures centering */
        }

        @keyframes cardGlow {
            0%, 100% { box-shadow: 0 0 30px rgba(0, 255, 255, 0.2); }
            50% { box-shadow: 0 0 50px rgba(255, 0, 255, 0.3); }
        }

        /* Logo Container */
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .logo-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            background: rgba(0, 255, 255, 0.3);
            border-radius: 50%;
            filter: blur(30px);
            animation: pulseGlow 2s infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.2); }
        }

        .logo-container svg {
            width: 80px;
            height: 80px;
            fill: white;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.5));
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Title */
        .cyber-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .cyber-title h2 {
            font-size: 32px;
            font-weight: 900;
            text-transform: uppercase;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #00ffff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGradient 3s ease infinite;
            letter-spacing: 4px;
        }

        @keyframes titleGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .cyber-title p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: rgba(0, 255, 255, 0.8);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(0, 255, 255, 0.5);
            font-size: 18px;
        }

        .cyber-input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-family: 'Orbitron', sans-serif;
            transition: all 0.3s ease;
        }

        .cyber-input:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.7);
        }

        .cyber-input::placeholder {
            color: rgba(255, 255, 255, 0.2);
            font-size: 12px;
        }

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input {
            display: none;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0, 255, 255, 0.5);
            border-radius: 5px;
            margin-right: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .remember-me input:checked + .checkmark {
            background: #00ffff;
            border-color: #00ffff;
        }

        .remember-me input:checked + .checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
            font-size: 14px;
        }

        .remember-me span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .forgot-link {
            color: rgba(255, 0, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            position: relative;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #ff00ff;
            text-shadow: 0 0 10px rgba(255, 0, 255, 0.5);
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #ff00ff;
            transition: width 0.3s ease;
        }

        .forgot-link:hover::after {
            width: 100%;
        }

        /* Login/Register Button */
        .cyber-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            font-family: 'Orbitron', sans-serif;
            margin-top: 10px;
        }

        .cyber-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 0, 255, 0.5);
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        /* Security Badge */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.3);
            font-size: 12px;
        }

        .security-badge svg {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            fill: currentColor;
        }

        /* Error Messages */
        .error-message {
            color: #ff00ff;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 15px;
            position: relative;
        }

        .error-message::before {
            content: '⚠';
            position: absolute;
            left: 0;
            color: #ff00ff;
        }

        /* Session Status */
        .session-status {
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid #00ffff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #00ffff;
            text-align: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Footer */
        .cyber-footer {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.3);
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cyber-card {
                padding: 30px 20px;
                max-width: 95%;
            }

            .cyber-title h2 {
                font-size: 24px;
            }

            .orb1, .orb2, .orb3 {
                filter: blur(40px);
            }
            
            .form-group {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .cyber-card {
                padding: 25px 15px;
            }
            
            .form-group {
                margin-bottom: 15px;
            }
            
            .cyber-button {
                padding: 14px;
                font-size: 16px;
            }
        }

        /* For very short screens */
        @media (max-height: 700px) {
            .admin-container {
                justify-content: flex-start;
                padding-top: 30px;
                padding-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="cyber-bg"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="orb orb3"></div>
    <div class="scan-line"></div>

    <!-- Main Content -->
    <div class="admin-container">
        <div class="cyber-card">
            <!-- Content Slot -->
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="cyber-footer">
            <p>Secure Admin Access • <span id="year"></span></p>
        </div>
    </div>

    <script>
        // Update year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>