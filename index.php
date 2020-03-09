<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>PHP CRUD</title>
  </head>
  <body>
    <?php require_once 'process.php'; ?>

    <?php 
      if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
          <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message'])
          ?>
        </div>
    <?php endif ?>

    <div class="container">
    <?php
      $mysqli = new mysqli('localhost', 'root', '', 'crud_alpin') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM data");
      //pre_r($result);
    ?>

    <div class="row justify-content-center">
      <table class="table table-hover table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Name</th>
            <th>Location, Date of birth</th>
            <th>Religion</th>
            <th>Gender</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>

        <?php
        $no = 1;
        while($row = $result->fetch_assoc()) : ?>

          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nik']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['location']; ?></td>
            <td><?= $row['religion']; ?></td>
            <td><?= $row['gender']; ?></td>
            <td>
              <a href="index.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
              <a href="process.php?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>

        <?php endwhile; ?>
      </table>
    </div>

    <?php
      function pre_r($array){
        echo '<pre>';
          print_r($array);
        echo '</pre>';
    }
    ?>

    <div class="row justify-content-center">
      <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?= $id; ?>">

        <div class="form-group">
          <label>NIK</label>
          <input type="text" name="nik" class="form-control" value="<?= $nik; ?>" placeholder="Enter your NIK">
        </div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?= $name; ?>" placeholder="Enter your name">
        </div>
        
        <div class="form-group">
          <label>Location, Date of birth</label>
          <input type="text" name="location" class="form-control" value="<?= $location; ?>" placeholder="Enter your location">
        </div>

        <div class="form-group">
          <label>Religion</label>
          <input type="text" name="religion" class="form-control" value="<?= $religion; ?>" placeholder="Enter your Religion">
        </div>

        <div class="form-group">
          <label>Gender</label>
          <input type="text" name="gender" class="form-control" value="<?= $gender; ?>" placeholder="Enter your gender">
        </div>
        
        <div class="form-group">
          <?php 
          if($update == true): ?>
            <button type="submit" name="update" class="btn btn-info">Update</button>
          <?php else: ?>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          <?php endif; ?>
        </div>

      </form>
    </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>