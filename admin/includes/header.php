<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars($pageTitle ?? 'SmartStore Admin') ?>
    </title>


    
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- ShopEase Admin CSS -->
    <link rel="stylesheet" href="/E-Commerce-Management-System/admin/assets/css/admin.css?v=20260904">

    <script src="/E-Commerce-Management-System/admin/assets/js/form-validation.js" defer></script>
    <script src="/E-Commerce-Management-System/admin/assets/js/admin.js" defer></script>
</head>


<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">