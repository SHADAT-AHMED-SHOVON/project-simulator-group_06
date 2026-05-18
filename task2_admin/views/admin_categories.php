<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Manage Categories</title>
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
        <a href="/online_medicineshop/medicine_shovon/index.php?page=home" >
        🏠 Back to Home </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>Add New Category</h2>
            <form method="POST" action="index.php?page=admin_categories">
                <label>Category Name:</label>
                <input type="text" name="name" placeholder="e.g. Paracetamol" required>
                <label>Type:</label>
                <select name="type">
                    <option value="solid">Solid</option>
                    <option value="liquid">Liquid</option>
                    <option value="cream">Cream</option>
                </select>
                <button type="submit" class="btn btn-add">Save Category</button>
            </form>

            <h2 class="mt-20">Category List</h2>
            <table class="result-table">
                <thead>
                    <tr><th>ID</th><th>Name</th><th>Type</th></tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $cat): ?>
                    <tr>
                        <td><?= $cat['id'] ?></td>
                        <td><strong><?= htmlspecialchars($cat['name']) ?></strong></td>
                        <td><span class="badge badge-<?= strtolower($cat['category_type']) ?>"><?= ucfirst($cat['category_type']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>