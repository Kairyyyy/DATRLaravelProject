<x-admin-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status">
            {{ session('status') }}
        </div>
    @endif

    <div class="cyber-title">
        <h2>Create Account</h2>
        <p>Join the command center</p>
    </div>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <div class="input-wrapper">
                <span class="input-icon">👤</span>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="cyber-input" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Enter your full name"
                >
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-wrapper">
                <span class="input-icon">📧</span>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="cyber-input" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="username"
                    placeholder="Enter your email"
                >
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="input-wrapper">
                <span class="input-icon">🔒</span>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="cyber-input" 
                    required 
                    autocomplete="new-password"
                    placeholder="Create a password"
                >
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <div class="input-wrapper">
                <span class="input-icon">🔐</span>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="cyber-input" 
                    required 
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                >
            </div>
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Strength Indicator (Optional Enhancement) -->
        <div class="password-strength" id="password-strength" style="display: none;">
            <div class="strength-bar">
                <div class="strength-fill" id="strength-fill"></div>
            </div>
            <span class="strength-text" id="strength-text">Password strength</span>
        </div>

        <!-- Register Button -->
        <button type="submit" class="cyber-button">
            Create Account
        </button>

        <!-- Already Registered Link -->
        <div style="text-align: center; margin-top: 25px; margin-bottom: 10px;">
            <a href="{{ route('admin.login') }}" class="forgot-link" style="color: rgba(0, 255, 255, 0.8);">
                Already have an account? Sign in
            </a>
        </div>

        <!-- Security Badge -->
        <div class="security-badge">
            <svg viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9v3c0 .78.16 1.53.46 2.22L4.12 16.8C3.7 17.82 4.46 19 5.56 19h12.88c1.1 0 1.86-1.18 1.44-2.2l-1.34-3.58c.3-.69.46-1.44.46-2.22V9c0-3.87-3.13-7-7-7z"/>
                <circle cx="12" cy="15" r="1.5" fill="#00ffff"/>
            </svg>
            <span>Your data is encrypted and secure</span>
        </div>
    </form>

    <!-- Optional JavaScript for password strength indicator -->
    <script>
        // Password strength indicator (optional enhancement)
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthDiv = document.getElementById('password-strength');
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    
                    if (password.length > 0) {
                        strengthDiv.style.display = 'block';
                        
                        // Calculate strength
                        let strength = 0;
                        
                        // Length check
                        if (password.length >= 8) strength += 25;
                        
                        // Contains number
                        if (/\d/.test(password)) strength += 25;
                        
                        // Contains lowercase
                        if (/[a-z]/.test(password)) strength += 25;
                        
                        // Contains uppercase or special char
                        if (/[A-Z]/.test(password) || /[^A-Za-z0-9]/.test(password)) strength += 25;
                        
                        // Update UI
                        strengthFill.style.width = strength + '%';
                        
                        if (strength < 50) {
                            strengthFill.style.background = '#ff00ff';
                            strengthText.textContent = 'Weak password';
                            strengthText.style.color = '#ff00ff';
                        } else if (strength < 75) {
                            strengthFill.style.background = '#ffff00';
                            strengthText.textContent = 'Medium password';
                            strengthText.style.color = '#ffff00';
                        } else {
                            strengthFill.style.background = '#00ffff';
                            strengthText.textContent = 'Strong password';
                            strengthText.style.color = '#00ffff';
                        }
                    } else {
                        strengthDiv.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <!-- Additional styles specific to register page -->
    <style>
        /* Password Strength Indicator */
        .password-strength {
            margin-top: -10px;
            margin-bottom: 20px;
            padding: 0 5px;
        }

        .strength-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0;
            background: #00ffff;
            transition: width 0.3s ease, background 0.3s ease;
            border-radius: 2px;
            box-shadow: 0 0 10px currentColor;
        }

        .strength-text {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Animation for form groups */
        .form-group {
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cyber button enhancement for register page */
        .cyber-button {
            background: linear-gradient(45deg, #ff00ff, #00ffff);
            animation: buttonPulse 2s infinite;
            margin-top: 10px;
        }

        @keyframes buttonPulse {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 0, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(0, 255, 255, 0.5);
            }
        }

        /* Responsive adjustments for mobile */
        @media (max-width: 768px) {
            .cyber-card {
                max-height: 90vh;
                overflow-y: auto;
                padding: 25px 20px;
                scrollbar-width: thin;
                scrollbar-color: #00ffff rgba(255, 255, 255, 0.1);
            }

            .cyber-card::-webkit-scrollbar {
                width: 5px;
            }

            .cyber-card::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
            }

            .cyber-card::-webkit-scrollbar-thumb {
                background: linear-gradient(45deg, #00ffff, #ff00ff);
                border-radius: 10px;
            }

            .cyber-card::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(45deg, #ff00ff, #00ffff);
            }

            .form-group {
                margin-bottom: 20px;
            }

            .cyber-input {
                padding: 12px 15px 12px 45px;
                font-size: 14px;
            }

            .input-icon {
                font-size: 16px;
            }

            .cyber-title h2 {
                font-size: 24px;
            }

            .cyber-title p {
                font-size: 12px;
            }

            .cyber-button {
                padding: 14px;
                font-size: 16px;
            }

            .security-badge {
                margin-top: 15px;
                font-size: 10px;
            }
        }

        /* For very small devices */
        @media (max-width: 480px) {
            .cyber-card {
                padding: 20px 15px;
            }

            .form-label {
                font-size: 11px;
            }

            .cyber-input {
                padding: 10px 15px 10px 40px;
                font-size: 13px;
            }

            .input-icon {
                font-size: 14px;
                left: 12px;
            }

            .forgot-link {
                font-size: 13px;
            }
        }

        /* For landscape mode on mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .cyber-card {
                max-height: 85vh;
                padding: 15px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .cyber-title {
                margin-bottom: 15px;
            }

            .cyber-title h2 {
                font-size: 20px;
            }

            .cyber-input {
                padding: 8px 15px 8px 40px;
            }

            .cyber-button {
                padding: 10px;
                margin-top: 5px;
            }

            .security-badge {
                margin-top: 10px;
            }
        }

        /* Ensure the cyber-card is scrollable on all devices if needed */
        .cyber-card {
            max-height: 90vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #00ffff rgba(255, 255, 255, 0.1);
        }

        .cyber-card::-webkit-scrollbar {
            width: 5px;
        }

        .cyber-card::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .cyber-card::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border-radius: 10px;
        }

        /* Smooth scrolling */
        .cyber-card {
            scroll-behavior: smooth;
        }

        /* Better spacing for the form */
        form {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        /* Ensure the security badge is always visible */
        .security-badge {
            margin-top: 20px;
            padding-bottom: 5px;
        }
    </style>
</x-admin-layout>