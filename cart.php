<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore - Dynamic Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F7FAF9 !important;
            color: #4B5563;
        }
        .custom-primary {
            background-color: #19A974 !important;
            border-color: #19A974 !important;
            color: #FFFFFF !important;
        }
        .custom-primary:hover {
            background-color: #148f61 !important;
            border-color: #148f61 !important;
        }
        .text-custom-primary {
            color: #19A974 !important;
        }
        .custom-dark {
            background-color: #172B4D !important;
            color: #FFFFFF !important;
        }
        .custom-badge-mint {
            background-color: #DDF6EC !important;
            color: #19A974 !important;
        }
        .text-dark-custom {
            color: #172B4D !important;
        }
    </style>
</head>
<body class="py-5">

    <div class="container">
        
        <!-- Cart Title Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold fs-2 text-dark-custom">Cart</h1>
            <p class="small" style="color: #4B5563;">Manage your selected items, update quantities, and checkout securely.</p>
        </div>

        <div class="row g-4">
            
            <!-- Left Side: Cart Items List -->
            <div class="col-lg-8" id="cart-items-container">
                
                <!-- Item 1 -->
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-3 position-relative cart-item bg-white" data-price="89.99">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 small remove-item-btn" aria-label="Close"></button>
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="height: 110px; background-color: #F7FAF9;">
                                <i class="bi bi-image fs-2" style="color: #4B5563;"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="fw-bold fs-6 mb-1 text-dark-custom">Vestibulum ante ipsum primis</h5>
                            <div class="mb-2">
                                <span class="badge custom-badge-mint fw-normal px-2 py-1" style="font-size: 11px;">Color: Charcoal</span>
                                <span class="badge custom-badge-mint fw-normal px-2 py-1 ms-1" style="font-size: 11px;">Size: M</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold text-dark-custom item-unit-price">$89.99</span>
                                <div class="input-group input-group-sm w-auto border rounded-pill overflow-hidden">
                                    <button class="btn btn-outline-secondary border-0 px-2 decrease-btn" type="button">-</button>
                                    <input type="text" class="form-control text-center border-0 bg-white px-1 item-qty text-dark-custom" value="1" style="width: 35px;" readonly>
                                    <button class="btn btn-outline-secondary border-0 px-2 increase-btn" type="button">+</button>
                                </div>
                                <span class="fw-bold text-dark-custom item-total-price">$89.99</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-3 position-relative cart-item bg-white" data-price="64.99">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 small remove-item-btn" aria-label="Close"></button>
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="height: 110px; background-color: #F7FAF9;">
                                <i class="bi bi-image fs-2" style="color: #4B5563;"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="fw-bold fs-6 mb-1 text-dark-custom">Pellentesque habitant morbi</h5>
                            <div class="mb-2">
                                <span class="badge custom-badge-mint fw-normal px-2 py-1" style="font-size: 11px;">Color: Ivory</span>
                                <span class="badge custom-badge-mint fw-normal px-2 py-1 ms-1" style="font-size: 11px;">Size: L</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="fw-bold text-dark-custom me-2 item-unit-price">$64.99</span>
                                    <span class="text-decoration-line-through small" style="color: #4B5563;">$79.99</span>
                                </div>
                                <div class="input-group input-group-sm w-auto border rounded-pill overflow-hidden">
                                    <button class="btn btn-outline-secondary border-0 px-2 decrease-btn" type="button">-</button>
                                    <input type="text" class="form-control text-center border-0 bg-white px-1 item-qty text-dark-custom" value="2" style="width: 35px;" readonly>
                                    <button class="btn btn-outline-secondary border-0 px-2 increase-btn" type="button">+</button>
                                </div>
                                <span class="fw-bold text-dark-custom item-total-price">$129.98</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Side: Order Overview Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="card-header custom-dark p-3 fw-bold d-flex align-items-center gap-2">
                        <i class="bi bi-bag-check fs-5"></i> Order Overview
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Promo Code -->
                        <label class="form-label small" style="color: #4B5563;">Have a promo code?</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter code">
                            <button class="btn custom-primary btn-sm px-3" type="button">Apply</button>
                        </div>

                        <hr style="color: #4B5563; opacity: 0.25;">

                        <!-- Calculations -->
                        <div class="d-flex justify-content-between small mb-2">
                            <span style="color: #4B5563;" id="items-count-text">Subtotal (3 items)</span>
                            <span class="fw-bold text-dark-custom" id="subtotal-amount">$219.97</span>
                        </div>

                        <div class="mb-3">
                            <span class="small d-block mb-2" style="color: #4B5563;">Delivery</span>
                            <div class="form-check small mb-1">
                                <input class="form-check-input delivery-radio" type="radio" name="delivery" id="std" value="4.99" checked>
                                <label class="form-check-label" style="color: #4B5563;" for="std">Standard - $4.99</label>
                            </div>
                            <div class="form-check small mb-1">
                                <input class="form-check-input delivery-radio" type="radio" name="delivery" id="exp" value="12.99">
                                <label class="form-check-label" style="color: #4B5563;" for="exp">Express - $12.99</label>
                            </div>
                            <div class="form-check small">
                                <input class="form-check-input delivery-radio" type="radio" name="delivery" id="free" value="0.00">
                                <label class="form-check-label" style="color: #4B5563;" for="free">Free (Orders $300+)</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between small mb-2">
                            <span style="color: #4B5563;">Estimated Tax</span>
                            <span class="fw-bold text-dark-custom" id="tax-amount">$27.00</span>
                        </div>

                        <div class="d-flex justify-content-between small mb-3">
                            <span style="color: #4B5563;">Savings</span>
                            <span class="fw-bold text-custom-primary">-$0.00</span>
                        </div>

                        <hr style="color: #4B5563; opacity: 0.25;">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-6 text-dark-custom">Grand Total</span>
                            <span class="fw-bold fs-4 text-custom-primary" id="grand-total-amount">$251.96</span>
                        </div>

                        <button class="btn custom-primary w-100 py-2 rounded-pill fw-semibold shadow-sm">
                            Complete Purchase <i class="bi bi-arrow-right"></i>
                        </button>

                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Actions -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="index.php" class="text-decoration-none text-custom-primary small fw-semibold"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
            <button class="btn btn-outline-danger btn-sm rounded-pill px-3" id="empty-cart-btn"><i class="bi bi-trash"></i> Empty Cart</button>
        </div>

    </div>

    <!-- JavaScript لتشغيل تفاعلية السلة بالكامل -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartItemsContainer = document.getElementById('cart-items-container');
            const subtotalEl = document.getElementById('subtotal-amount');
            const taxEl = document.getElementById('tax-amount');
            const grandTotalEl = document.getElementById('grand-total-amount');
            const itemsCountText = document.getElementById('items-count-text');
            const deliveryRadios = document.querySelectorAll('.delivery-radio');
            const emptyCartBtn = document.getElementById('empty-cart-btn');

            function updateCartTotals() {
                let subtotal = 0;
                let totalItemsCount = 0;
                const cartItems = document.querySelectorAll('.cart-item');

                cartItems.forEach(item => {
                    const price = parseFloat(item.getAttribute('data-price'));
                    const qtyInput = item.querySelector('.item-qty');
                    const qty = parseInt(qtyInput.value);
                    
                    const itemTotal = price * qty;
                    item.querySelector('.item-total-price').textContent = '$' + itemTotal.toFixed(2);

                    subtotal += itemTotal;
                    totalItemsCount += qty;
                });

                subtotalEl.textContent = '$' + subtotal.toFixed(2);
                itemsCountText.textContent = `Subtotal (${totalItemsCount} items)`;

                let deliveryCost = 4.99;
                deliveryRadios.forEach(radio => {
                    if (radio.checked) {
                        deliveryCost = parseFloat(radio.value);
                    }
                });

                const tax = subtotal > 0 ? 27.00 : 0.00;
                taxEl.textContent = '$' + tax.toFixed(2);

                const grandTotal = subtotal + deliveryCost + tax;
                grandTotalEl.textContent = '$' + (subtotal > 0 ? grandTotal.toFixed(2) : '0.00');
            }

            cartItemsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('increase-btn')) {
                    const item = e.target.closest('.cart-item');
                    const qtyInput = item.querySelector('.item-qty');
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    updateCartTotals();
                }

                if (e.target.classList.contains('decrease-btn')) {
                    const item = e.target.closest('.cart-item');
                    const qtyInput = item.querySelector('.item-qty');
                    if (parseInt(qtyInput.value) > 1) {
                        qtyInput.value = parseInt(qtyInput.value) - 1;
                        updateCartTotals();
                    }
                }

                if (e.target.classList.contains('remove-item-btn')) {
                    const item = e.target.closest('.cart-item');
                    item.remove();
                    updateCartTotals();
                }
            });
            deliveryRadios.forEach(radio => {
                radio.addEventListener('change', updateCartTotals);
            });
            emptyCartBtn.addEventListener('click', function () {
                cartItemsContainer.innerHTML = '<div class="text-center py-5 bg-white rounded-4 shadow-sm"><p class="text-muted mb-0">Your cart is empty.</p></div>';
                updateCartTotals();
            });
            updateCartTotals();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>