<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoom Pro Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-color: #ffffff;
            --text-color: #202124;
            --search-bg: #fff;
            --search-border: #dfe1e5;
            --search-hover: #e8e8e9;
            --button-bg: #f8f9fa;
            --button-text: #3c4043;
            --button-hover: #f1f3f4;
            --option-bg: #f1f3f4;
            --option-hover: #e8eaed;
        }

        body.dark-mode {
            --background-color: #202124;
            --text-color: #e8eaed;
            --search-bg: #303134;
            --search-border: #5f6368;
            --search-hover: #3c4043;
            --button-bg: #303134;
            --button-text: #e8eaed;
            --button-hover: #3c4043;
            --option-bg: #3c4043;
            --option-hover: #4d5156;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        .top-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--background-color);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1000;
        }

        .top-nav-item {
            margin-left: 20px;
            color: var(--text-color);
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .profile-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .logo {
            font-size: 5rem;
            font-weight: 400;
            color: var(--text-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container {
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-box {
            width: 100%;
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid var(--search-border);
            border-radius: 24px;
            background-color: var(--search-bg);
            color: var(--text-color);
            outline: none;
            transition: box-shadow 0.3s;
        }

        .search-box:hover, .search-box:focus {
            box-shadow: 0 1px 6px rgba(32,33,36,.28);
            border-color: rgba(223,225,229,0);
        }

        .search-options {
            display: none;
            margin-top: 10px;
            background-color: var(--search-bg);
            border: 1px solid var(--search-border);
            border-radius: 8px;
            overflow: hidden;
        }

        .search-option {
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            display: flex;
            align-items: center;
        }

        .search-option:hover {
            background-color: var(--search-hover);
            transform: translateX(5px);
        }

        .search-option-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            background-color: var(--option-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: transform 0.3s;
        }

        .search-option:hover .search-option-icon {
            transform: rotate(360deg);
        }

        .content-area {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-content {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .profile-info {
            text-align: center;
        }

        .profile-decoration {
            position: absolute;
            font-size: 100px;
            opacity: 0.1;
            animation: float 3s ease-in-out infinite;
        }

        .profile-decoration:nth-child(1) { left: 0; top: 0; }
        .profile-decoration:nth-child(2) { right: 0; top: 0; }
        .profile-decoration:nth-child(3) { left: 0; bottom: 0; }
        .profile-decoration:nth-child(4) { right: 0; bottom: 0; }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .profile-picture-large {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--text-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .button {
            background-color: var(--button-bg);
            border: 1px solid var(--button-bg);
            border-radius: 4px;
            color: var(--button-text);
            font-family: arial,sans-serif;
            font-size: 14px;
            margin: 11px 4px;
            padding: 0 16px;
            line-height: 27px;
            height: 36px;
            min-width: 54px;
            text-align: center;
            cursor: pointer;
            user-select: none;
        }

        .button:hover {
            box-shadow: 0 1px 1px rgba(0,0,0,.1);
            background-color: var(--button-hover);
            border: 1px solid #dadce0;
            color: #202124;
        }

        .settings-panel {
            background-color: var(--search-bg);
            border: 1px solid var(--search-border);
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-button {
            background-color: #dc2626;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #b91c1c;
        }

        .developer-card {
            background-color: var(--search-bg);
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            transition: transform 0.3s;
            position: absolute;
            width: 200px;
        }

        .developer-card:hover {
            transform: translateY(-5px);
        }

        .developer-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid var(--text-color);
        }

        .small-text {
            font-size: 13px;
            color: gray;
            
        } 

        @media (max-width: 768px) {
            .search-container {
                max-width: 90%;
            }
            .logo {
                font-size: 3rem;
            }
        }
        .settings-panel {
            background-color: var(--search-bg);
            border: 1px solid var(--search-border);
            border-radius: 16px; /* Increased border-radius for a rounder look */
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .settings-panel:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .title-change-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
            padding: 10px;
            background-color: var(--option-bg);
            border-radius: 25px;
            overflow: hidden;
        }

        #titleInput {
            flex-grow: 1;
            padding: 10px 15px;
            border: none;
            background-color: transparent;
            color: var(--text-color);
            font-size: 16px;
            outline: none;
        }

        .change-title-btn {
            background-color: var(--button-bg);
            color: var(--button-text);
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .change-title-btn:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
        }

        .search-option {
            /* ... (keep existing styles) ... */
            transition: all 0.3s ease;
        }

        .search-option:hover {
            background-color: var(--search-hover);
            transform: translateX(10px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-area {
            /* ... (keep existing styles) ... */
            animation: fadeInUp 0.5s ease-out;
        }

        .logo {
            /* ... (keep existing styles) ... */
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="top-nav">
        <a href="#" class="top-nav-item" onclick="resetDashboard()">Home</a>
        <a href="#" class="top-nav-item" onclick="showLargeProfilePicture()">Account</a>
        <a href="#" class="top-nav-item" onclick="toggleTheme()">Toggle Theme</a>
        <img 
            src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/32' }}" 
            alt="Profile" 
            class="profile-icon"
            onclick="showProfile()"
        >
    </div>

    <div class="container">
        <div class="logo" id="zoomProTitle">Zoom Pro</div>
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search Zoom Pro" onfocus="showSearchOptions()" onblur="hideSearchOptions()">

                <div class="small-text">
                <p>Click on the Search box to view available options.</p>
                </div>
          
            
            <div class="search-options" id="searchOptions">
                <div class="search-option" onclick="showProfile()">
                    <div class="search-option-icon">👤</div>
                    Profile
                </div>

                <div class="search-option" onclick="viewAppScreenshot()">
        <div class="search-option-icon">📱</div>
        View our App
    </div>


                <div class="search-option" onclick="showDevelopers()">
                    <div class="search-option-icon">👥</div>
                    Meet the Developers
                </div>
                <div class="search-option" onclick="toggleTheme()">
                    <div class="search-option-icon">🌓</div>
                    Toggle Dark Mode
                </div>
                <div class="search-option" onclick="showLargeProfilePicture()">
                    <div class="search-option-icon">🖼️</div>
                    Show Profile Picture
                </div>
                <div class="search-option" onclick="showSettings()">
                    <div class="search-option-icon">⚙️</div>
                    Settings
                </div>
            </div>
        </div>
        <div class="content-area" id="contentArea"></div>
        <img class="profile-picture-large" id="largeProfilePicture" src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/200' }}" alt="Large Profile Picture">
    </div>

    <script>
        function showSearchOptions() {
            document.getElementById('searchOptions').style.display = 'block';
        }

        function hideSearchOptions() {
            setTimeout(() => {
                document.getElementById('searchOptions').style.display = 'none';
            }, 200);
        }

        function showProfile() {
            const contentArea = document.getElementById('contentArea');
            contentArea.style.display = 'block';
            contentArea.innerHTML = `
                <div class="profile-content">
                    <div class="profile-decoration">👤</div>
                    <div class="profile-decoration">📧</div>
                    <div class="profile-decoration">🔑</div>
                    <div class="profile-decoration">🌐</div>
                    <div class="profile-info">
                        <h2>Profile</h2>
                        <img src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/120' }}" alt="Profile Picture" style="width:120px;height:120px;border-radius:50%;border:3px solid var(--text-color);">
                        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Google ID:</strong> {{ auth()->user()->google_id ?? 'Not available' }}</p>
                    </div>
                </div>
            `;
            document.getElementById('largeProfilePicture').style.display = 'none';
        }


        function viewAppScreenshot() {
            const contentArea = document.getElementById('contentArea');
            contentArea.style.display = 'block';
            contentArea.innerHTML = `
                <h2 style="text-align: center; margin-bottom: 20px;">Sneak Peek of Our App</h2>
                <div style="text-align: center;">
                    <img src="{{ asset('images/app_screenshot.png') }}" alt="App Screenshot" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                </div>
            `;
        }



        function showDevelopers() {
            const contentArea = document.getElementById('contentArea');
            contentArea.style.display = 'block';
            contentArea.innerHTML = `
                <h2>Meet the Developers</h2>
                <div id="developerContainer" style="position: relative; height: 300px;">
                    <div class="developer-card" style="left: 0; top: 0;">
                        <img src="{{ asset('images/andre.jpg') }}" alt="Andre Salvador" class="developer-image">
                        <h3>Andre Salvador</h3>
                        <p>Frontend Developer</p>
                    </div>
                    <div class="developer-card" style="left: 50%; top: 0; transform: translateX(-50%);">
                        <img src="{{ asset('images/jeff.jpg') }}" alt="Jeffrey Romerosa" class="developer-image">
                        <h3>Jeffrey Romerosa</h3>
                        <p>Backend Developer</p>
                    </div>
                    <div class="developer-card" style="right: 0; top: 0;">
                        <img src="{{ asset('images/dave.jpg') }}" alt="Dave Salte" class="developer-image">
                        <h3>Dave Salte</h3>
                        <p>Backend Developer</p>
                    </div>
                </div>
            `;
            document.getElementById('largeProfilePicture').style.display = 'none';
            rotateDevelopers();
        }

        function rotateDevelopers() {
            const container = document.getElementById('developerContainer');
            if (!container) return;

            setInterval(() => {
                const cards = container.querySelectorAll('.developer-card');
                const positions = ['left: 0; top: 0;', 'left: 50%; top: 0; transform: translateX(-50%);', 'right: 0; top:0;'];
                cards.forEach((card, index) => {
                    card.style.cssText = positions[(index + 1) % 3];
                    card.style.transition = 'all 0.5s ease-in-out';
                });
            }, 5000);
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        }

        function showLargeProfilePicture() {
            document.getElementById('contentArea').style.display = 'none';
            const largeProfilePicture = document.getElementById('largeProfilePicture');
            largeProfilePicture.style.display = 'block';
            document.getElementById('contentArea').innerHTML = `
                <h2 style="text-align: center; margin-bottom: 20px;">Your Google Account Profile</h2>
                <p style="text-align: center; margin-bottom: 20px;">This is the profile picture associated with your Google account.</p>
            `;
            document.getElementById('contentArea').style.display = 'block';
        }

        function showSettings() {
            const contentArea = document.getElementById('contentArea');
            contentArea.style.display = 'block';
            contentArea.innerHTML = `
                <h2>Settings</h2>
                <div class="settings-panel">
                    <p>Personalize the title above to suit your preferences.</p>
                    <div class="title-change-container">
                        <input type="text" id="titleInput" value="Zoom Pro" placeholder="Enter new title">
                        <button onclick="changeTitle()" class="change-title-btn">Change</button>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            `;
            document.getElementById('largeProfilePicture').style.display = 'none';
        }

        function changeTitle() {
            const newTitle = document.getElementById('titleInput').value;
            const zoomProTitle = document.getElementById('zoomProTitle');
            zoomProTitle.textContent = newTitle;
            zoomProTitle.style.animation = 'fadeInUp 0.5s ease-out';
            setTimeout(() => {
                zoomProTitle.style.animation = '';
            }, 500);
        }

        function resetDashboard() {
            document.getElementById('contentArea').style.display = 'none';
            document.getElementById('largeProfilePicture').style.display = 'none';
        }

        window.addEventListener('load', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }
        });

        document.querySelector('.profile-icon').addEventListener('click', function() {
            showProfile();
        });
    </script>
</body>
</html>

