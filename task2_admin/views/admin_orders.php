<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Manage Orders</title>
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
            <h2>Purchase Requests</h2>
            <table class="result-table">
                <thead>
                    <tr><th>Order ID</th><th>Customer</th><th>Total</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $o): ?>
                    <tr>
                        <td><strong>#<?= $o['id'] ?></strong></td>
                        <td><?= htmlspecialchars($o['customer_name']) ?></td>
                        <td>৳<?= $o['total_amount'] ?></td>
                        <td id="status-<?= $o['id'] ?>">
                            <?php 
                                $statusClass = ($o['status'] == 'pending') ? 'badge-solid' : (($o['status'] == 'accepted') ? 'badge-success' : 'badge-danger');
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= ucfirst($o['status']) ?></span>
                        </td>
                        <td>
                            <?php if($o['status'] === 'pending'): ?>
                                <button onclick="updateStatus(<?= $o['id'] ?>, 'accepted')" class="btn btn-add">Accept</button>
                                <button onclick="updateStatus(<?= $o['id'] ?>, 'rejected')" class="btn btn-delete">Reject</button>
                            <?php else: ?>
                                <span class="badge badge-success">Processed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function updateStatus(id, status) {
        if(!confirm('Mark this order as ' + status + '?')) return;
        let fd = new FormData(); fd.append('order_id', id); fd.append('status', status);
        fetch('index.php?page=admin_orders&ajax_status=1', { method: 'POST', body: fd })
        .then(r => r.json()).then(d => {
            if(d.success) { location.reload(); } else { alert('Error updating status.'); }
        });
    }
    </script>
</body>
</html>