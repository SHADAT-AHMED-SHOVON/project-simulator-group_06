<!DOCTYPE html>
<html>
<head>
    <title>Login - Online Medicine Shop</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="navbar">
        <div class="nav-center">
            <h1>Online Medicine Shop</h1>
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
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            New here? <a href="index.php?page=register">Create an account</a>
        </p>
    </div>
</body>
</html>