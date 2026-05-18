<!DOCTYPE html>
<html>
<head><title>My Orders</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="navbar">
        <div class="nav-left"><a href="index.php?page=home" style="color:#008c5e; font-weight:bold;">← Back to Shop</a></div>
        <div class="nav-center"><h1>My Order History</h1></div>
        
    </div>
    
    <div class="container" style="max-width: 900px; margin-top: 40px;">
        <?php if(empty($orders)): ?>
            <p style="text-align:center; padding:40px; background:white; border-radius:8px;">You have no orders yet.</p>
        <?php else: ?>
            <table style="width:100%; background:white; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.05); border-collapse:collapse;">
                <tr style="background:#008c5e; color:white;">
                    <th style="padding:15px; text-align:left;">Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach($orders as $o): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:15px; font-weight:bold;">#<?= $o['id'] ?></td>
                    <td style="text-align:center;"><?= date('d M, Y', strtotime($o['order_date'] ?? 'now')) ?></td>
                    <td style="text-align:center; color:#008c5e; font-weight:bold;">$<?= number_format($o['total_amount'], 2) ?></td>
                    
                    <td style="text-align:center;">
                        <?php if($o['status'] == 'pending'): ?>
                            <span style="background:#fefcbf; color:#975a16; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">Pending</span>
                        <?php elseif($o['status'] == 'rejected'): ?>
                            <span style="background:#fed7d7; color:#9b2c2c; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">Cancelled</span>
                        <?php elseif($o['status'] == 'accepted'): ?>
                            <span style="background:#c6f6d5; color:#22543d; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">Completed</span>
                        <?php endif; ?>
                    </td>

                    <td style="text-align:center;">
                        <?php if($o['status'] == 'pending'): ?>
                            <a href="index.php?page=cancel_order&id=<?= $o['id'] ?>" onclick="return confirm('Are you sure you want to cancel this order?')" style="background:#e53e3e; color:white; padding:6px 12px; border-radius:4px; font-size:13px; text-decoration:none;">Cancel</a>
                        
                        <?php elseif($o['status'] == 'accepted'): ?>
                            <a href="index.php?page=view_invoice&id=<?= $o['id'] ?>" style="background:#3182ce; color:white; padding:6px 12px; border-radius:4px; font-size:13px; text-decoration:none;">Invoice</a>
                        
                        <?php else: ?>
                            <span style="color:#a0aec0; font-size:13px; font-weight:bold;">No Action</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>