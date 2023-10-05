<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/login/login.css">

</head>
<body>
    <div class="wrapper">
        <form action=""> 
            <div class="container">
                <i class='bx bxl-spotify'></i>
                <h1>Podcast</h1>
            </div>
    
            <h2>Podcast For Everyone</h2>                               
            <div class="input-box">
                <input type="text" placeholder="Username" id="username" autocomplete="off" required>
                <label for="username"><i class='bx bxs-user'></i></label>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" id="password" autocomplete="off" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">LOGIN</button>

            <div class="register-link">
                <p>Don't have an account? <a href="<?= BASE_URL?>/signup">Register</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>