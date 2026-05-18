<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Manage Customers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        
    <div style="padding: 30px 30px; border-bottom: 2px solid #3182ce; margin-bottom: 20px;">
    <h3 style="color: #4ade80; margin: 0; font-size: 18px;"><?= htmlspecialchars($_SESSION['name'] ?? 'Admin') ?></h3>
    <span style="color: #94a3b8; font-size: 12px; font-weight: bold; text-transform: uppercase;">
    <?= htmlspecialchars($_SESSION['role'] ?? 'ADMIN') ?>
    </span>
    </div>

        <a href="index.php?page=admin_dashboard">Dashboard</a>
        <a href="index.php?page=admin_categories">Categories</a>
        <a href="index.php?page=admin_medicines">Medicines</a>
        <a href="index.php?page=admin_customers">Customers</a>
        <a href="index.php?page=admin_orders">Orders</a>
        <div class="home">
        <a href="/online_medicineshop/medicine_shovon/index.php?page=home" style="color: #cbd5e1; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 10px 15px; border-radius: 5px; background: rgba(255,255,255,0.05); font-weight: bold; transition: 0.3s;">
        🏠 Back to Home
        </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>Registered Customers</h2>
            <table class="result-table">
                <thead>
                    <tr><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php foreach($customers as $c): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['phone']) ?></td>
                        <td><a href="index.php?page=admin_customers&delete_id=<?= $c['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this customer? This will remove their cart and orders too.')">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>