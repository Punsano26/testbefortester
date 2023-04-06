<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <title>Update patient </title>
</head>

<body>

  <?php
  require '../connected.php';

  $sql_select_country = "SELECT * FROM permissions";
  $stmt_c = $conn->prepare($sql_select_country);
  $stmt_c->execute();
  echo "P_id = " . $_GET['P_id'];

  if (isset($_GET['P_id'])) {
    $sql_select_customer = 'SELECT * FROM patient WHERE P_id=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['P_id']]);
    echo "get = " . $_GET['P_id'];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-md-4"> <br>
        <h3>ฟอร์มแก้ไขข้อมูลผู้ป่วย</h3>
        <form action="updatepatient.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="P_id" value="<?= $_GET['P_id'] ?>">

          <label for="name" class="col-sm-2 col-form-label"> ชื่อ: </label>

          <input type="text" name="P_name" class="form-control" required value="<?= $result['P_name'] ?>">
          
          <label for="name" class="col-sm-2 col-form-label"> วันเดือนปีเกิด: </label>

          <input type="date" name="P_DOB" class="form-control" required value="<?= $result['P_DOB'] ?>">

          <label for="name" class="col-sm-2 col-form-label"> ยอดนี้ : </label>

          <input type="text" name="P_debt" class="form-control" required value="<?= $result['P_debt'] ?>">

          <label for="name" class="col-sm-2 col-form-label"> ภาพ : </label>

          <input type="file" name="imgs" class="form-control" required value="">

          <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
        </form>
      </div>
    </div>
  </div>

</body>