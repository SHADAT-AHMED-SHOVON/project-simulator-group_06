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
            <h1>Online Medicine Shop</h1>
            <p>Your Trusted Healthcare Partner</p>
        </div>
        <div class="nav-right">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="index.php?page=login" style="padding: 8px 15px; background: #008c5e; color: white; border-radius: 5px;">
                    Login
                </a>
            <?php else: ?>
                <a href="index.php?page=logout" style="padding: 8px 15px; background: #cc1a1a; color: white; border-radius: 5px;">
                    Logout
                </a>
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
                    </div>
                </div>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="#" onclick="alert('Not Done!'); return false;" class="btn-cart" style="background: #4299e1; text-align: center; display: block;">
                    Edit Medicine
                </a>
                <?php else: ?>
                <button class="btn-cart" onclick="addToCart(<?= $med['id'] ?>)">Add to Cart</button>
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

        function addToCart(medId) {
            <?php if(!isset($_SESSION['user_id'])): ?>
                alert("You Nedd to Login First!");
                window.location.href = 'index.php?page=login';
            <?php else: ?>
                alert("Not Done!");
            <?php endif; ?>
        }
    </script>
</body>
</html>