<?php
// Process form submission and prepare data for redirection

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pg_name = htmlspecialchars($_POST['pg_name']);
    $amount = htmlspecialchars($_POST['amount']);
    $payment_type = htmlspecialchars($_POST['payment_type']);
    
    // Payment details based on payment type
    $payment_details = "";
    if ($payment_type === "credit_card") {
        $cc_number = htmlspecialchars($_POST['cc_number']);
        $cc_expiry = htmlspecialchars($_POST['cc_expiry']);
        $cc_cvv = htmlspecialchars($_POST['cc_cvv']);
        $payment_details = "Credit Card Number: ** ** ** " . substr($cc_number, -4) . "<br>"
                        . "Expiry Date: " . $cc_expiry . "<br>"
                        . "CVV: " . $cc_cvv;
    } elseif ($payment_type === "debit_card") {
        $dc_number = htmlspecialchars($_POST['dc_number']);
        $dc_expiry = htmlspecialchars($_POST['dc_expiry']);
        $dc_cvv = htmlspecialchars($_POST['dc_cvv']);
        $payment_details = "Debit Card Number: ** ** ** " . substr($dc_number, -4) . "<br>"
                        . "Expiry Date: " . $dc_expiry . "<br>"
                        . "CVV: " . $dc_cvv;
    } elseif ($payment_type === "paypal") {
        $paypal_email = htmlspecialchars($_POST['paypal_email']);
        $payment_details = "PayPal Email: " . $paypal_email;
    } elseif ($payment_type === "upi") {
        $upi_id = htmlspecialchars($_POST['upi_id']);
        $payment_details = "UPI ID: " . $upi_id;
    } elseif ($payment_type === "cash") {
        $payment_details = "Cash Payment";
    }

    // Redirect to payment submitted page with data as query parameters
    $redirect_url = "payment-submitted.html?";
    $redirect_url .= "name=" . urlencode($name) . "&";
    $redirect_url .= "email=" . urlencode($email) . "&";
    $redirect_url .= "pg_name=" . urlencode($pg_name) . "&";
    $redirect_url .= "amount=" . urlencode($amount) . "&";
    $redirect_url .= "payment_type=" . urlencode($payment_type) . "&";
    $redirect_url .= "payment_details=" . urlencode($payment_details);

    // Redirect
    header("Location: " . $redirect_url);
    exit();
}
?>