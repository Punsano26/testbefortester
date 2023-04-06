<?php

if (isset($_GET['P_id'])) {
    require '../connected.php';

    $query = "DELETE FROM patient WHERE P_id = :P_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':P_id', $_GET['P_id']);

    if ($stmt->execute()) {
        $mess = "list Deleted!!!";
        header('location:index.php');
    } else {
        $mess = "Failed Delete!!!";
    }

    echo $mess;
    $conn = null;

}



?>