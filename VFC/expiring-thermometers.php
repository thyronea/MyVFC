<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expiring Thermometers</title>
    <link type="text/css" rel="stylesheet" href="/Scheduler/css/layout.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
              <a class="nav-link dropdown-toggle active" href="provider-visits.php" role="button" data-bs-toggle="dropdown">Thermometer</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="thermometers.php">Search</a></li>
                <li><a class="dropdown-item" href="expired-thermometers.php">Expired Thermometers</a></li>
                <li><a class="dropdown-item active" href="expiring-thermometers.php">Expiring Thermometers</a></li>
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
                <li><a class="dropdown-item" href="/Scheduler/doctor.php">MyVFC-Scheduler</a></li>
              </ul>
            </li>

          </ul>

        </div>
      </div>
    </nav>

      <div class="header">
        <h3>MyVFC-Expiring Thermometers</h3>
      </div>

      <?php
      include('message.php');
      ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-4">
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>VFC PIN</th>
                      <th>Name of Practice</th>
                      <th>County</th>
                      <th>Thermometer Location</th>
                      <th>Model</th>
                      <th>Serial No.</th>
                      <th>Exp Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                      // Display provider table
                      $query1 = "SELECT * FROM Thermometers WHERE exp BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 90 DAY)";
                      $query_run1 = mysqli_query($con, $query1);
                      if(mysqli_num_rows($query_run1) > 0 )
                      {
                        foreach ($query_run1 as $expiring)
                        {
                          ?>
                          <tr>
                            <td >
                            <a href="provider-view.php?id=<?= $expiring['pin']; ?>"><?= $expiring['pin']; ?></a>
                            </td>
                            <td><?= $expiring['name']; ?></td>
                            <td><?= $expiring['county']; ?></td>
                            <td><?= $expiring['location']; ?></td>
                            <td><?= $expiring['model']; ?></td>
                            <td><?= $expiring['serial']; ?></td>
                            <td style="color:#FFA500"><?= $expiring['exp']; ?></td>
                            <td>
                              <a href="email-expiring.php?id=<?= $expiring['pin']; ?>" class="btn btn-outline-success btn-sm" target="_blank">Email</a>
                            </td>
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
