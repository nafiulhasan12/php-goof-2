<?php

require('func.php');

if(isset($_POST['save_task'])){
    
    $title = urlencode($_POST['title']);

    if(isset($_POST['edid'])) { 
        $edid = $_POST['edid'];
if(isset($_POST['edid'])) {
    $edid = filter_input(INPUT_POST, 'edid', FILTER_SANITIZE_NUMBER_INT);
    $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");$stmt->bind_param('si', $title, $edid);$result = $stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)");$stmt->bind_param('s', $title);$result = $stmt->execute();
}
    }
if(isset($_POST['edid'])) {
    $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
    $stmt->bind_param('si', $title, filter_input(INPUT_POST, 'edid', FILTER_SANITIZE_NUMBER_INT));
    $result = $stmt->execute();
}
    if(isset($_POST['edid'])) {
        $edid = filter_input(INPUT_POST, 'edid', FILTER_SANITIZE_NUMBER_INT);
        $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
        $stmt->bind_param('si', $title, $edid);
    } else {
        $stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)");
        $stmt->bind_param('s', $title);
    }
    $result = $stmt->execute();
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }
    
    $_SESSION['message'] = 'Task saved successfully';
    $_SESSION['message_type'] = 'success';

} elseif (isset($_GET['delid'])) {

        $id = $_GET['delid'];

        $edid = filter_input(INPUT_POST, 'edid', FILTER_SANITIZE_NUMBER_INT);
        $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
        $stmt->bind_param('si', $title, $edid);
        $result = $stmt->execute();
    if($edid){
        $stmt = $conn->prepare("UPDATE task SET title = ? WHERE id = ?");
        $stmt->bind_param('si',$title,$edid);
    }else{ $stmt = $conn->prepare("INSERT INTO task(title) VALUES (?)"); $stmt->bind_param('s',$title); }$result = $stmt->execute();
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