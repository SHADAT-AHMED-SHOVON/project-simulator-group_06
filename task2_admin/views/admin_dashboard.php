<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .grid-cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);
            color: white;
            padding: 30px;
            flex: 1;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card h1 {
            font-size: 40px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="index.php?page=admin_dashboard">Dashboard</a>
        <a href="index.php?page=admin_categories">Categories</a>
        <a href="index.php?page=admin_medicines">Medicines</a>
        <a href="index.php?page=admin_customers">Customers</a>
        <a href="index.php?page=admin_orders">Orders</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>System Overview</h2>
            <div class="grid-cards">
                <div class="card">
                    <h3>Medicines</h3>
                    <h1><?= $stats['medicines'] ?></h1>
                </div>
                <div class="card">
                    <h3>Categories</h3>
                    <h1><?= $stats['categories'] ?></h1>
                </div>
                <div class="card">
                    <h3>Customers</h3>
                    <h1><?= $stats['customers'] ?></h1>
                </div>
                <div class="card" style="background: linear-gradient(135deg, var(--secondary) 0%, #008c5e 100%);">
                    <h3>Pending Orders</h3>
                    <h1><?= $stats['orders'] ?></h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>