<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {

    session_unset();
    session_destroy();

    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirecting...</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: "warning",
                title: "Access Denied",
                text: "You need to log in first!",
                confirmButtonText: "Go to Login",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(() => {
                window.location.href = "../LoginForm.php";
            });
        </script>
    </body>
    </html>
    ';
    exit;
}
?>
