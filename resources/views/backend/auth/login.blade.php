<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Backoffice</title>
    <style>
        /* ... (CSS Anda yang sudah ada, tidak perlu diubah) ... */
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .error-message {
            color: #e3342f;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .toastr-error {
            background-color: #e3342f;
            color: white;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* CSS UNTUK CAPTCHA */
        .captcha-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .captcha-container img {
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .btn-refresh {
            padding: 0.5rem;
            cursor: pointer;
            border: 1px solid #ddd;
            background: #f9f9f9;
            border-radius: 4px;
            font-size: 1.2rem;
            line-height: 1;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login Admin</h2>

        @if (Session::has('toastr'))
            @php $toastr = Session::get('toastr'); @endphp
            <div class="toastr-error">
                {{ $toastr['message'] }}
            </div>
        @endif

        <form method="POST" action="{{ route('backend.auth.prosesLogin') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username atau Email</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="captcha">Verifikasi</label>
                <div class="captcha-container">
                    <span id="captcha-img">{!! captcha_img('flat') !!}</span>
                    <a href="javascript:void(0);" id="reload-captcha"
                        style="margin-left: 10px; text-decoration: none; color: #007bff;">
                        Refresh
                    </a>
                </div>
                <input type="text" id="captcha" name="captcha" required style="margin-top: 0.5rem;">
                @error('captcha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>

    <script>
        document.getElementById('reload-captcha').addEventListener('click', function() {
            fetch("{{ route('backend.auth.reloadCaptcha') }}", {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('captcha-img').innerHTML = data.captcha;
                })
                .catch(error => {
                    console.error('Error reloading captcha:', error);
                });
        });
    </script>
</body>

</html>
