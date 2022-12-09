<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overdue Visits</title>
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
              <a class="nav-link dropdown-toggle active" href="provider-visits.php" role="button" data-bs-toggle="dropdown">Activity</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="provider-visits.php">Compliance Visit</a></li>
                <li><a class="dropdown-item active" href="expired-visit.php">Overdue</a></li>
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
        <h3>MyVFC-Overdue Compliance Visits</h3>
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
                      <tr>
                        <th>VFC PIN</th>
                        <th>Name of Practice</th>
                        <th>County</th>
                        <th>Point of Contact</th>
                        <th>Visit Type</th>
                        <th>Conducted by</th>
                        <th>Visit Date</th>
                        <th>Due by</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                        // Display Activity
                        $query1 = "SELECT * FROM Activities WHERE next <= DATE(now())";
                        $query_run1 = mysqli_query($con, $query1);
                        if(mysqli_num_rows($query_run1) > 0 )
                        {
                          foreach ($query_run1 as $date)
                          {
                            ?>

                            <tr>
                              <td >
                              <a href="provider-view.php?id=<?= $date['pin']; ?>"><?= $date['pin']; ?></a>
                              </td>
                              <td><?= $date['name']; ?></td>
                              <td><?= $date['county']; ?></td>
                              <td><?= $date['contact']; ?></td>
                              <td><?= $date['type']; ?></td>
                              <td><?= $date['rep']; ?></td>
                              <td><?= $date['date']; ?></td>
                              <td style="color:#FF0000"><?= $date['next']; ?></td>
                              <td>
                                <a href="email-expired-activity.php?id=<?= $date['pin']; ?>" class="btn btn-outline-success btn-sm" target="_blank">Email</a>
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
