<?php
session_start();
require 'dbcon.pbp';
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provider Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card mt-4">
            <div class="card-header">
              <h4>Provider Search
              <a href="home.php" class="btn btn-outline-success float-end" name="button">Home</a>
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-7">

                  <form class="" action="" method="get">
                    <div class="input-group mb-3">
                      <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search for PIN, name of practice, County, VFC Coordinator, email or phone " aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <button type="submit" class="btn btn-primary" name="button">Search</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-4">
          <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>VFC PIN</th>
                <th>Name of Practice</th>
                <th>County</th>
                <th>VFC Coordinator</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              <?php
                require 'dbcon.php';

                if(isset($_GET['search']))
                {
                  $filtervalues = $_GET['search'];
                  $query = "SELECT * FROM Providers WHERE CONCAT(pin,name,county,coordinator,email,phone) LIKE '%$filtervalues%' ";
                  $query_run = mysqli_query($con, $query);

                  if(mysqli_num_rows($query_run) > 0)
                  {
                    foreach ($query_run as $providers)
                    {
                      ?>
                      <tr>
                        <td >
                        <a href="provider-view.php?id=<?= $providers['pin']; ?>"><?= $providers['pin']; ?></a>
                        </td>
                        <td><?= $providers['name']; ?></td>
                        <td><?= $providers['county']; ?></td>
                        <td><?= $providers['coordinator']; ?></td>
                        <td><?= $providers['email']; ?></td>
                        <td><?= $providers['phone']; ?></td>
                      </tr>
                      <?php
                    }
                  }
                    else
                    {
                      ?>
                        <tr>
                          <td colspan="4">No Record Found</td>
                        </tr>
                      <?php
                    }
                  }
              ?>

            </tbody>
          </table>

            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>
</html>
