<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>CRUD Hospital</title>
        <style>
            img {
    transition: transform 0.25s ease;
}

img:hover {
    -webkit-transform: scale(5);
    /* or some other value */
    transform: scale(5);
}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <br>
                    <h3>ระบบข้อมูลผู้ป่วย <a href="addpatient.php" class="btn btn-info float-end">+เพิ่มรายการ</a> </h3>
                    <table class="table table-striped  table-hover table-responsive table-bordered">
                        <thead align="center">                        
                            <tr>
                                <th width="10%">รหัสผู้ป่วย</th>
                                <th width="20%">ชื่อ-นามสกุล</th>
                                <th width="20%">วันเดือนปีเกิด</th>
                                
                                <th width="10%">ยอหนี้</th>

                                <th width="10%">imgs</th>

                                <th width="5%">แก้ไข</th>
                                <th width="5%">ลบ</th>
                            </tr>                       
                        </thead>

                        <tbody>
                          <?php
                            require '../connected.php';
                            $sql =  "SELECT * FROM patient
                                    ORDER BY P_id";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r[0] ?></td>
                                <td><?= $r[1] ?></td>
                                <td><?= $r[2] ?></td>
                                <td><?= $r[3] ?></td>
                                <td><img src="../images/<?= $r[4]; ?>" width="50px" height="50" alt="image"
                                        onclick="enlargeImg()" id="img1"></td>
                                <td><a href="updatepatientform.php?P_id=<?= $r['P_id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="deletepatient.php?P_id=<?= $r['P_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                          <?php 
                                }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </body>
</html>