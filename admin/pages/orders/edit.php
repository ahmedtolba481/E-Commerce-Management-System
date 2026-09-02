<?php
// include '../../includes/auth.php';
$pageTitle = "Edit Order | SmartStore";
$pageKey = "orders";

include '../../../config/database.php';



$id = $_GET['id'];



$sql = "SELECT * FROM orders WHERE id = $id";
$result = mysqli_query($conn, $sql);

$order = mysqli_fetch_array($result);

if (!$order) {

    die("Order not found.");

}



$clientsQuery = "SELECT
                    clients.id,
                    users.name
                 FROM clients
                 LEFT JOIN users
                 ON clients.user_id = users.id";

$clientsResult = mysqli_query($conn, $clientsQuery);



$productsQuery = "SELECT
                    id,
                    name,
                    price,
                    stock
                  FROM products
                  ORDER BY name ASC";

$productsResult = mysqli_query($conn, $productsQuery);



$itemsQuery = "SELECT
                order_items.product_id,
                order_items.quantity,
                order_items.price
               FROM order_items
               WHERE order_items.order_id = $id";

$itemsResult = mysqli_query($conn, $itemsQuery);

$orderItems = [];

while ($item = mysqli_fetch_assoc($itemsResult)) {

    $orderItems[] = $item;

}



if (isset($_POST['submit'])) {

    $client_id = $_POST['client_id'];
    $status = $_POST['status'];

    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];

    $total_price = 0;


    
    foreach ($product_ids as $index => $product_id) {

        $quantity = $quantities[$index];

        $productQuery = "SELECT price
                         FROM products
                         WHERE id = $product_id";

        $productResult = mysqli_query($conn, $productQuery);

        $product = mysqli_fetch_assoc($productResult);

        $total_price += $product['price'] * $quantity;

    }


    
    $sql = "UPDATE orders SET
                client_id = '$client_id',
                total_price = '$total_price',
                status = '$status'
            WHERE id = $id";


    if (mysqli_query($conn, $sql)) {


        
        $deleteItems = "DELETE FROM order_items
                        WHERE order_id = $id";

        mysqli_query($conn, $deleteItems);


        
        foreach ($product_ids as $index => $product_id) {

            $quantity = $quantities[$index];


            
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
                        ('$id', '$product_id', '$quantity', '$price')";

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

                <h2>
                    Edit Order #<?= $order['id']; ?>
                </h2>

                <p>
                    Update the order's information below.
                </p>

            </div>


            <form method="POST">

                <div class="form-body">

                    <div class="row">




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


                    

                    <div class="form-group">

                        <label class="form-label">
                            Products <span>*</span>
                        </label>


                        <div id="products-container">


                            <?php foreach ($orderItems as $item) { ?>

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
                                                    <?= ($product['id'] == $item['product_id']) ? 'selected' : ''; ?>
                                                >

                                                    <?= htmlspecialchars($product['name']); ?>

                                                    -
                                                    <?= number_format($product['price'], 2); ?>

                                                </option>

                                            <?php } ?>

                                        </select>

                                    </div>


                                    

                                    <div class="col-md-3">

                                        <input
                                            type="number"
                                            name="quantity[]"
                                            class="form-input"
                                            placeholder="Quantity"
                                            min="1"
                                            value="<?= $item['quantity']; ?>"
                                            required
                                        >

                                    </div>


                                    

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

                            <?php } ?>


                            <!-- If order has no items -->

                            <?php if (count($orderItems) == 0) { ?>

                                <div class="row product-row mb-3">

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

                            <?php } ?>

                        </div>


                        

                        <button
                            type="button"
                            id="add-product"
                            class="btn-secondary"
                        >

                            <i class="bi bi-plus-lg"></i>

                            Add Product

                        </button>

                    </div>


                

                    <div class="form-group">

                        <label class="form-label">
                            Total Price
                        </label>

                        <input
                            type="text"
                            id="total_price_display"
                            class="form-input"
                            value="<?= number_format($order['total_price'], 2); ?>"
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

                        <i class="bi bi-check-lg"></i>

                        Update Order

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

        const product =
            row.querySelector('select[name="product_id[]"]');

        const quantity =
            row.querySelector('input[name="quantity[]"]');


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


// Add product
addProductButton.addEventListener('click', function() {

    const firstRow =
        document.querySelector('.product-row');

    const newRow =
        firstRow.cloneNode(true);


    newRow.querySelector('select').value = '';

    newRow.querySelector('input').value = 1;


    container.appendChild(newRow);

});


// Remove product
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


// Recalculate total
container.addEventListener('change', function() {

    calculateTotal();

});


container.addEventListener('input', function() {

    calculateTotal();

});


</script>


<?php include '../../includes/footer.php'; ?>