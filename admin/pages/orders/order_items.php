<?php
// include '../../includes/auth.php';
$pageTitle = "Order Items | SmartStore";
$pageKey = "orders";

include '../../../config/database.php';

$order_id = $_GET['order_id'];



$orderQuery = "SELECT
                orders.id,
                users.name AS client_name,
                orders.total_price,
                orders.status,
                orders.created_at
               FROM orders
               LEFT JOIN clients
               ON orders.client_id = clients.id
               LEFT JOIN users
               ON clients.user_id = users.id
               WHERE orders.id = $order_id";

$orderResult = mysqli_query($conn, $orderQuery);
$order = mysqli_fetch_assoc($orderResult);



$query = "SELECT
            order_items.id,
            order_items.order_id,
            order_items.product_id,
            order_items.quantity,
            order_items.price,
            products.name AS product_name
          FROM order_items
          LEFT JOIN products
          ON order_items.product_id = products.id
          WHERE order_items.order_id = $order_id";

$result = mysqli_query($conn, $query);

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">

            <div>

                <div class="page-eyebrow">
                    Order Details
                </div>

                <h1>
                    Order #<?= $order['id']; ?>
                </h1>

                <p>
                    View the products and details of this order.
                </p>

            </div>

            <div class="page-actions">

                <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to Orders
                </a>

            </div>

        </div>


        

        <div class="users-table-card">

            <div
                class="section-heading"
                style="padding: 22px 24px 0;"
            >

                <div>

                    <div class="section-eyebrow">
                        Order Information
                    </div>

                    <h2>
                        Order #<?= $order['id']; ?>
                    </h2>

                </div>

            </div>


            <div style="padding: 20px 24px;">

                <p>
                    <strong>Client:</strong>
                    <?= htmlspecialchars($order['client_name'] ?? 'Unknown Client'); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?= htmlspecialchars($order['status']); ?>
                </p>

                <p>
                    <strong>Total:</strong>
                    <?= number_format($order['total_price'], 2); ?>
                </p>

                <p>
                    <strong>Created At:</strong>
                    <?= $order['created_at']; ?>
                </p>

            </div>

        </div>


        <br>


        <!-- Order Items -->

        <div class="users-table-card">

            <div
                class="section-heading"
                style="padding: 22px 24px 0;"
            >

                <div>

                    <div class="section-eyebrow">
                        Products
                    </div>

                    <h2>
                        Order Items
                    </h2>

                </div>

            </div>


            <div class="table-responsive">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($item = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td>
                                    <?= $item['id']; ?>
                                </td>


                                <td>

                                    <strong>
                                        <?= htmlspecialchars($item['product_name'] ?? 'Unknown Product'); ?>
                                    </strong>

                                </td>


                                <td>
                                    <?= $item['quantity']; ?>
                                </td>


                                <td>
                                    <?= number_format($item['price'], 2); ?>
                                </td>


                                <td>

                                    <?= number_format(
                                        $item['quantity'] * $item['price'],
                                        2
                                    ); ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>


<?php include '../../includes/footer.php'; ?>