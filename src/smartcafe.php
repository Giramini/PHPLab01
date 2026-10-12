<?php
// Inspect type trước khi cast
echo "<pre>"; // Thêm vô sau reface để hiển thị đẹp mắt hơn
echo "=== TYPE INSPECTION ===" . PHP_EOL;
var_dump($rawQuantity);
echo "Raw quantity type: " . gettype($rawQuantity) . PHP_EOL;

// Normalize
$quantity = (int) $rawQuantity;
var_dump($quantity);
echo "Clean quantity type: " . gettype($quantity) . PHP_EOL;
echo "</pre>";

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

// Receipt (text) - chỉ tạo chuỗi, không echo
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