<?php

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$user_type = getUserType($_SESSION['user_email']);

if ($user_type == 'user') {
    // Get the user's orders
    $orders = getUserOrders($_SESSION['user_email']);
} else {
    // Get all orders sorted desc by time
    $orders = getAllOrders($recentFirst=true);
}
?>


<style type="text/css">
    td { padding: 6px; } 
    th { padding: 6px; } 
</style>

<h1>Orders</h1>

<?php if ($user_type == 'user'): ?>
    <table>

        <thead>
            <tr>
                <th>Order ID</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= $order['address'] ?></td>
                    <td><?= $order['total'] ?></td>
                    <td><?= $order['date'] ?></td>
                    <td><?= $order['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['email'] ?></td>
                    <td><?= $order['address'] ?></td>
                    <td><?= $order['total'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td>
                        <form action="refund_order.php" method="post">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <input type="submit" value="Refund">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
