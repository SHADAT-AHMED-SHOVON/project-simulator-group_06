<!DOCTYPE html>
<html>
<head><title>Order Success</title><link rel="stylesheet" href="style.css"></head>
<body style="background: #f0fdf4;">
    <div class="navbar"><div class="nav-center"><h1>Online Medicine Shop</h1></div></div>
    <div class="container" style="max-width: 600px; margin: 80px auto; text-align:center; padding:50px; background:white; border-radius:10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div style="font-size: 60px; color: #008c5e; margin-bottom:20px;">✅</div>
        <h1 style="color: #008c5e;">Order Placed Successfully!</h1>
        <p style="color:#555; margin-top:10px;">Thank you for your purchase. Your order has been received.</p>
        
        <div style="background:#f4f7f6; padding:20px; border-radius:8px; margin-top:30px; text-align:left; line-height: 1.8;">
            <p><strong>Order ID:</strong> #<?= $order_id ?></p>
            <p><strong>Medicines Ordered:</strong> <?= htmlspecialchars($medicine_list_string) ?></p>
            <p><strong>Total Paid:</strong> $<?= number_format($total, 2) ?> (<?= htmlspecialchars($payment_method) ?>)</p>
            <p><strong>Status:</strong> <span class="badge" style="background:#fefcbf; color:#975a16; padding:5px 10px;">Pending Admin Approval</span></p>
        </div>
        
        <a href="index.php?page=home" class="btn-submit" style="display:inline-block; margin-top:30px; padding:12px 30px; border-radius:30px;">← Back to Shop</a>
    </div>
</body>
</html>