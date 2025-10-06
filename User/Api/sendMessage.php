<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$admin_email = "johnaroncadag007@gmail.com";

$firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$lastName  = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$email     = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject   = isset($_POST['subject']) ? trim($_POST['subject']) : 'No Subject';
$message   = isset($_POST['message']) ? trim($_POST['message']) : '';


$redirectURL = '../MyPortfolio.php';

if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
    header('Location: ' . $redirectURL . '?status=error&msg=Please+fill+in+all+required+fields');
    exit;
}

$fullName = $firstName . " " . $lastName;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'johnaroncadag007@gmail.com';
    $mail->Password   = 'fwaz hzmb jcao uvoe';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('johnaroncadag007@gmail.com', 'Portfolio Contact');
    $mail->addAddress($admin_email, 'Portfolio Owner');
    $mail->addReplyTo($email, $fullName);

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
                <h2>You have new message from {$fullName}</h2>
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

    header('Location: ' . $redirectURL . '?status=success&msg=Message+sent+successfully');
    exit;

} catch (Exception $e) {
    header('Location: ' . $redirectURL . '?status=error&msg=Message+could+not+be+sent');
    exit;
}
