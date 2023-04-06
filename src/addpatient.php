<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>User Registration 265</title>
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            /* or some other value */
            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require '../connected.php';

    $sql_select = 'select * from permissions order by P_CID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {
        //if ((isset($_POST['customerID']) && isset($_POST['name'])) != null)
        if (!empty($_POST['P_id']) && !empty($_POST['P_name'])) {
            echo '<br>' . $_POST['P_id'];

            $uploadFile = $_FILES['imgs']['name'];
            $tmpFile = $_FILES['imgs']['tmp_name'];
            echo " upload file = " . $uploadFile;
            echo " tmp file = " . $tmpFile;

            $sql = "insert into patient 
							values (:P_id, :P_name, :P_DOB, :P_debt, :imgs)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':P_id', $_POST['P_id']);
            $stmt->bindParam(':P_name', $_POST['P_name']);
            $stmt->bindParam(':P_DOB', $_POST['P_DOB']);
            $stmt->bindParam(':P_debt', $_POST['P_debt']);
            $stmt->bindParam(':imgs', $uploadFile);
            echo "imgs = " . $uploadFile;


            $fullpath = "../images/" . $uploadFile;
            echo " fullpath = " . $fullpath;
            move_uploaded_file($tmpFile, $fullpath);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()):
                    //$message = 'Successfully add new customer';
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add customer",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else:
                    $message = 'Fail to add new customer';
                endif;
                // echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มข้อมูลผู้ป่วย</h3>
                <form action="addpatient.php" method="POST" enctype="multipart/form-data">
                    <!-- ศึกษาเพิ่มเติมการอัปโหลดไฟล์ https://www.w3schools.com/php/php_file_upload.asp -->
                    <input type="text" placeholder="รหัสผู้ป่วย" name="P_id" required>
                    <br> <br>
                    <input type="text" placeholder="ชื่อผู้ป่วย" name="P_name" required>
                    <br> <br>
                    <input type="date" placeholder="วันเกิด" name="P_DOB">
                    <br> <br>
                    <input type="text" placeholder="ยอดหนี้" name="P_debt">
                    <br> <br>
                    แนบรูปภาพ:
                    <input type="file" name=imgs required>
                    <br><br>
                    <input type="submit" value="Submit" name="submit" />
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#customerTable').DataTable();
        });
    </script>



</body>

</html>