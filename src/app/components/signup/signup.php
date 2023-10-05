<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/signup/signup.css">
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/signup/signup.js" defer></script>
    
</head>
<body>
    
    <div class="wrapper">
        <form id="form-registration">
            <div class="container">
                <i class='bx bxl-spotify'></i>
                <h1>Podcast</h1>
            </div>

            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" placeholder="Set username" id="username" autocomplete="off" name="username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <label for="password" class="help">Password</label>
                <input type="password" placeholder="Set password" id="password" autocomplete="off" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="input-box">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" placeholder="Enter again your password" id="confirm-password" autocomplete="off" name="confirm-password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="container-radio">
                <p>Register As</p>
                <input type="radio" id="user" name="role" value="User">
                <label for="user">User</label>
                <input type="radio" id="admin" name="role" value="Admin">
                <label for="admin">Creator</label>
            </div>

            <button type="submit" class="btn">SIGNUP</button>

            <div class="login-link">
                <p>Have an account? <a href="<?= BASE_URL?>/login">Login</a></p>
            </div>
        </form>


    </div>
</body>
</html>