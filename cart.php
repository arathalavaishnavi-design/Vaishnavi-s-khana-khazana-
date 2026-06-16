<?php 
session_start(); 
include('db_connect.php');

// Prevent browser caching so cart always shows fresh data
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Check if the user clicked the checkout button
if (isset($_GET['action']) && $_GET['action'] == 'checkout') {
    // Save order to database before clearing cart
    if (!empty($_SESSION['cart']) && isset($_SESSION['user'])) {
        $username = mysqli_real_escape_string($conn, $_SESSION['user']);
        $grand_total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $grand_total += $item['price'] * $item['qty'];
        }

        $sql = "INSERT INTO orders (username, total_amount) VALUES ('$username', $grand_total)";
        $conn->query($sql);
        $order_id = $conn->insert_id;

        foreach ($_SESSION['cart'] as $item) {
            $item_name = mysqli_real_escape_string($conn, $item['name']);
            $price = $item['price'];
            $qty = $item['qty'];
            $subtotal = $price * $qty;
            $sql = "INSERT INTO order_items (order_id, item_name, price, qty, subtotal) VALUES ($order_id, '$item_name', $price, $qty, $subtotal)";
            $conn->query($sql);
        }
    }

    // Force clear the cart array completely
    $_SESSION['cart'] = array();
    unset($_SESSION['cart']);
    
    // Immediately redirect to a clean URL to force the browser to drop cached data
    header("Location: cart.php?status=success");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Food Cart</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .cart-box { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #e23744; color: white; }
        .checkout-btn { width: 100%; background: #28a745; color: white; border: none; padding: 12px; font-size: 18px; border-radius: 8px; cursor: pointer; margin-top: 20px; }
        .success-msg { background-color: #d4edda; color: #155724; padding: 12px; border-radius: 8px; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
<div class="cart-box">
    <h2>Your Cart Selections</h2>

    <!-- Show a success message if the order was just confirmed -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="success-msg">✅ Order Sent to Kitchen Successfully! Your cart has been reset.</div>
    <?php endif; ?>

    <?php if(!empty($_SESSION['cart'])): ?>
        <table>
            <tr><th>Item</th><th>Price</th><th>Qty</th><th>Total</th></tr>
            <?php 
            $grand_total = 0;
            foreach($_SESSION['cart'] as $item): 
                $subtotal = $item['price'] * $item['qty'];
                $grand_total += $subtotal;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>₹<?php echo $item['price']; ?></td>
                <td><?php echo $item['qty']; ?></td>
                <td>₹<?php echo $subtotal; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h3>Grand Total: ₹<?php echo $grand_total; ?></h3>
        
        <!-- Simplified Button using plain HTML link redirection -->
        <a href="cart.php?action=checkout" class="checkout-btn" style="display: block; text-align: center; text-decoration: none;">Confirm Delivery Order</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    <br><a href="kitchen1.php" style="color:#e23744; text-decoration:none; font-weight:bold;">← Back to Menu</a>
</div>
</body>
</html>