<?php
include '../../includes/auth.php';
$pageTitle = "Create Order | ShopEase Admin";
$pageHeading = "Create Order";

include '../../../config/database.php';

// Get clients
$clientsQuery = "SELECT clients.id, users.name
                 FROM clients
                 LEFT JOIN users ON clients.user_id = users.id
                 ORDER BY users.name ASC";
$clientsResult = mysqli_query($conn, $clientsQuery);

// Get products
$productsQuery = "SELECT id, name, price, stock
                  FROM products
                  ORDER BY name ASC";
$productsResult = mysqli_query($conn, $productsQuery);

$error = "";

if (isset($_POST['submit'])) {
    $client_id = (int)$_POST['client_id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $product_ids = $_POST['product_id'] ?? [];
    $quantities = $_POST['quantity'] ?? [];

    $total_price = 0;

    foreach ($product_ids as $index => $product_id) {
        $product_id = (int)$product_id;
        $quantity = (int)$quantities[$index];
        $productQuery = "SELECT price FROM products WHERE id = $product_id";
        $productResult = mysqli_query($conn, $productQuery);
        $product = mysqli_fetch_assoc($productResult);
        if ($product) {
            $total_price += $product['price'] * $quantity;
        }
    }

    $sql = "INSERT INTO orders (client_id, total_price, status) VALUES ('$client_id', '$total_price', '$status')";

    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($product_ids as $index => $product_id) {
            $product_id = (int)$product_id;
            $quantity = (int)$quantities[$index];
            $productQuery = "SELECT price FROM products WHERE id = $product_id";
            $productResult = mysqli_query($conn, $productQuery);
            $product = mysqli_fetch_assoc($productResult);
            if ($product) {
                $price = $product['price'];
                $itemSql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                            VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                mysqli_query($conn, $itemSql);
            }
        }
        header("Location: index.php");
        exit;
    } else {
        $error = "Database Error: " . mysqli_error($conn);
    }
}

include '../../includes/header.php';
?>

<div class="admin-layout">
    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">
        <?php include '../../includes/navbar.php'; ?>

        <div class="page-header">
            <div>
                <span class="page-eyebrow">ORDER FULFILLMENT</span>
                <h1>Create New Order</h1>
                <p>Build a customer order and calculate totals automatically.</p>
            </div>
            <div class="page-actions">
                <a href="index.php" class="btn btn-outline">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Orders</span>
                </a>
            </div>
        </div>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php } ?>

        <div class="form-card">
            <div class="form-header">
                <h2>Order Information</h2>
                <p class="text-muted">Select client, order status, and add items.</p>
            </div>

            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="client_id" class="form-label">Client Account <span>*</span></label>
                        <select id="client_id" name="client_id" class="form-select" required>
                            <option value="">Select client...</option>
                            <?php while ($client = mysqli_fetch_array($clientsResult)) { ?>
                                <option value="<?= $client['id']; ?>">
                                    <?= htmlspecialchars($client['name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Order Status <span>*</span></label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="">Select status...</option>
                            <option value="pending" selected>Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Products list -->
                    <div class="form-group full-width">
                        <label class="form-label">Select Products <span>*</span></label>
                        <div id="products-container" class="d-flex flex-column gap-3 mb-3">
                            <div class="row g-2 align-items-center product-row border p-3 rounded bg-light">
                                <div class="col-md-6">
                                    <select name="product_id[]" class="form-select" required>
                                        <option value="">Select product...</option>
                                        <?php
                                        mysqli_data_seek($productsResult, 0);
                                        while ($product = mysqli_fetch_array($productsResult)) {
                                        ?>
                                            <option value="<?= $product['id']; ?>" data-price="<?= $product['price']; ?>">
                                                <?= htmlspecialchars($product['name']); ?> - $<?= number_format($product['price'], 2); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="quantity[]" class="form-control" placeholder="Qty" min="1" value="1" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-outline text-danger border-danger w-100 remove-product">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-product" class="btn btn-outline">
                            <i class="bi bi-plus-lg"></i> Add Another Product
                        </button>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Calculated Order Total</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" id="total_price_display" class="form-control bg-light font-weight-bold" value="0.00" readonly>
                        </div>
                        <small class="text-muted mt-1">Calculated automatically based on product unit prices and quantities.</small>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-outline">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Order</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('products-container');
    const addProductButton = document.getElementById('add-product');
    const totalDisplay = document.getElementById('total_price_display');

    function calculateTotal() {
        let total = 0;
        const rows = document.querySelectorAll('.product-row');
        rows.forEach(function(row) {
            const product = row.querySelector('select[name="product_id[]"]');
            const quantity = row.querySelector('input[name="quantity[]"]');
            if (product && product.value && quantity && quantity.value) {
                const selectedOption = product.options[product.selectedIndex];
                const price = parseFloat(selectedOption.dataset.price || 0);
                const qty = parseInt(quantity.value || 0);
                total += price * qty;
            }
        });
        if (totalDisplay) {
            totalDisplay.value = total.toFixed(2);
        }
    }

    if (addProductButton) {
        addProductButton.addEventListener('click', function() {
            const firstRow = document.querySelector('.product-row');
            if (!firstRow) return;
            const newRow = firstRow.cloneNode(true);
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = 1;
            container.appendChild(newRow);
        });
    }

    if (container) {
        container.addEventListener('click', function(event) {
            const button = event.target.closest('.remove-product');
            if (!button) return;
            const rows = document.querySelectorAll('.product-row');
            if (rows.length > 1) {
                button.closest('.product-row').remove();
                calculateTotal();
            }
        });

        container.addEventListener('change', calculateTotal);
        container.addEventListener('input', calculateTotal);
    }
});
</script>

<?php include '../../includes/footer.php'; ?>