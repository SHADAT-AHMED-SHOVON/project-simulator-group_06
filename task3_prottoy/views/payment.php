<!DOCTYPE html>
<html>
<head><title>Payment</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="navbar"><div class="nav-center"><h1>Payment Method</h1></div></div>
    <div class="auth-container" style="max-width: 450px;">
        <h2>Select Payment Option</h2>
        <form method="POST" action="index.php?page=success" onsubmit="return checkPayment()">
            <div style="margin-bottom:20px; display:flex; flex-direction:column; gap:15px;">
                <label style="padding:15px; border:1px solid #ccc; border-radius:6px; cursor:pointer;"><input type="radio" name="payment_method" value="Cash on Delivery"> 💵 Cash on Delivery</label>
                <label style="padding:15px; border:1px solid #ccc; border-radius:6px; cursor:pointer;"><input type="radio" name="payment_method" value="bKash"> 📱 bKash</label>
                <label style="padding:15px; border:1px solid #ccc; border-radius:6px; cursor:pointer;"><input type="radio" name="payment_method" value="Nagad"> 📱 Nagad</label>
                <label style="padding:15px; border:1px solid #ccc; border-radius:6px; cursor:pointer;"><input type="radio" name="payment_method" value="Credit Card"> 💳 Credit/Debit Card</label>
            </div>
            <button type="submit" class="btn-submit" style="background:#008c5e;">Place Order</button>
        </form>
    </div>
    <script>
        function checkPayment() {
            let options = document.getElementsByName('payment_method');
            let selected = false;
            for(let i=0; i<options.length; i++) { if(options[i].checked) selected = true; }
            if(!selected) { alert("Please select a payment method!"); return false; }
            return true;
        }
    </script>
</body>
</html>