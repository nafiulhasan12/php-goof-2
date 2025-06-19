<?php 
    require __DIR__.'/vendor/autoload.php';
	include("db.php");

    use League\CommonMark\CommonMarkConverter;

    $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

	if (isset($_GET['edid'])){
<?php
session_start();
require __DIR__.'/vendor/autoload.php';
include 'db.php';

use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter([
    'html_input' => 'escape',
    'allow_unsafe_links' => false
]);

if (isset($_GET['edid'])) {
    // Validate and cast to integer to prevent injection
    $id = intval($_GET['edid']);

    // Use a prepared statement only, remove raw query
    $stmt = $conn->prepare('SELECT * FROM task WHERE id = ?');
    if ($stmt === false) {
        // Handle prepare error
        error_log('Prepare failed: ' . $conn->error);
        exit('Database error');
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        // Escape output to prevent XSS
        $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');

        $_SESSION['message'] = 'Edit Task';
        $_SESSION['message_type'] = 'info';
    }
    $stmt->close();
}
?>
	    $id = $_GET['edid'];

$stmt = $conn->prepare('SELECT * FROM task WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
	    $result = mysqli_query($conn, $query);

	    if(mysqli_num_rows($result) == 1){
	        $row = mysqli_fetch_array($result);
	        $title = $row['title'];

	        $_SESSION['message'] = 'Edit Task';
	        $_SESSION['message_type'] = 'info';
	    }
	}


?>