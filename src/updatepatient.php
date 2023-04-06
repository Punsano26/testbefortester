<?php

if (isset($_POST['P_id'])) {
    require '../connected.php';

    $P_id = $_POST['P_id'];
    $P_name = $_POST['P_name'];
    $P_DOB = $_POST['P_DOB'];
    $P_debt = $_POST['P_debt'];
    

    echo 'P_id = ' . $P_id;
    echo 'P_name = ' . $P_name;
    echo 'P_DOB = ' . $P_DOB;
    echo 'P_debt = ' . $P_debt; 
   
    $uploadFile = $_FILES['imgs']['name'];
    $tmpFile = $_FILES['imgs']['tmp_name'];
    echo " upload file = " . $uploadFile;
    echo " tmp file = " . $tmpFile;
    
    $stmt = $conn->prepare(
        'UPDATE  patient SET P_name = :P_name, P_DOB = :P_DOB, P_debt = :P_debt, imgs = :imgs WHERE P_id=:P_id'
    );
    $stmt->bindparam(':P_name',$_POST['P_name']);
    $stmt->bindparam(':P_DOB',$_POST['P_DOB']);
    $stmt->bindparam(':P_debt',$_POST['P_debt']);
    $stmt->bindparam(':P_id', $_POST['P_id']);
    $stmt->bindparam(':imgs', $uploadFile);
    $stmt->execute();

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() >= 0) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update customer information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
?>
