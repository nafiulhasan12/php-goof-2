<?php
require('func.php');
use PHPMailer\PHPMailer\PHPMailer;

function php() {
    include("db.php");
    // Use a prepared statement to safely insert the title
    $stmt = mysqli_prepare($conn, "INSERT INTO task(title) VALUES (?)");
    if (!$stmt) {
        // Handle prepare error
        error_log('Prepare failed: ' . mysqli_error($conn));
        header('HTTP/1.1 500 Internal Server Error');
        exit;
    }

    // Define the title (could be user input in real use case)
    $title = "[PHPMailer exploit](javascript:alert('Gotcha'))";
    mysqli_stmt_bind_param($stmt, 's', $title);
    if (!mysqli_stmt_execute($stmt)) {
        // Handle execution error
        error_log('Execute failed: ' . mysqli_stmt_error($stmt));
        header('HTTP/1.1 500 Internal Server Error');
        exit;
    }

    mysqli_stmt_close($stmt);
    header('Location: index.php');
    exit;
}


    require('func.php');
	use PHPMailer\PHPMailer\PHPMailer;

	function php() {
		include("db.php");
    	$query = "INSERT INTO task(title) VALUES ('[PHPMailer exploit](javascript&amp;colon;alert%28&#039;Gotcha&#039;%29)')";
    	$result = mysqli_query($conn, $query);
    	header('Location: index.php');
	}

	$msg = '';

	if (isset($_POST['email'])){

	    $email = $_POST['email'];

	    if (PHPMailer::validateAddress($email)) {
	        $msg = 'email valid';
	    } else {
	        $msg = 'Error: invalid email address provided';
	    }

	}

header('Location: index.php');

?>