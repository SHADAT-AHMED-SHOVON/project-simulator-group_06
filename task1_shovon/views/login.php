<!DOCTYPE html>
<html>
<head>
    <title>Login - CUREPOINT Pharmacy</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="navbar">
        <div class="nav-center">
            <h1>CUREPOINT Pharmacy</h1>
        </div>
    </div>
    
    <div class="auth-container">
        <h2>Welcome Back</h2>
        <?php if(!empty($error)): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?page=login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="remember_me" id="remember_me" style="width: auto;">
                <label for="remember_me" style="margin-bottom: 0; font-weight: normal; cursor: pointer;">Keep me logged in</label>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            New here? <a href="index.php?page=register">Create an account</a>
        </p>
    </div>
</body>
</html>