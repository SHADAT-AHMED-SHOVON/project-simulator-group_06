<!DOCTYPE html>
<html>
<head><title>Invoice #<?= $order['id'] ?></title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="navbar">
        <div class="nav-left"><a href="index.php?page=orders" style="color:#008c5e; font-weight:bold;">← Back to Orders</a></div>
        <div class="nav-center"><h1>Invoice #<?= $order['id'] ?></h1></div>
    </div>
    
    <div class="container" style="max-width: 700px; margin: 40px auto; background:white; padding:30px; border-radius:8px; border:1px solid #ddd;">
        <div style="display:flex; justify-content:space-between; border-bottom:2px solid #eee; padding-bottom:15px; margin-bottom:20px;">
            <div>
                <h2 style="color:#008c5e;">Online Medicine Shop</h2>
                <p style="color:#666; font-size:13px; margin-top:5px;">Order Date: <?= date('d M Y, h:i A', strtotime($order['order_date'] ?? 'now')) ?></p>
            </div>
            <div style="text-align:right;">
                <span style="background:#c6f6d5; color:#22543d; padding:6px 12px; border-radius:20px; font-weight:bold;"><?= strtoupper($order['status']) ?></span>
            </div>
        </div>

        <p><strong>Shipping Address:</strong><br><?= nl2br(htmlspecialchars($order['shipping_address'])) ?></p>
        <p style="margin-top:10px;"><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
        
        <table style="width:100%; margin-top:25px; border-collapse:collapse;">
            <tr style="background:#f4f7f6;"><th style="padding:10px; text-align:left;">Item</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th></tr>
            <?php foreach($order['items'] as $item): ?>
            <tr>
                <td style="padding:10px; border-bottom:1px solid #eee;"><?= htmlspecialchars($item['name']) ?></td>
                <td style="text-align:center; border-bottom:1px solid #eee;"><?= $item['quantity'] ?></td>
                <td style="text-align:center; border-bottom:1px solid #eee;">$<?= $item['unit_price'] ?></td>
                <td style="text-align:right; border-bottom:1px solid #eee;">$<?= number_format($item['unit_price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <h2 style="text-align:right; margin-top:20px; color:#333;">Total Paid: <span style="color:#008c5e;">$<?= number_format($order['total_amount'], 2) ?></span></h2>
    </div>
</body>
</html>