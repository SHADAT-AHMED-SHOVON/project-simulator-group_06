<!DOCTYPE html>
<html>
<head>
    <title>Signup - CUREPOINT Pharmacy</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="navbar">
        <div class="nav-center">
            <h1>CUREPOINT Pharmacy</h1>
        </div>
    </div>

    <div class="auth-container">
        <h2>Create Account</h2>
        <?php if(!empty($error)): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?page=register">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" minlength="8" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            Already have an account? <a href="index.php?page=login">Login</a>
        </p>
    </div>
</body>
</html>