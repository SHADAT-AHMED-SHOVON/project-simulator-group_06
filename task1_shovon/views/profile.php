<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <a href="index.php?page=home" style="font-weight:bold;">← Back to Home</a>
        </div>
        <div class="nav-center">
            <h1>Online Medicine Shop</h1>
        </div>
        <div class="nav-right">
            <a href="index.php?page=logout" style="color:red;">Logout</a>
        </div>
    </div>
    
    <div class="auth-container" style="max-width: 600px;">
        <h2>Edit Profile Information</h2>
        <?php if(!empty($success)): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>
        <?php if(!empty($error)): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?page=profile" enctype="multipart/form-data">
            <input type="hidden" name="update_profile" value="1">
            <div style="display:flex; gap:15px; margin-bottom:15px; align-items:center;">
                <?php if($user_data['profile_picture']): ?>
                    <img src="public/uploads/<?= $user_data['profile_picture'] ?>" style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
                <?php endif; ?>
                <div class="form-group" style="flex:1;">
                    <label>Change Picture</label>
                    <input type="file" name="profile_picture" accept="image/png, image/jpeg">
                </div>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user_data['name']) ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user_data['email']) ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($user_data['address']) ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user_data['phone']) ?>">
            </div>
            <button type="submit" class="btn-submit">Update Profile</button>
        </form>

        <h2 style="margin-top:40px;">Change Password</h2>
        <form method="POST" action="index.php?page=profile">
            <input type="hidden" name="change_password" value="1">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" required minlength="8">
            </div>
            <button type="submit" class="btn-submit" style="background:#4a5568;">Change Password</button>
        </form>
    </div>
</body>
</html>