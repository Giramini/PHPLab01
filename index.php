<?php
// Chủ đề A: SmartCafe Billing - Basic version

// Constants (rule cố định) 
const CURRENCY = "VND";
const MEMBER_DISCOUNT_RATE = 0.08;
const MEMBER_MIN = 150000;
const PACKAGING_FEE_PER_ITEM = 1500;
const SERVICE_RATE = 0.07;

// Raw data
$productName = "Caramel Latte";
$unitPrice = 52000;
$rawQuantity = "4";


$customerStatus = "MEMBER";
$productAvailable = true;

// Inspect type trước khi cast 
echo "=== TYPE INSPECTION ===" . PHP_EOL;
var_dump($rawQuantity);
echo "Raw quantity type: " . gettype($rawQuantity) . PHP_EOL;

// Normalize
$quantity = (int) $rawQuantity;
var_dump($quantity);
echo "Clean quantity type: " . gettype($quantity) . PHP_EOL;

// Calculation
$subtotal = $unitPrice * $quantity;

$isMember = $customerStatus === "MEMBER";
$isDiscountEligible = $isMember && $subtotal >= MEMBER_MIN;
$discount = $isDiscountEligible ? $subtotal * MEMBER_DISCOUNT_RATE : 0;

$afterDiscount = $subtotal - $discount;
$packagingFee = $quantity * PACKAGING_FEE_PER_ITEM;
$serviceFee = $afterDiscount * SERVICE_RATE;

$total = $subtotal - $discount + $packagingFee + $serviceFee;

// Checkout gate
$hasValidQuantity = $quantity > 0;
$isValidCustomer = $customerStatus === "MEMBER" || $customerStatus === "GUEST";
$canOrder = $hasValidQuantity && $productAvailable && $isValidCustomer;

// Receipt (text)
$receipt = "=== SMARTCAFE RECEIPT ===" . PHP_EOL;
$receipt .= "Product: " . $productName . PHP_EOL;
$receipt .= "Unit Price: " . $unitPrice . " " . CURRENCY . PHP_EOL;
$receipt .= "Quantity: " . $quantity . PHP_EOL;
$receipt .= "Subtotal: " . $subtotal . " " . CURRENCY . PHP_EOL;
$receipt .= "Discount: " . $discount . " " . CURRENCY . PHP_EOL;
$receipt .= "Packaging Fee: " . $packagingFee . " " . CURRENCY . PHP_EOL;
$receipt .= "Service Fee: " . $serviceFee . " " . CURRENCY . PHP_EOL;
$receipt .= "Total: " . $total . " " . CURRENCY . PHP_EOL;
$receipt .= "Status: " . ($canOrder ? "READY TO ORDER" : "BLOCKED") . PHP_EOL;

echo $receipt;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartCafe</title>
</head>
<body>
    <h1>SmartCafe Receipt</h1>
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