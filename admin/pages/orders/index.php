<?php
include '../../includes/auth.php';
$pageTitle = "Orders | SmartStore";
$pageKey = "orders";

include '../../../config/database.php';

$query = "SELECT
            orders.id,
            users.name AS client_name,
            orders.total_price,
            orders.status,
            orders.created_at
          FROM orders
          LEFT JOIN clients
          ON orders.client_id = clients.id
          LEFT JOIN users
          ON clients.user_id = users.id";

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
                    Management
                </div>

                <h1>Orders</h1>

                <p>
                    Manage system orders.
                </p>

            </div>

            <div class="page-actions">

                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Order
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
                        Orders
                    </div>

                    <h2>All Orders</h2>

                </div>

            </div>


            <div class="table-responsive">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Client Name</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($order = mysqli_fetch_array($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $order['id']; ?>
                                </td>


                                <td>

                                    <strong>
                                        <?php echo htmlspecialchars($order['client_name'] ?? 'Unknown Client'); ?>
                                    </strong>

                                </td>


                                <td>

                                    <?php echo number_format($order['total_price'], 2); ?>

                                </td>


                                <td>

                                    <span class="order-status">
                                        <?php echo htmlspecialchars($order['status']); ?>
                                    </span>

                                </td>


                                <td>

                                    <?php echo $order['created_at']; ?>

                                </td>


                                <td>

                                    <div class="user-actions">


                                        <a
                                            href="order_items.php?order_id=<?= $order['id']; ?>"
                                            class="user-action view"
                                            title="View Items"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>



                                        <a
                                            href="edit.php?id=<?= $order['id']; ?>"
                                            class="user-action edit"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>



                                        <a
                                            href="delete.php?id=<?= $order['id']; ?>"
                                            class="user-action delete"
                                            title="Delete"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>

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