<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status">
            {{ session('status') }}
        </div>
    @endif

    <div class="cyber-title">
        <h2>Create Account</h2>
        <p>Join the MISOUT community</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
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

        <!-- Password Strength Indicator -->
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

        <!-- Login Link -->
        <div style="text-align: center; margin-top: 25px; margin-bottom: 10px;">
            <a href="{{ route('login') }}" class="forgot-link" style="color: rgba(0, 255, 255, 0.8);">
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

    <!-- Password strength indicator script -->
    <script>
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
</x-guest-layout>