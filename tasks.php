<?php

require('func.php');

if(isset($_POST['save_task'])){
    
    $title = urlencode($_POST['title']);

    if(isset($_POST['edid'])) { 
        $edid = $_POST['edid'];
$stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)");
$stmt->bind_param('s', $title);
$stmt->execute();
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

        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        }
        $_SESSION['message'] = 'Task removed successfully';
        $_SESSION['message_type'] = 'warning';

}

header('Location: index.php');

?>