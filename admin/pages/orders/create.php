<?php

$pageTitle = "Add Order | SmartStore";
$pageKey = "orders";

include '../../../config/database.php';


// Get clients
$clientsQuery = "SELECT
                    clients.id,
                    users.name
                 FROM clients
                 LEFT JOIN users
                 ON clients.user_id = users.id";

$clientsResult = mysqli_query($conn, $clientsQuery);


// Create order
if (isset($_POST['submit'])) {

    $client_id = $_POST['client_id'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders (client_id, total_price, status)
            VALUES ('$client_id', '$total_price', '$status')";

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

                <h1>Add Order</h1>

                <p>
                    Create a new order for a client.
                </p>

            </div>

        </div>


        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    Order Information
                </div>

                <h2>Create New Order</h2>

                <p>
                    Enter the order's information below.
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

                                        <option value="<?= $client['id']; ?>">
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

                                    <option value="">
                                        Select status
                                    </option>

                                    <option value="pending">
                                        Pending
                                    </option>

                                    <option value="processing">
                                        Processing
                                    </option>

                                    <option value="completed">
                                        Completed
                                    </option>

                                    <option value="cancelled">
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
                        <i class="bi bi-plus-lg"></i>
                        Create Order
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php include '../../includes/footer.php'; ?>