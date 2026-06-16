<?php
session_start();
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders - Admin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 30px; margin: 0; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { color: #e23744; text-align: center; margin-bottom: 10px; }
        .summary { display: flex; gap: 20px; justify-content: center; margin-bottom: 30px; flex-wrap: wrap; }
        .summary-card { background: white; padding: 20px 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center; }
        .summary-card h3 { margin: 0; color: #555; font-size: 14px; }
        .summary-card p { margin: 5px 0 0; font-size: 28px; font-weight: bold; color: #e23744; }
        .order-card { background: white; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden; }
        .order-header { background: #e23744; color: white; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .order-header span { font-size: 14px; }
        .order-body { padding: 15px 20px; }
        .order-body table { width: 100%; border-collapse: collapse; }
        .order-body th, .order-body td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; }
        .order-body th { color: #555; font-size: 13px; text-transform: uppercase; }
        .order-total { text-align: right; font-size: 18px; font-weight: bold; padding: 10px 20px; color: #28a745; }
        a.back-link { display: inline-block; margin-bottom: 20px; color: #e23744; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <a href="kitchen1.php" class="back-link">← Back to Menu</a>
    <h1>Order History</h1>

    <?php
    // Summary stats
    $stats = $conn->query("SELECT COUNT(*) as total_orders, SUM(total_amount) as revenue FROM orders");
    $row = $stats->fetch_assoc();
    $total_orders = $row['total_orders'] ?? 0;
    $revenue = $row['revenue'] ?? 0;

    $customers = $conn->query("SELECT COUNT(DISTINCT username) as count FROM orders");
    $customer_count = $customers->fetch_assoc()['count'] ?? 0;
    ?>

    <div class="summary">
        <div class="summary-card">
            <h3>Total Orders</h3>
            <p><?php echo $total_orders; ?></p>
        </div>
        <div class="summary-card">
            <h3>Total Revenue</h3>
            <p>₹<?php echo number_format($revenue, 2); ?></p>
        </div>
        <div class="summary-card">
            <h3>Unique Customers</h3>
            <p><?php echo $customer_count; ?></p>
        </div>
    </div>

    <?php
    // Fetch all orders with items
    $orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");

    if ($orders->num_rows == 0): ?>
        <p style="text-align:center; font-size:18px; color:#777;">No orders yet.</p>
    <?php else:
        while ($order = $orders->fetch_assoc()):
            $order_id = (int)$order['id'];
            $items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
    ?>
        <div class="order-card">
            <div class="order-header">
                <span><strong>Order #<?php echo $order['id']; ?></strong></span>
                <span>Customer: <strong><?php echo htmlspecialchars($order['username']); ?></strong></span>
                <span><?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></span>
            </div>
            <div class="order-body">
                <table>
                    <tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
                    <?php while ($item = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                        <td>₹<?php echo $item['price']; ?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <td>₹<?php echo $item['subtotal']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="order-total">Total: ₹<?php echo number_format($order['total_amount'], 2); ?></div>
        </div>
    <?php endwhile; endif; ?>
</div>
</body>
</html>
