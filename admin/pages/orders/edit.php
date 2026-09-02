<?php

$pageTitle = "Edit Order | SmartStore";
$pageKey = "orders";

include '../../../config/database.php';


// Get order ID
$id = $_GET['id'];


// Get order
$sql = "SELECT * FROM orders WHERE id = $id";
$result = mysqli_query($conn, $sql);

$order = mysqli_fetch_array($result);

if (!$order) {

    die("Order not found.");

}


// Get clients
$clientsQuery = "SELECT
                    clients.id,
                    users.name
                 FROM clients
                 LEFT JOIN users
                 ON clients.user_id = users.id";

$clientsResult = mysqli_query($conn, $clientsQuery);


// Update order
if (isset($_POST['submit'])) {

    $client_id = $_POST['client_id'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET
                client_id = '$client_id',
                total_price = '$total_price',
                status = '$status'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        header("Location: index.php");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);

    }
}


include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        <div class="page-header">

            <div>

                <div class="page-eyebrow">
                    Order Management
                </div>

                <h1>Edit Order</h1>

                <p>
                    Update the order's information.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Order Information
                </div>

                <h2>Edit Order</h2>

                <p>
                    Update the order's information below.
                </p>

            </div>


            <form method="POST">

                <div class="form-body">

                    <div class="row">

                        <!-- Client -->

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="client_id"
                                    class="form-label"
                                >
                                    Client <span>*</span>
                                </label>

                                <select
                                    id="client_id"
                                    name="client_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select client
                                    </option>

                                    <?php while ($client = mysqli_fetch_array($clientsResult)) { ?>

                                        <option
                                            value="<?= $client['id']; ?>"
                                            <?= ($client['id'] == $order['client_id']) ? 'selected' : ''; ?>
                                        >
                                            <?= htmlspecialchars($client['name']); ?>
                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>


                        <!-- Total Price -->

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="total_price"
                                    class="form-label"
                                >
                                    Total Price <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    id="total_price"
                                    name="total_price"
                                    class="form-input"
                                    value="<?= htmlspecialchars($order['total_price']); ?>"
                                    placeholder="Enter total price"
                                    step="0.01"
                                    min="0"
                                    required
                                >

                            </div>

                        </div>


                        <!-- Status -->

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="status"
                                    class="form-label"
                                >
                                    Status <span>*</span>
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="form-select"
                                    required
                                >

                                    <option value="pending"
                                        <?= ($order['status'] == 'pending') ? 'selected' : ''; ?>>
                                        Pending
                                    </option>

                                    <option value="processing"
                                        <?= ($order['status'] == 'processing') ? 'selected' : ''; ?>>
                                        Processing
                                    </option>

                                    <option value="completed"
                                        <?= ($order['status'] == 'completed') ? 'selected' : ''; ?>>
                                        Completed
                                    </option>

                                    <option value="cancelled"
                                        <?= ($order['status'] == 'cancelled') ? 'selected' : ''; ?>>
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="form-footer">

                    <a
                        href="index.php"
                        class="btn-secondary"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn-primary"
                    >
                        <i class="bi bi-check-lg"></i>
                        Update Order
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>