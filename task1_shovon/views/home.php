<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Online Medicine Shop</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <?php if(isset($_SESSION['user_id']) && $current_user): ?>
                <a href="index.php?page=profile" class="user-widget">
                    <?php if(!empty($current_user['profile_picture'])): ?>
                        <img src="public/uploads/<?= $current_user['profile_picture'] ?>" class="user-img">
                    <?php else: ?>
                        <div class="user-img" style="background:#e2e8f0; display:flex; align-items:center; justify-content:center; font-size:20px;">👤</div>
                    <?php endif; ?>
                    <div class="user-info">
                        <span class="user-name"><?= htmlspecialchars($current_user['name']) ?></span>
                        <span class="user-role"><?= htmlspecialchars($current_user['role']) ?></span>
                    </div>
                </a>
            <?php endif; ?>
        </div>
        <div class="nav-center">
            <h1>CUREPOINT Pharmacy</h1>
            <p>Your Trusted Healthcare Partner</p>
        </div>
        <div class="nav-right" style="display:flex; align-items:center; gap:15px;">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="index.php?page=login" style="font-weight:bold; color: white;">Login</a>
                <a href="index.php?page=register" style="background:#008c5e; color:white; padding:8px 15px; border-radius:5px; font-weight:bold;">Sign Up</a>
            <?php else: ?>
                
                <?php if($_SESSION['role'] === 'admin'): ?>
                    <a href="/online_medicineshop/medicine_admin/index.php" style="background:#3182ce; color:white; padding:8px 15px; border-radius:5px; font-weight:bold;">⚙️ Manage</a>
                <?php else: ?>
                    <a href="/online_medicineshop/medicine_customer/index.php?page=orders" style="color: #008c5e; font-weight: bold; white-space: nowrap;">📦 Order List</a>
    
    <a href="/online_medicineshop/medicine_customer/index.php?page=cart" style="background:#008c5e; color:white; padding:10px 20px; border-radius:6px; font-weight:bold; display:flex; align-items:center; gap:8px; white-space: nowrap;">
        🛒 My Cart <span id="cart-badge" style="background:white; color:#008c5e; padding:2px 8px; border-radius:12px; font-size:12px;"><?= $cart_count ?? 0 ?></span>
    </a>
                <?php endif; ?>

                <a href="index.php?page=logout" style="background: #e53e3e; color: white; padding: 8px 15px; border-radius: 5px; font-weight: bold; text-decoration: none; display: inline-block;">Logout</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="search-filter-bar">
        <input type="text" id="searchInput" placeholder="Search for medicines..">
        <select id="filterCategory">
            <option value="">All Categories</option>
            <?php foreach($categories as $c): ?>
                <option value="<?= $c['name'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <select id="filterVendor">
            <option value="">All Vendors</option>
            <?php 
            $vendors = array_unique(array_column($medicines, 'vendor_name'));
            foreach($vendors as $v): 
            ?>
                <option value="<?= strtolower(htmlspecialchars($v)) ?>"><?= htmlspecialchars($v) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="container">
        <div class="med-grid" id="medGrid">
            <?php foreach($medicines as $med): ?>
            <div class="med-card" data-name="<?= strtolower($med['name']) ?>" data-vendor="<?= strtolower($med['vendor_name']) ?>" data-category="<?= $med['category_name'] ?>" data-type="<?= $med['category_type'] ?>">
                <div class="med-top">
                    <div class="med-img-box">
                        <?php if($med['image_path']): ?>
                            <img src="public/uploads/medicines/<?= $med['image_path'] ?>">
                        <?php else: ?>
                            <span style="font-size:10px; color:#aaa;">No Image</span>
                        <?php endif; ?>
                    </div>
                    <div class="med-details">
                    <h3><?= htmlspecialchars($med['name']) ?></h3>
                    <p><strong>Vendor:</strong> <?= htmlspecialchars($med['vendor_name']) ?></p>
                    <p><strong>Category:</strong> <?= htmlspecialchars($med['category_name']) ?> <span class="badge"><?= ucfirst($med['category_type']) ?></span></p>
                    <div class="med-price">৳<?= $med['price'] ?></div>
                    <p style="font-size:11px; color:#666; margin-top:5px;"><strong>Stock:</strong> <?= $med['availability'] ?> units</p>
                    </div>
                </div>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="/online_medicineshop/medicine_admin/index.php?page=admin_medicines&edit_id=<?= $med['id'] ?>" class="btn-cart" style="background: #3182ce; color: white; text-align: center; display: block; text-decoration: none; padding: 10px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">✏️ Edit Medicine</a>
                <?php else: ?>
                    <?php if($med['availability'] > 0): ?>
                        <button class="btn-cart" onclick="addToCart(<?= $med['id'] ?>, this)">Add to Cart</button>
                    <?php else: ?>
                        <button class="btn-cart" style="background:#ccc; cursor:not-allowed;" disabled>Out of Stock</button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const filterCat = document.getElementById('filterCategory');
        const filterVendor = document.getElementById('filterVendor'); 
        const cards = document.querySelectorAll('.med-card');

        function filterMedicines() {
            let s = searchInput.value.toLowerCase();
            let c = filterCat.value;
            let v = filterVendor.value.toLowerCase(); 

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let vendor = card.getAttribute('data-vendor');
                let cat = card.getAttribute('data-category');

                let matchSearch = name.includes(s) || vendor.includes(s);
                let matchCat = (c === "") || (cat === c);
                let matchVendor = (v === "") || (vendor === v); 

                if(matchSearch && matchCat && matchVendor) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterMedicines);
        filterCat.addEventListener('change', filterMedicines);
        filterVendor.addEventListener('change', filterMedicines); 

        function addToCart(medId, btnElement) {
            <?php if(!isset($_SESSION['user_id'])): ?>
                // If not logged in
                alert("You need to login first!");
                window.location.href = 'index.php?page=login';
                
            <?php elseif($_SESSION['role'] === 'admin'): ?>
                // If Admin, redirect to edit page in Task 2
                window.location.href = '/medicine_admin/index.php?page=admin_medicines&edit_id=' + medId;
                
            <?php else: ?>
                // If Customer, send AJAX request to Task 3 API
                let fd = new FormData();
                fd.append('medicine_id', medId);
                fd.append('quantity', 1);

                let originalText = btnElement.innerText;
                btnElement.innerText = "Adding...";
                btnElement.style.opacity = "0.7";

                fetch('/online_medicineshop/medicine_customer/index.php?page=api_cart_add', { method: 'POST', body: fd })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        btnElement.innerText = "Added! ✔";
                        btnElement.style.background = "#059669";

                        let badge = document.getElementById('cart-badge');
                        if(badge) badge.innerText = parseInt(badge.innerText) + 1;

                        let toast = document.getElementById('cartToast');
                        if(toast) {
                            toast.style.display = 'block';
                            setTimeout(() => { toast.style.display = 'none'; }, 1000);
                        }

                        setTimeout(() => {
                            btnElement.innerText = originalText;
                            btnElement.style.background = "#008c5e";
                            btnElement.style.opacity = "1";
                        }, 2000);
                    } else {
                        alert('Error adding to cart: ' + data.message);
                        btnElement.innerText = originalText;
                        btnElement.style.opacity = "1";
                    }
                }).catch(error => console.error('Error:', error));
            <?php endif; ?>
        }
    </script>
</body>
</html>