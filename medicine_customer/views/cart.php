<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart - Online Medicine</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-container { max-width: 900px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .cart-item { display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; }
        .cart-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
        .qty-controls { display: flex; align-items: center; gap: 10px; }
        .qty-btn { background: #e2e8f0; border: none; padding: 5px 12px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        .qty-btn:hover { background: #cbd5e0; }
        .remove-btn { color: #e53e3e; cursor: pointer; font-weight: bold; background: none; border: none; }
        .checkout-box { text-align: right; margin-top: 20px; padding-top: 20px; border-top: 2px solid #008c5e; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <a href="/online_medicineshop/medicine_shovon/index.php?page=home" style="color: #008c5e; font-weight: bold; text-decoration: none;">← Back to Shop</a>
        </div>
        <div class="nav-center"><h1>CUREPOINT Pharmacy</h1></div>
        
    </div>

    <div class="cart-container">
        <h2 style="color: #008c5e; margin-bottom: 20px;">Your Shopping Cart</h2>
        
        <?php if(empty($cart_items)): ?>
            <p style="text-align:center; padding: 40px; color: #777;">Your cart is empty.</p>
        <?php else: ?>
            <div id="cart-list">
                <?php foreach($cart_items as $item): ?>
                <div class="cart-item" id="cart-row-<?= $item['id'] ?>">
                    <div style="display:flex; gap:15px; align-items:center; width: 40%;">
                        <?php if($item['image_path']): ?>
                            <img src="public/uploads/medicines/<?= $item['image_path'] ?>" alt="med" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd;">
                        <?php else: ?>
                            <div style="width:60px; height:60px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; font-size:10px;">No IMG</div>
                        <?php endif; ?>
                        <div>
                            <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                            <span style="font-size:12px; color:#666;"><?= htmlspecialchars($item['vendor_name']) ?></span>
                        </div>
                    </div>
                    
                    <div style="width: 15%; font-weight:bold; color: #008c5e;">$<?= $item['price'] ?></div>
                    
                    <div class="qty-controls">
                        <button class="qty-btn" onclick="updateQty(<?= $item['id'] ?>, -1)">-</button>
                        <span id="qty-<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                        <button class="qty-btn" onclick="updateQty(<?= $item['id'] ?>, 1)">+</button>
                    </div>
                    
                    <div style="width: 15%; text-align:right;">
                        <button class="remove-btn" onclick="removeItem(<?= $item['id'] ?>)">✕ Remove</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="checkout-box" style="display:flex; justify-content:space-between; align-items:flex-start; margin-top:30px; border-top: 2px solid #eee; padding-top:20px;">
                <form action="index.php?page=payment" method="POST" style="width: 50%;" onsubmit="return validateAddress()">
                    <h3 style="color:#333; margin-bottom:10px;">Delivery Details</h3>
                    <textarea id="cart_address" name="address" rows="3" placeholder="Enter your full shipping address here..." style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;" required></textarea>
                    <small id="addrErr" style="color:red; display:none;">Address is required!</small>
                    
                    <button type="submit" class="btn-submit" style="margin-top:15px;">Proceed to Payment →</button>
                </form>

                <div style="text-align:right;">
                    <h3>Total Amount: <br><span style="color:#008c5e; font-size: 28px;">$<span id="cart-total"><?= number_format($total_price, 2) ?></span></span></h3>
                </div>
            </div>
            
            <script>
                function validateAddress() {
                    if(document.getElementById('cart_address').value.trim() === '') {
                        document.getElementById('addrErr').style.display = 'block'; return false;
                    }
                    return true;
                }
            </script>
        <?php endif; ?>
    </div>

    <script>
        function updateQty(cartId, change) {
            let currentQty = parseInt(document.getElementById('qty-' + cartId).innerText);
            let newQty = currentQty + change;
            if(newQty < 1) return; // Prevent going below 1
            
            let fd = new FormData();
            fd.append('cart_id', cartId);
            fd.append('quantity', newQty);

            fetch('index.php?page=api_cart_update', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if(data.success) { location.reload(); } // Reload to update totals securely
            });
        }

        function removeItem(cartId) {
            if(!confirm('Remove this item?')) return;
            let fd = new FormData(); fd.append('cart_id', cartId);
            
            fetch('index.php?page=api_cart_remove', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if(data.success) { location.reload(); }
            });
        }
    </script>
</body>
</html>