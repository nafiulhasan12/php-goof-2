<?php 
    require __DIR__.'/vendor/autoload.php';
	include("db.php");

    use League\CommonMark\CommonMarkConverter;

use League\CommonMark\CommonMarkConverter;

	if (isset($_GET['edid'])){

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