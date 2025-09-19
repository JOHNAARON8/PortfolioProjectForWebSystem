<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Admin email (receiver)
$admin_email = "johnaroncadag007@gmail.com";

// Collect form data
$firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$lastName  = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$email     = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject   = isset($_POST['subject']) ? trim($_POST['subject']) : 'No Subject';
$message   = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.'
    ]);
    exit;
}

$fullName = $firstName . " " . $lastName;

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'johnaroncadag007@gmail.com'; // Your Gmail
    $mail->Password   = 'fwaz hzmb jcao uvoe';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('johnaroncadag007@gmail.com', 'Portfolio Contact'); // fixed sender
    $mail->addAddress($admin_email, 'Portfolio Owner');             // admin inbox
    $mail->addReplyTo($email, $fullName);                           // so replies go to sender

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "Portfolio Contact: " . htmlspecialchars($subject);
    $mail->Body    = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { padding: 10px; }
                .message { background: #f9f9f9; padding: 10px; border-left: 4px solid #6366f1; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> {$fullName}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <div class='message'>
                    <p>" . nl2br(htmlspecialchars($message)) . "</p>
                </div>
            </div>
        </body>
        </html>
    ";
    $mail->AltBody = "Name: $fullName\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    $mail->send();

    // Success response (AJAX-ready)
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => '✅ Message sent successfully!'
    ]);

} catch (Exception $e) {
    // Error response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => '❌ Message could not be sent. Error: ' . $mail->ErrorInfo
    ]);
}
