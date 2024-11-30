<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f5f7fa;
            --text-color: #333;
            --accent-color: #FF5733;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--secondary-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        h1 {
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card h2 {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .logout-button {
            padding: 0.5rem 1rem;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c4431c;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 1rem;
            background-color: white;
            color: #888;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
            }

            .logout-button {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Your Application</div>
        <!-- Logout button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </header>

    <div class="container">
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        <p>This is your dashboard. You can manage your profile, settings, and more.</p>

        <div class="dashboard-content">
            <div class="dashboard-card">
                <h2>Profile</h2>
                <p>View and edit your profile information</p>
            </div>
            <div class="dashboard-card">
                <h2>Settings</h2>
                <p>Manage your account settings</p>
            </div>
            <div class="dashboard-card">
                <h2>Analytics</h2>
                <p>View your activity and statistics</p>
            </div>
            <div class="dashboard-card">
                <h2>Messages</h2>
                <p>Check your inbox and notifications</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Application. All rights reserved.</p>
    </footer>
</body>
</html>