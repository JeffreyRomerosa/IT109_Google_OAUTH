<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Zoom Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-color: #ffffff;
            --text-color: #000000;
            --input-bg: #f5f5f5;
            --input-border: #e0e0e0;
            --input-focus: #000000;
            --button-bg: #000000;
            --button-text: #ffffff;
            --button-hover: #333333;
            --error-color: #ff0000;
            --shape-color: rgba(0, 0, 0, 0.1);
        }

        .dark-mode {
            --background-color: #121212;
            --text-color: #ffffff;
            --input-bg: #2a2a2a;
            --input-border: #3a3a3a;
            --input-focus: #ffffff;
            --button-bg: #ffffff;
            --button-text: #000000;
            --button-hover: #e0e0e0;
            --error-color: #ff6b6b;
            --shape-color: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow: hidden;
        }

        .container {
            background-color: var(--background-color);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }

        h1 {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .error-messages {
            background-color: rgba(255, 0, 0, 0.1);
            color: var(--error-color);
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            font-size: 0.9rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 4px;
            font-size: 1rem;
            color: var(--text-color);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: var(--input-focus);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--button-bg);
            color: var(--button-text);
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        button:hover {
            background-color: var(--button-hover);
        }

        button:active {
            transform: scale(0.98);
        }

        .google-btn {
            background-color: var(--input-bg);
            color: var(--text-color);
            border: 1px solid var(--input-border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
        }

        .google-btn:hover {
            background-color: var(--input-border);
        }

        .google-icon {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        p {
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-color);
            margin-top: 1.5rem;
        }

        a {
            color: var(--text-color);
            text-decoration: underline;
            transition: opacity 0.3s ease;
        }

        a:hover {
            opacity: 0.7;
        }

        .mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            z-index: 1000;
            background-color: var(--background-color);
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mode-toggle label {
            width: 50px;
            height: 26px;
            background-color: var(--input-border);
            display: inline-block;
            border-radius: 13px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 10px;
        }

        .mode-toggle label::after {
            content: '';
            width: 20px;
            height: 20px;
            background-color: var(--background-color);
            position: absolute;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: transform 0.3s ease;
        }

        .mode-toggle input:checked + label {
            background-color: var(--text-color);
        }

        .mode-toggle input:checked + label::after {
            transform: translateX(24px);
        }

        .mode-toggle input {
            display: none;
        }

        .mode-toggle-text {
            color: var(--text-color);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .creative-shape {
            position: fixed;
            width: 300px;
            height: 300px;
            background-color: var(--shape-color);
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            animation: morph 15s ease-in-out infinite;
            transition: all 1s ease-in-out;
            z-index: 0;
        }

        @keyframes morph {
            0% {
                border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            }
            25% {
                border-radius: 40% 60% 60% 40% / 70% 30% 70% 30%;
            }
            50% {
                border-radius: 54% 46% 38% 62% / 49% 70% 30% 51%;
            }
            75% {
                border-radius: 35% 65% 65% 35% / 30% 50% 50% 70%;
            }
            100% {
                border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }
            .mode-toggle {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="mode-toggle">
        <span class="mode-toggle-text">Theme</span>
        <input type="checkbox" id="dark-mode-toggle">
        <label for="dark-mode-toggle"></label>
    </div>
    <div class="creative-shape"></div>
    <div class="container">
        <h1>Login to Zoom Pro</h1>

        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <a href="{{ route('google') }}">
            <button class="google-btn">
                <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                </svg>
                Login with Google
            </button>
        </a>

        <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
    </div>

    <script>
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        darkModeToggle.addEventListener('change', () => {
            body.classList.toggle('dark-mode');
        });

        // Animate the creative shape
        const creativeShape = document.querySelector('.creative-shape');
        let x = Math.random() * (window.innerWidth - 300);
        let y = Math.random() * (window.innerHeight - 300);
        let dx = (Math.random() - 0.5) * 2;
        let dy = (Math.random() - 0.5) * 2;

        function animateShape() {
            x += dx;
            y += dy;

            if (x <= 0 || x >= window.innerWidth - 300) dx = -dx;
            if (y <= 0 || y >= window.innerHeight - 300) dy = -dy;

            creativeShape.style.left = `${x}px`;
            creativeShape.style.top = `${y}px`;

            requestAnimationFrame(animateShape);
        }

        animateShape();
    </script>
</body>
</html>

