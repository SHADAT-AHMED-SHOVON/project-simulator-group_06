<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Online Medicine Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <div class="user-widget" style="cursor: default; border: none;">
                <div class="user-img" style="background:#e2e8f0; display:flex; align-items:center; justify-content:center; font-size:20px;">👤</div>
                <div class="user-info">
                    <span class="user-name">Guest Customer</span>
                </div>
            </div>
        </div>
        <div class="nav-center">
            <h1>Online Medicine Shop</h1>
            <p>Customer Order Management Panel</p>
        </div>
        <div class="nav-right" style="display:flex; gap:15px; align-items:center;">
            <a href="index.php?page=orders" style="color: #008c5e; font-weight: bold;">📦 Order List</a>
            <a href="index.php?page=cart" style="background:#008c5e; color:white; padding:10px 20px; border-radius:6px; font-weight:bold; display:flex; align-items:center; gap:8px;">
                🛒 My Cart <span id="cart-badge" style="background:white; color:#008c5e; padding:2px 8px; border-radius:12px; font-size:12px;"><?= $cart_count ?></span>
            </a>
        </div>
    </div>

    <div class="search-filter-bar">
        <input type="text" id="searchInput" placeholder="Search for medicines...">
        <select id="filterCategory">
            <option value="">All Categories</option>
            <?php foreach($categories as $c): ?>
                <option value="<?= $c['name'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <select id="filterType">
            <option value="">All Types</option>
            <option value="solid">Solid</option>
            <option value="liquid">Liquid</option>
        </select>
    </div>

    <div class="container">
        <div class="med-grid" id="medGrid">
            <?php foreach($medicines as $med): ?>
            <div class="med-card" data-name="<?= strtolower($med['name']) ?>" data-vendor="<?= strtolower($med['vendor_name']) ?>" data-category="<?= $med['category_name'] ?>" data-type="<?= $med['category_type'] ?>">
                <div class="med-top">
                    <div class="med-img-box">
                        <?php if($med['image_path']): ?>
                        <img src="public/uploads/medicines/<?= $med['image_path'] ?>" style="width:100%; height:100%; object-fit:contain;">
                        <?php else: ?>
                        <span style="font-size:10px; color:#aaa;">No IMG</span>
                        <?php endif; ?>
                    </div>
                    <div class="med-details">
                        <h3><?= htmlspecialchars($med['name']) ?></h3>
                        <p><strong>Vendor:</strong> <?= htmlspecialchars($med['vendor_name']) ?></p>
                        <p><strong>Category:</strong> <?= htmlspecialchars($med['category_name']) ?></p>
                        <div class="med-price">$<?= $med['price'] ?></div>
                        <p style="font-size:11px; color:#666; margin-top:5px;">Stock: <?= $med['availability'] ?> units</p>
                    </div>
                </div>
                
                <?php if($med['availability'] > 0): ?>
                    <button class="btn-cart" onclick="addToCart(<?= $med['id'] ?>, this)">Add to Cart</button>
                <?php else: ?>
                    <button class="btn-cart" style="background:#ccc; cursor:not-allowed;" disabled>Out of Stock</button>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // 1. Filter Logic
        const searchInput = document.getElementById('searchInput');
        const filterCat = document.getElementById('filterCategory');
        const filterType = document.getElementById('filterType');
        const cards = document.querySelectorAll('.med-card');

        function filterMedicines() {
            let s = searchInput.value.toLowerCase();
            let c = filterCat.value;
            let t = filterType.value.toLowerCase();

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let vendor = card.getAttribute('data-vendor');
                let cat = card.getAttribute('data-category');
                let type = card.getAttribute('data-type').toLowerCase();

                let matchSearch = name.includes(s) || vendor.includes(s);
                let matchCat = (c === "") || (cat === c);
                let matchType = (t === "") || (type === t);

                if(matchSearch && matchCat && matchType) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterMedicines);
        filterCat.addEventListener('change', filterMedicines);
        filterType.addEventListener('change', filterMedicines);

        // 2. Add to Cart Logic (AJAX)
        // 2. Add to Cart Logic (AJAX with Center Popup)
function addToCart(medId, btnElement) {
    let fd = new FormData();
    fd.append('medicine_id', medId);
    fd.append('quantity', 1);

    let originalText = btnElement.innerText;
    btnElement.innerText = "Adding...";
    btnElement.style.opacity = "0.7";

    fetch('index.php?page=api_cart_add', { method: 'POST', body: fd })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Revert button text instantly
            btnElement.innerText = originalText;
            btnElement.style.opacity = "1";
            
            // Update Cart Badge dynamically
            let badge = document.getElementById('cart-badge');
            badge.innerText = parseInt(badge.innerText) + 1;

            // Show Center Popup
            let toast = document.getElementById('cartToast');
            toast.style.display = 'block';

            // Auto vanish after 1 second (1000 milliseconds)
            setTimeout(() => {
                toast.style.display = 'none';
            }, 1000);
            
        } else {
            alert('Error adding to cart!');
            btnElement.innerText = originalText;
            btnElement.style.opacity = "1";
        }
        });
    }
    </script>

<div id="cartToast" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #ffffff; color: #333333; padding: 12px 24px; border-radius: 6px; font-size: 16px; font-weight: bold; z-index: 9999; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 1px solid #dddddd;">
    Added to Cart! ✔
</div>

</body>
</html>