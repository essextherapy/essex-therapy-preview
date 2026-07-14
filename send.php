<?php
/* ============================================================
   Essex Therapy — contact form handler
   ------------------------------------------------------------
   CHANGE THIS to the email address that should receive enquiries:
   ============================================================ */
$TO = "clare@essextherapy.com";   // <-- enquiries are sent here (change if needed)
$SUBJECT = "New enquiry from Essex Therapy website";

/* --- basic checks --- */
if ($_SERVER["REQUEST_METHOD"] !== "POST") { header("Location: contact.html"); exit; }
if (!empty($_POST["website"])) { header("Location: contact.html?sent=1"); exit; } // honeypot: silently drop spam

$first   = trim($_POST["first"]   ?? "");
$last    = trim($_POST["last"]    ?? "");
$email   = trim($_POST["email"]   ?? "");
$phone   = trim($_POST["phone"]   ?? "");
$message = trim($_POST["message"] ?? "");

if ($first === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === "") {
  header("Location: contact.html?error=1"); exit;
}

$body  = "New enquiry from the Essex Therapy website:\n\n";
$body .= "Name:    $first $last\n";
$body .= "Email:   $email\n";
$body .= "Phone:   $phone\n\n";
$body .= "Message:\n$message\n";

$headers  = "From: Essex Therapy Website <no-reply@essextherapy.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($TO, $SUBJECT, $body, $headers)) {
  header("Location: contact.html?sent=1");
} else {
  header("Location: contact.html?error=1");
}
exit;
