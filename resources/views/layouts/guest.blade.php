<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

        /* Main Container - Perfect Centering */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Attached Cards Container */
        .cyber-attached-cards {
            display: flex;
            max-width: 800px;
            width: 100%;
            background: rgba(10, 10, 20, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 20px;
            animation: cardGlow 3s infinite;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            overflow: hidden;
            margin: 0 auto;
        }

        @keyframes cardGlow {
            0%, 100% { box-shadow: 0 0 30px rgba(0, 255, 255, 0.2); }
            50% { box-shadow: 0 0 50px rgba(255, 0, 255, 0.3); }
        }

        /* Left Card - Form (60% width) */
        .cyber-form-card {
            flex: 1.5;  /* 60% of the space */
            padding: 40px;
            border-right: 1px solid rgba(0, 255, 255, 0.3);
        }

        /* Right Card - Logo (40% width) */
        .cyber-logo-card {
            flex: 1;  /* 40% of the space */
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(145deg, 
                #030314,  /* Almost black with hint of blue */
                #08081a,  /* Very dark navy */
                #000000   /* Pure black */
            );
            position: relative;
            border-left: 1px solid rgba(0, 255, 255, 0.15);
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.9);
        }

        /* Minimal scan lines - almost invisible */
        .cyber-logo-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 255, 255, 0.01) 0px,
                rgba(0, 255, 255, 0.01) 2px,
                transparent 2px,
                transparent 6px
            );
            pointer-events: none;
        }

        /* Logo Container */
        .logo-container {
            text-align: center;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Square Logo Frame with Gradient Border - Smaller for right card */
        .logo-frame {
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            border-radius: 20px;
            background: linear-gradient(135deg, #00ffff, #ff00ff);
            padding: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: framePulse 3s infinite;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
        }

        @keyframes framePulse {
            0%, 100% { box-shadow: 0 0 30px rgba(0, 255, 255, 0.5); }
            50% { box-shadow: 0 0 50px rgba(255, 0, 255, 0.7); }
        }

        /* Inner Square - Dark Background */
        .logo-inner {
            width: 100%;
            height: 100%;
            border-radius: 17px;
            background: #0a0a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .logo-inner:hover {
            transform: scale(1.05);
        }

        /* Logo Image */
        .logo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .logo-inner:hover .logo-image {
            transform: scale(1.1);
        }

        /* Logo Text - Slightly smaller for right card */
        .logo-text {
            font-size: 32px;
            font-weight: 900;
            text-transform: uppercase;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #00ffff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGradient 3s ease infinite;
            letter-spacing: 4px;
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .logo-subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .cyber-line {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ffff, #ff00ff, #00ffff, transparent);
            margin: 10px auto;
        }

        /* Title */
        .cyber-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .cyber-title h2 {
            font-size: 28px;
            font-weight: 900;
            text-transform: uppercase;
            background: linear-gradient(45deg, #00ffff, #ff00ff, #00ffff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGradient 3s ease infinite;
            letter-spacing: 3px;
        }

        @keyframes titleGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .cyber-title p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: rgba(0, 255, 255, 0.8);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(0, 255, 255, 0.5);
            font-size: 16px;
        }

        .cyber-input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-family: 'Orbitron', sans-serif;
            transition: all 0.3s ease;
        }

        .cyber-input:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.7);
        }

        .cyber-input::placeholder {
            color: rgba(255, 255, 255, 0.2);
            font-size: 11px;
        }

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
            width: 18px;
            height: 18px;
            border: 2px solid rgba(0, 255, 255, 0.5);
            border-radius: 4px;
            margin-right: 8px;
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
            font-size: 12px;
        }

        .remember-me span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
        }

        .forgot-link {
            color: rgba(255, 0, 255, 0.8);
            text-decoration: none;
            font-size: 13px;
            position: relative;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #ff00ff;
            text-shadow: 0 0 8px rgba(255, 0, 255, 0.5);
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

        /* Cyber Button */
        .cyber-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            font-family: 'Orbitron', sans-serif;
            margin-top: 5px;
        }

        .cyber-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(255, 0, 255, 0.5);
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
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.3);
            font-size: 11px;
        }

        .security-badge svg {
            width: 14px;
            height: 14px;
            margin-right: 6px;
            fill: currentColor;
        }

        /* Error Messages */
        .error-message {
            color: #ff00ff;
            font-size: 11px;
            margin-top: 4px;
            padding-left: 12px;
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
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: #00ffff;
            text-align: center;
            animation: pulse 2s infinite;
            font-size: 13px;
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
            font-size: 11px;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cyber-attached-cards {
                flex-direction: column;
                max-width: 450px;
            }
            
            .cyber-form-card {
                border-right: none;
                border-bottom: 1px solid rgba(0, 255, 255, 0.3);
            }
            
            .cyber-title h2 {
                font-size: 24px;
            }

            .orb1, .orb2, .orb3 {
                filter: blur(40px);
            }
            
            .form-group {
                margin-bottom: 18px;
            }
            
            .logo-text {
                font-size: 36px;
                letter-spacing: 4px;
            }
            
            .logo-frame {
                width: 120px;
                height: 120px;
            }
        }

        @media (max-width: 480px) {
            .cyber-form-card, .cyber-logo-card {
                padding: 25px 20px;
            }
            
            .cyber-button {
                padding: 12px;
                font-size: 14px;
            }
            
            .logo-frame {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-height: 700px) {
            .auth-container {
                padding: 15px;
            }
        }

        /* Scrollable card if needed */
        .cyber-form-card, .cyber-logo-card {
            max-height: 80vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #00ffff rgba(255, 255, 255, 0.1);
        }

        .cyber-form-card::-webkit-scrollbar,
        .cyber-logo-card::-webkit-scrollbar {
            width: 4px;
        }

        .cyber-form-card::-webkit-scrollbar-track,
        .cyber-logo-card::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .cyber-form-card::-webkit-scrollbar-thumb,
        .cyber-logo-card::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border-radius: 10px;
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

    <!-- Main Content - Perfectly Centered -->
    <div class="auth-container">
        <div class="cyber-attached-cards">
            <!-- Left Card - Form (60% width) -->
            <div class="cyber-form-card">
                {{ $slot }}
            </div>

            <!-- Right Card - MISOUT Logo with Square Frame (40% width) -->
            <div class="cyber-logo-card">
                <div class="logo-container">
                    <!-- Square Logo Frame with Gradient Border -->
                    <div class="logo-frame">
                        <div class="logo-inner">
                            <img src="{{ asset('images/misout-logo.png') }}" alt="MISOUT Logo" class="logo-image">
                        </div>
                    </div>
                    
                    <div class="logo-text">MISOUT</div>
                    <div class="logo-subtitle">Outsourcing Corp</div>
                    <div class="cyber-line"></div>
                    <div style="margin-top: 10px; color: rgba(255,255,255,0.4); font-size: 10px;">
                        <span>Version 2.0</span>
                        <p style="margin-top: 2px;">MISOUT • <span id="year"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>