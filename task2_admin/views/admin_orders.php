<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style.css">
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
            <h2>Purchase Requests</h2>
            <table class="result-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
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
        let fd = new FormData();
        fd.append('order_id', id);
        fd.append('status', status);
        fetch('index.php?page=admin_orders&ajax_status=1', {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(d => {
            if(d.success) {
                location.reload();
            } else {
                alert('Error updating status.');
            }
        });
    }
    </script>
</body>
</html>