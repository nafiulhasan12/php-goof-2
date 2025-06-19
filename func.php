<?php 
    require __DIR__.'/vendor/autoload.php';
	include("db.php");

    use League\CommonMark\CommonMarkConverter;

    $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

	if (isset($_GET['edid'])){

	    $id = $_GET['edid'];

<?php
require __DIR__.'/vendor/autoload.php';
include('db.php');
use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

if (isset($_GET['edid'])) {
    // Cast to int to enforce numeric type and prevent injection
    $id = (int) $_GET['edid'];

    // Use a single prepared statement correctly
    $stmt = $conn->prepare('SELECT * FROM task WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $_SESSION['message'] = 'Edit Task';
        $_SESSION['message_type'] = 'info';
    }
}
?>
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