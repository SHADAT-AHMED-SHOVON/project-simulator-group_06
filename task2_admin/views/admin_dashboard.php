<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .grid-cards { display: flex; gap: 20px; margin-top: 20px; }
        .card { background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%); color: white; padding: 30px; flex: 1; text-align: center; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card h1 { font-size: 40px; margin-top: 10px; }
    </style>
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
            <h2>System Overview</h2>
            <div class="grid-cards">
                <div class="card"><h3>Medicines</h3><h1><?= $stats['medicines'] ?></h1></div>
                <div class="card"><h3>Categories</h3><h1><?= $stats['categories'] ?></h1></div>
                <div class="card"><h3>Customers</h3><h1><?= $stats['customers'] ?></h1></div>
                <div class="card" style="background: linear-gradient(135deg, var(--secondary) 0%, #008c5e 100%);"><h3>Pending Orders</h3><h1><?= $stats['orders'] ?></h1></div>
            </div>
        </div>
    </div>
</body>
</html>