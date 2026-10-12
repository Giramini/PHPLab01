<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartCafe System</title>
</head>
<body>
    <h1>SmartCafe System Receipt</h1>
    <p>Product: <?= $productName ?></p>
    <p>Unit Price: <?= $unitPrice ?> <?= CURRENCY ?></p>
    <p>Quantity: <?= $quantity ?></p>
    <p>Subtotal: <?= $subtotal ?> <?= CURRENCY ?></p>
    <p>Discount: <?= $discount ?> <?= CURRENCY ?></p>
    <p>Packaging Fee: <?= $packagingFee ?> <?= CURRENCY ?></p>
    <p>Service Fee: <?= $serviceFee ?> <?= CURRENCY ?></p>
    <p><strong>Total: <?= $total ?> <?= CURRENCY ?></strong></p>
    <p>Status: <?= $canOrder ? "READY TO ORDER" : "BLOCKED" ?></p>
</body>
</html>