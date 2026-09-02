<?php
// include '../../includes/auth.php';
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


// Get products
$productsQuery = "SELECT
                    id,
                    name,
                    price,
                    stock
                  FROM products
                  ORDER BY name ASC";

$productsResult = mysqli_query($conn, $productsQuery);


// Create order
if (isset($_POST['submit'])) {

    $client_id = $_POST['client_id'];
    $status = $_POST['status'];

    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];

    $total_price = 0;


    // Calculate total price
    foreach ($product_ids as $index => $product_id) {

        $quantity = $quantities[$index];

        $productQuery = "SELECT price
                         FROM products
                         WHERE id = $product_id";

        $productResult = mysqli_query($conn, $productQuery);

        $product = mysqli_fetch_assoc($productResult);

        $total_price += $product['price'] * $quantity;
    }


    // Create order
    $sql = "INSERT INTO orders (client_id, total_price, status)
            VALUES ('$client_id', '$total_price', '$status')";


    if (mysqli_query($conn, $sql)) {

        // Get the newly created order ID
        $order_id = mysqli_insert_id($conn);


        // Add products to order_items
        foreach ($product_ids as $index => $product_id) {

            $quantity = $quantities[$index];


            // Get product price
            $productQuery = "SELECT price
                             FROM products
                             WHERE id = $product_id";

            $productResult = mysqli_query($conn, $productQuery);

            $product = mysqli_fetch_assoc($productResult);

            $price = $product['price'];


            // Insert order item
            $itemSql = "INSERT INTO order_items
                        (order_id, product_id, quantity, price)
                        VALUES
                        ('$order_id', '$product_id', '$quantity', '$price')";

            mysqli_query($conn, $itemSql);
        }


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


                    <!-- Products -->

                    <div class="form-group">

                        <label class="form-label">
                            Products <span>*</span>
                        </label>


                        <div id="products-container">


                            <div class="row product-row mb-3">


                                <!-- Product -->

                                <div class="col-md-6">

                                    <select
                                        name="product_id[]"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            Select product
                                        </option>

                                        <?php

                                        mysqli_data_seek($productsResult, 0);

                                        while ($product = mysqli_fetch_array($productsResult)) {

                                        ?>

                                            <option
                                                value="<?= $product['id']; ?>"
                                                data-price="<?= $product['price']; ?>"
                                            >

                                                <?= htmlspecialchars($product['name']); ?>

                                                -
                                                <?= number_format($product['price'], 2); ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>


                                <!-- Quantity -->

                                <div class="col-md-3">

                                    <input
                                        type="number"
                                        name="quantity[]"
                                        class="form-input"
                                        placeholder="Quantity"
                                        min="1"
                                        value="1"
                                        required
                                    >

                                </div>


                                <!-- Remove -->

                                <div class="col-md-3">

                                    <button
                                        type="button"
                                        class="btn-secondary remove-product"
                                    >

                                        <i class="bi bi-trash"></i>

                                        Remove

                                    </button>

                                </div>


                            </div>

                        </div>


                        <!-- Add Product -->

                        <button
                            type="button"
                            id="add-product"
                            class="btn-secondary"
                        >

                            <i class="bi bi-plus-lg"></i>

                            Add Product

                        </button>

                    </div>


                    <!-- Total -->

                    <div class="form-group">

                        <label class="form-label">
                            Total Price
                        </label>

                        <input
                            type="text"
                            id="total_price_display"
                            class="form-input"
                            value="0.00"
                            readonly
                        >

                        <span class="form-help">
                            Total price is calculated automatically from the selected products and quantities.
                        </span>

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


<script>

const container = document.getElementById('products-container');
const addProductButton = document.getElementById('add-product');
const totalDisplay = document.getElementById('total_price_display');


// Calculate total
function calculateTotal() {

    let total = 0;

    const rows = document.querySelectorAll('.product-row');

    rows.forEach(function(row) {

        const product = row.querySelector('select[name="product_id[]"]');
        const quantity = row.querySelector('input[name="quantity[]"]');

        if (product.value && quantity.value) {

            const selectedOption =
                product.options[product.selectedIndex];

            const price =
                parseFloat(selectedOption.dataset.price);

            const qty =
                parseInt(quantity.value);

            total += price * qty;
        }

    });

    totalDisplay.value = total.toFixed(2);
}


// Add product row
addProductButton.addEventListener('click', function() {

    const firstRow =
        document.querySelector('.product-row');

    const newRow =
        firstRow.cloneNode(true);


    newRow.querySelector('select').value = '';

    newRow.querySelector('input').value = 1;


    container.appendChild(newRow);

});


// Remove product row
container.addEventListener('click', function(event) {

    const button =
        event.target.closest('.remove-product');

    if (!button) {
        return;
    }


    const rows =
        document.querySelectorAll('.product-row');


    if (rows.length > 1) {

        button.closest('.product-row').remove();

        calculateTotal();

    }

});


// Recalculate when product or quantity changes
container.addEventListener('change', function() {

    calculateTotal();

});

container.addEventListener('input', function() {

    calculateTotal();

});


</script>


<?php include '../../includes/footer.php'; ?>