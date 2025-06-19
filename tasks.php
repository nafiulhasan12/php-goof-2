<?php
require('func.php');
session_start();

if (isset($_POST['save_task'])) {
    // Retrieve and validate inputs
    $title = trim($_POST['title']);
    if (empty($title)) {
        die('Title cannot be empty');
    }

    if (isset($_POST['edid']) && ctype_digit($_POST['edid'])) {
        $edid = (int) $_POST['edid'];
        // Use a prepared statement for UPDATE
        $stmt = $conn->prepare('UPDATE task SET title = ? WHERE id = ?');
        $stmt->bind_param('si', $title, $edid);
    } else {
        // Use a prepared statement for INSERT
        $stmt = $conn->prepare('INSERT INTO task(title) VALUES (?)');
        $stmt->bind_param('s', $title);
    }

    if (!$stmt->execute()) {
        die('Database operation failed: ' . $stmt->error);
    }
    $stmt->close();

    $_SESSION['message']      = 'Task saved successfully';
    $_SESSION['message_type'] = 'success';

} elseif (isset($_GET['delid']) && ctype_digit($_GET['delid'])) {
    $delid = (int) $_GET['delid'];
    // Use a prepared statement for DELETE
    $stmt = $conn->prepare('DELETE FROM task WHERE id = ?');
    $stmt->bind_param('i', $delid);

    if (!$stmt->execute()) {
        die('Database operation failed: ' . $stmt->error);
    }
    $stmt->close();

    $_SESSION['message']      = 'Task removed successfully';
    $_SESSION['message_type'] = 'warning';
}

header('Location: index.php');
exit;
?>

require('func.php');

if(isset($_POST['save_task'])){
    
    $title = urlencode($_POST['title']);

    if(isset($_POST['edid'])) { 
        $edid = $_POST['edid'];
        $query = "UPDATE task SET title = '$title' WHERE id = '$edid'";
    }
    else $query = "INSERT INTO task(title) VALUES ('$title')";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }
    
    $_SESSION['message'] = 'Task saved successfully';
    $_SESSION['message_type'] = 'success';

} elseif (isset($_GET['delid'])) {

        $id = $_GET['delid'];

$stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)");
$stmt->bind_param('s', $title);
$stmt->execute();

if(isset($_POST['edid'])) {
    $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
    $stmt->bind_param('si', $title, $edid);
    $stmt->execute();
}
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        }
        $_SESSION['message'] = 'Task removed successfully';
        $_SESSION['message_type'] = 'warning';

}

header('Location: index.php');

?>