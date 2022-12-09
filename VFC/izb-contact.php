<?php
session_start();
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IZB Contact Search</title>
    <link type="text/css" rel="stylesheet" href="/Scheduler/css/layout.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-light sticky-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">

          <ul class="navbar-nav me-4 nav nav-tabs" style="--bs-scroll-height: 100px;">

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.php">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Provider</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Search</a></li>
                <li><a class="dropdown-item" href="provider-add.php">Add</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="provider-visits.php" role="button" data-bs-toggle="dropdown">Thermometer</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="thermometers.php">Search</a></li>
                <li><a class="dropdown-item" href="expired-thermometers.php">Expired Thermometers</a></li>
                <li><a class="dropdown-item" href="expiring-thermometers.php">Expiring Thermometers</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="reference-guide.php">DDL Reference Guide</a></li>
                <li><a class="dropdown-item" href="reference-add.php">Add Reference</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="provider-visits.php" role="button" data-bs-toggle="dropdown">Activity</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="provider-visits.php">Compliance Visit</a></li>
                <li><a class="dropdown-item" href="expiring-visit.php">Overdue</a></li>
                <li><a class="dropdown-item" href="expiring-visit.php">Overdue in 90 Days</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="doctor.php">MyVFC-Scheduler</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="provider-visits.php" role="button" data-bs-toggle="dropdown">IZ Branch</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="izb-add.php" selected>Add IZ contact</a></li>
              </ul>
            </li>

          </ul>

          <form class="d-flex" role="search" method="get">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" >
            <button class="btn btn-outline-success" type="submit" name="button">Search</button>
          </form>

        </div>
      </div>
    </nav>

    <div class="header">
        <h3>MyVFC-IZ Branch</h3>
    </div>


      <?php
      include('message.php');
      ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-4">
            <div class="tablefixhead">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Section</th>
                  <th>Title</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>

                <?php

                  if(isset($_GET['search']))
                  {
                    $filtervalues = $_GET['search'];
                    $query = "SELECT * FROM Branch WHERE CONCAT(name,section,title,email,phone) LIKE '%$filtervalues%' ";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                      foreach ($query_run as $person)
                      {
                        ?>
                        <tr>
                          <td >
                          <a href="<?= $person['linkedin']; ?>" target="_blank"><?= $person['name']; ?></a>
                          </td>
                          <td><?= $person['section']; ?></td>
                          <td><?= $person['title']; ?></td>
                          <td><a href=mailto:"<?=$person['email']; ?>"><?=$person['email']; ?></a></td>
                          <td><a href=tel:"<?=$person['phone']; ?>"><?=$person['phone']; ?></a></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>

</html>
