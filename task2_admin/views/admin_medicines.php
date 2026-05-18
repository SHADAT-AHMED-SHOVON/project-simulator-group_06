<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Manage Medicines</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Image Thumbnail Style */
        .med-img-box {
            width: 50px; height: 50px; border-radius: 6px; object-fit: cover; 
            border: 1px solid #ccc; background: #f0f0f0; display: block;
        }
        .form-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid var(--border); margin-bottom: 20px; }
    </style>
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
        <div class="container" style="background: transparent; border: none; box-shadow: none; padding: 0;">
            
            <?php if(isset($edit_data) && $edit_data): ?>
                <div class="form-card" style="border-left: 4px solid var(--info);">
                    <h2>Edit Medicine: <?= htmlspecialchars($edit_data['name']) ?></h2>
                    <p style="color: #666; font-size: 14px; margin-bottom: 15px;">You can only update Price, Stock, and Image.</p>
                    
                    <form method="POST" action="index.php?page=admin_medicines" enctype="multipart/form-data">
                        <input type="hidden" name="update_medicine" value="1">
                        <input type="hidden" name="med_id" value="<?= $edit_data['id'] ?>">
                        
                        <label>Price (৳):</label>
                        <input type="number" step="0.01" name="price" value="<?= $edit_data['price'] ?>" required>
                        
                        <label>Stock:</label>
                        <input type="number" name="stock" value="<?= $edit_data['availability'] ?>" required>
                        
                        <label>Change Image (Leave blank to keep current image):</label>
                        <?php if($edit_data['image_path']): ?>
                            <img src="public/uploads/medicines/<?= $edit_data['image_path'] ?>" style="width:60px; height:60px; border-radius:4px; margin-bottom:10px;">
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/png, image/jpeg" style="margin-bottom: 15px; display:block;">
                        
                        <button type="submit" class="btn btn-edit">Update Data</button>
                        <a href="index.php?page=admin_medicines" class="btn btn-delete" style="background: #999;">Cancel</a>
                    </form>
                </div>
            <?php else: ?>
                <div class="form-card">
                    <h2>Add New Medicine</h2>
                    <form method="POST" action="index.php?page=admin_medicines" enctype="multipart/form-data">
                        <input type="hidden" name="add_medicine" value="1">
                        
                        <label>Name:</label>
                        <input type="text" name="name" required>
                        
                        <label>Category:</label>
                        <select name="category_id" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <label>Vendor:</label>
                        <input type="text" name="vendor" required>
                        
                        <label>Price (৳):</label>
                        <input type="number" step="0.01" name="price" required>
                        
                        <label>Stock:</label>
                        <input type="number" name="stock" required>
                        
                        <label>Description:</label>
                        <textarea name="desc"></textarea>
                        
                        <label>Image (Max 2MB):</label>
                        <input type="file" name="image" accept="image/png, image/jpeg" style="margin-bottom: 15px; display:block;">
                        
                        <button type="submit" class="btn btn-add">Add Medicine</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="form-card">
                <h2>Medicine List</h2>
                <table class="result-table">
                    <thead>
                        <tr><th>Image</th><th>Name</th><th>Category</th><th>Vendor</th><th>Price</th><th>Stock</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($medicines as $med): ?>
                        <tr>
                            <td>
                                <?php if($med['image_path']): ?>
                                    <img src="public/uploads/medicines/<?= $med['image_path'] ?>" class="med-img-box" alt="Med">
                                <?php else: ?>
                                    <div class="med-img-box" style="display:flex; align-items:center; justify-content:center; font-size:10px; color:#999;">No IMG</div>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= htmlspecialchars($med['name']) ?></strong></td>
                            <td><span class="badge badge-success"><?= htmlspecialchars($med['cat_name']) ?></span></td>
                            <td><?= htmlspecialchars($med['vendor_name']) ?></td>
                            <td style="color:green; font-weight:bold;">৳<?= $med['price'] ?></td>
                            <td><?= $med['availability'] ?> units</td>
                            <td>
                                <a href="index.php?page=admin_medicines&edit_id=<?= $med['id'] ?>" class="btn btn-edit" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                                <a href="index.php?page=admin_medicines&delete_id=<?= $med['id'] ?>" class="btn btn-delete" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Delete all data for this medicine?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>