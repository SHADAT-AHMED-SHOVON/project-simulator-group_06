<!DOCTYPE html>
<html>
<head><title>Checkout</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="navbar"><div class="nav-center"><h1>Checkout</h1></div></div>
    <div class="auth-container" style="max-width: 500px; margin-top: 50px;">
        <h2>Shipping Information</h2>
        <form method="POST" action="index.php?page=invoice" onsubmit="return validateAddress()">
            <div class="form-group">
                <label>Delivery Address:</label>
                <textarea id="address" name="address" rows="3" class="form-group input" style="width:100%; padding:10px; border-radius:5px;" required><?= htmlspecialchars($address) ?></textarea>
                <small style="color:red; display:none;" id="addrError">Address cannot be empty!</small>
            </div>
            <button type="submit" class="btn-submit">Proceed to Invoice</button>
            <a href="index.php?page=cart" style="display:block; text-align:center; margin-top:15px; color:#e53e3e;">Cancel & Return to Cart</a>
        </form>
    </div>
    <script>
        function validateAddress() {
            if(document.getElementById('address').value.trim() === "") {
                document.getElementById('addrError').style.display = 'block'; return false;
            }
            return true;
        }
    </script>
</body>
</html>