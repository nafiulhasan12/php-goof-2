<?php
require('func.php');
session_start();

if (isset($_POST['save_task'])) {
    $title = trim($_POST['title']);
    if (isset($_POST['edid'])) {
        $edid = intval($_POST['edid']);
        $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
        $stmt->bind_param('si', $title, $edid);
    } else {
        $stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)");
        $stmt->bind_param('s', $title);
    }
    if (!$stmt->execute()) {
        error_log($stmt->error);
        die("Database operation failed");
    }
    $_SESSION['message'] = 'Task saved successfully';
    $_SESSION['message_type'] = 'success';
} elseif (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $stmt = $conn->prepare("DELETE FROM task WHERE id = ?");
    $stmt->bind_param('i', $delid);
    if (!$stmt->execute()) {
        error_log($stmt->error);
        die("Database operation failed");
    }
    $_SESSION['message'] = 'Task removed successfully';
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