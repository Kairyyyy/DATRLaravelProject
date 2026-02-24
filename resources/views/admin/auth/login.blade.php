<x-admin-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status">
            {{ session('status') }}
        </div>
    @endif

    <div class="cyber-title">
        <h2>Admin Login</h2>
        <p>Access the command center</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

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
                    autofocus 
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
                    autocomplete="current-password"
                    placeholder="Enter your password"
                >
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="form-options">
            <label class="remember-me">
                <input type="checkbox" name="remember" id="remember_me">
                <span class="checkmark"></span>
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="cyber-button">
            Login
        </button>

        <!-- Security Badge -->
        <div class="security-badge">
            <svg viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9v3c0 .78.16 1.53.46 2.22L4.12 16.8C3.7 17.82 4.46 19 5.56 19h12.88c1.1 0 1.86-1.18 1.44-2.2l-1.34-3.58c.3-.69.46-1.44.46-2.22V9c0-3.87-3.13-7-7-7z"/>
                <circle cx="12" cy="15" r="1.5" fill="#00ffff"/>
            </svg>
            <span>256-bit encrypted connection</span>
        </div>
    </form>
</x-admin-layout>