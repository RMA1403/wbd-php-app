<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="http://localhost:8080/public/styles/home/home.css">
    <title>Homepage</title>
</head>
<body>
    <div class="sidebar">
        <h2>Spotify</h2>
        <ul>
            <li>Home</li>
            <li>Browse</li>
            <li>Search</li>
            <li>Your Library</li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Welcome to Spotify!</h1>
        <!-- Main content of the homepage goes here -->
        <div class="audio-player">
            <h2>Now Playing</h2>
            <audio controls>
                <source src="song.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</body>
</html>