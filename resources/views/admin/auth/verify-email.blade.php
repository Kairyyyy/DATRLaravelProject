<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email - Admin | MISOUT</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=orbitron:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(125deg, #0a0a0a, #1a0033, #000066);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .cyber-card {
            max-width: 400px;
            width: 100%;
            background: rgba(10, 10, 20, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
        }
        .cyber-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .cyber-title h2 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
        }
        .info-box {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            margin-bottom: 20px;
        }
        .info-box .label {
            color: rgba(0, 255, 255, 0.6);
            font-size: 11px;
            text-transform: uppercase;
        }
        .info-box .value {
            color: #00ffff;
            font-size: 14px;
            font-weight: 600;
            word-break: break-all;
        }
        .success-msg {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid #00ff00;
            border-radius: 6px;
            padding: 10px;
            color: #00ff00;
            text-align: center;
            font-size: 13px;
            margin-bottom: 15px;
        }
        .error-msg {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff0000;
            border-radius: 6px;
            padding: 10px;
            color: #ff0000;
            text-align: center;
            font-size: 13px;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            color: rgba(0, 255, 255, 0.8);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-align: center;
        }
        .code-input {
            width: 180px;
            margin: 0 auto;
            display: block;
            padding: 12px;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            font-size: 28px;
            font-family: monospace;
            text-align: center;
            letter-spacing: 6px;
        }
        .code-input:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }
        .error-text {
            color: #ff00ff;
            font-size: 11px;
            text-align: center;
            margin-top: 5px;
        }
        .cyber-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .cyber-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(255, 0, 255, 0.5);
        }
        .resend-btn {
            background: none;
            border: none;
            color: rgba(0, 255, 255, 0.6);
            font-size: 12px;
            cursor: pointer;
            margin-top: 12px;
            display: block;
            width: 100%;
            text-align: center;
        }
        .resend-btn:hover {
            color: #00ffff;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid rgba(0, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.3);
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="cyber-card">
        <div class="cyber-title">
            <h2>VERIFY EMAIL</h2>
        </div>

        @if (session('status'))
            <div class="success-msg">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-msg">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="info-box">
            <div class="label">CODE SENT TO</div>
            <div class="value">{{ Auth::guard('admin')->user()->email }}</div>
        </div>

        <form method="POST" action="{{ route('admin.verification.verify') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">6-DIGIT CODE</label>
                <input id="verification_code" 
                       type="text" 
                       name="verification_code" 
                       value="{{ old('verification_code') }}" 
                       required 
                       autofocus
                       maxlength="6"
                       pattern="[0-9]{6}"
                       inputmode="numeric"
                       autocomplete="off"
                       class="code-input"
                       placeholder="000000">
                @error('verification_code')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="cyber-button">VERIFY</button>
        </form>

        <form method="POST" action="{{ route('admin.verification.resend') }}">
            @csrf
            <button type="submit" class="resend-btn">⟳ RESEND CODE</button>
        </form>

        <div class="footer">
            <p>Code expires in 30 mins • Unverified accounts deleted after 24h</p>
        </div>
    </div>

    <script>
        document.getElementById('verification_code')?.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) this.form.submit();
        });
    </script>
</body>
</html>