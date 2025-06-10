<?php

require('func.php');

if(isset($_POST['save_task'])){
    
    $title = urlencode($_POST['title']);

$title = mysqli_real_escape_string($conn, $_POST['title']);
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