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


    
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >


    
    <link
        rel="stylesheet"
        href="/E-Commerce-Management-System/admin/assets/css/admin.css?v=20260903"
    >

    <script
        src="/E-Commerce-Management-System/admin/assets/js/form-validation.js?v=20260903"
        defer
    ></script>

</head>


<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">