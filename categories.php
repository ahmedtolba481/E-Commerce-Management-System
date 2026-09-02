<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStore - Products & Filters</title>
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
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .text-dark-custom {
            color: #172B4D !important;
        }
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.08) !important;
        }
        .page-item.active .page-link {
            background-color: #19A974 !important;
            border-color: #19A974 !important;
        }
        .page-link {
            color: #172B4D;
        }
        .filter-title {
            border-left: 3px solid #19A974;
            padding-left: 10px;
        }
        .form-range::-webkit-slider-thumb {
            background: #19A974;
        }
        .form-range::-moz-range-thumb {
            background: #19A974;
        }
    </style>
</head>
<body class="py-5">

    <div class="container">
        
        <!-- Top Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark-custom fs-3 mb-0">Explore Products</h2>
            <a href="index.php" class="text-decoration-none text-custom-primary small fw-semibold"><i class="bi bi-arrow-left"></i> Back to Home</a>
        </div>

        <div class="row g-4">
            
            <!-- Left Side: Filters Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 20px;">
                    <h5 class="fw-bold fs-6 text-dark-custom filter-title mb-4">Price Range</h5>

                    <form id="price-filter-form">
                        <!-- Range Labels -->
                        <div class="d-flex justify-content-between small fw-bold text-dark-custom mb-1">
                            <span id="min-price-label">$0</span>
                            <span id="max-price-label">$500</span>
                        </div>
                        
                        <!-- Range Sliders Container -->
                        <div class="position-relative mb-3">
                            <input type="range" class="form-range w-100" min="0" max="500" value="0" id="minRange">
                            <input type="range" class="form-range w-100 mt-2" min="0" max="500" value="500" id="maxRange">
                        </div>

                        <!-- Number Inputs -->
                        <div class="row g-2 align-items-center mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted border-end-0">$</span>
                                    <input type="number" class="form-control border-start-0 text-dark-custom fw-semibold" id="minInput" value="0" min="0" max="500">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted border-end-0">$</span>
                                    <input type="number" class="form-control border-start-0 text-dark-custom fw-semibold" id="maxInput" value="500" min="0" max="500">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="apply-filter-btn" class="btn custom-primary w-100 py-2 rounded-pill fw-semibold shadow-sm">
                            Apply Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Products Grid & Pagination -->
            <div class="col-lg-9">
                
                <!-- Products Grid Row -->
                <div class="row g-4">
                    
                    <!-- Product Card 1 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white h-100">
                            <div class="position-relative p-3 text-center" style="background-color: #F7FAF9; height: 220px;">
                                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image fs-1 opacity-50"></i>
                                    <span class="small mt-2 text-muted" style="font-size: 11px;">[ Place your image here ]</span>
                                </div>
                                <span class="badge custom-badge-mint position-absolute top-0 start-0 m-3 px-2 py-1">CASUAL WEAR</span>
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="fw-bold fs-6 text-dark-custom mb-2">Vestibulum Auctor</h5>
                                <div class="d-flex align-items-center gap-1 mb-3">
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <span class="text-muted small ms-1" style="font-size: 11px;">(38)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <span class="fw-bold text-dark-custom fs-5">$139.00</span>
                                    <a href="#" class="btn custom-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;"><i class="bi bi-cart3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white h-100">
                            <div class="position-relative p-3 text-center" style="background-color: #F7FAF9; height: 220px;">
                                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image fs-1 opacity-50"></i>
                                    <span class="small mt-2 text-muted" style="font-size: 11px;">[ Place your image here ]</span>
                                </div>
                                <span class="badge bg-dark text-white position-absolute top-0 start-0 m-3 px-2 py-1" style="font-size: 10px;">NEW IN</span>
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="fw-bold fs-6 text-dark-custom mb-2">Praesent Dignissim</h5>
                                <div class="d-flex align-items-center gap-1 mb-3">
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star text-muted" style="font-size: 12px;"></i>
                                    <span class="text-muted small ms-1" style="font-size: 11px;">(24)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <span class="fw-bold text-dark-custom fs-5">$105.00</span>
                                    <a href="#" class="btn custom-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;"><i class="bi bi-cart3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white h-100">
                            <div class="position-relative p-3 text-center" style="background-color: #F7FAF9; height: 220px;">
                                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image fs-1 opacity-50"></i>
                                    <span class="small mt-2 text-muted" style="font-size: 11px;">[ Place your image here ]</span>
                                </div>
                                <span class="badge bg-danger text-white position-absolute top-0 start-0 m-3 px-2 py-1" style="font-size: 10px;">-30%</span>
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="fw-bold fs-6 text-dark-custom mb-2">Curabitur Blandit</h5>
                                <div class="d-flex align-items-center gap-1 mb-3">
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <i class="bi bi-star-fill text-warning" style="font-size: 12px;"></i>
                                    <span class="text-muted small ms-1" style="font-size: 11px;">(61)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <div>
                                        <span class="fw-bold text-dark-custom fs-5 me-2">$69.00</span>
                                        <span class="text-muted text-decoration-line-through small">$99.00</span>
                                    </div>
                                    <a href="#" class="btn custom-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;"><i class="bi bi-cart3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pagination Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 gap-3">
                    <p class="text-muted small mb-0">Displaying page <strong>1</strong> of <strong>10</strong></p>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link rounded-start-pill" href="#"><i class="bi bi-chevron-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                            <li class="page-item"><a class="page-link" href="#">9</a></li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                            <li class="page-item"><a class="page-link rounded-end-pill" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        </ul>
                    </nav>

                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted small">Go to page</span>
                        <input type="number" class="form-control form-control-sm text-center" value="1" style="width: 60px;">
                        <button class="btn custom-primary btn-sm px-3"><i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- JavaScript التفاعلي لفلتر السعر -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const minRange = document.getElementById('minRange');
            const maxRange = document.getElementById('maxRange');
            const minInput = document.getElementById('minInput');
            const maxInput = document.getElementById('maxInput');
            const minLabel = document.getElementById('min-price-label');
            const maxLabel = document.getElementById('max-price-label');
            const applyBtn = document.getElementById('apply-filter-btn');

            function updateFromSliders() {
                let minVal = parseInt(minRange.value);
                let maxVal = parseInt(maxRange.value);

                if (minVal > maxVal) {
                    minRange.value = maxVal;
                    minVal = maxVal;
                }

                minInput.value = minVal;
                maxInput.value = maxVal;
                minLabel.textContent = '$' + minVal;
                maxLabel.textContent = '$' + maxVal;
            }

            function updateFromInputs() {
                let minVal = parseInt(minInput.value) || 0;
                let maxVal = parseInt(maxInput.value) || 500;

                if (minVal < 0) minVal = 0;
                if (maxVal > 500) maxVal = 500;

                if (minVal > maxVal) {
                    minVal = maxVal;
                    minInput.value = minVal;
                }

                minRange.value = minVal;
                maxRange.value = maxVal;
                minLabel.textContent = '$' + minVal;
                maxLabel.textContent = '$' + maxVal;
            }

            minRange.addEventListener('input', updateFromSliders);
            maxRange.addEventListener('input', updateFromSliders);

            minInput.addEventListener('input', updateFromInputs);
            maxInput.addEventListener('input', updateFromInputs);

            applyBtn.addEventListener('click', function () {
                const selectedMin = minInput.value;
                const selectedMax = maxInput.value;
                alert('Filter Applied! Price Range: $' + selectedMin + ' - $' + selectedMax);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>