<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VFC Visits</title>
    <link type="text/css" rel="stylesheet" href="/Scheduler/css/layout.css"/>
    <link rel="stylesheet" href="/VFC/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

    <!-- <nav class="navbar navbar-expand-lg bg-light fixed-top">
      <div class="container-fluid">

        <a class="navbar-brand nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          VFC Visits
        </a>

        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="expired-visit.php">Overdue Visits</a></li>
          <li><a class="dropdown-item" href="expiring-visit.php">Overdue in 90 days</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="index.php">VFC Providers</a></li>
          <li><a class="dropdown-item" href="index.php">Add VFC Provider</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="thermometers.php">Thermometers</a></li>
          <li><a class="dropdown-item" href="expired-thermometers.php">Expired Thermometers</a></li>
          <li><a class="dropdown-item" href="expiring-thermometers.php">Expiring Thermometers (90 Days)</a></li>
          <li><a class="dropdown-item" href="reference-guide.php">DDL Reference Guide</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="home.php">Home</a></li>
        </ul>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <form class="" action="" method="get">
                <div class="input-group">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search for PIN, County, Type of Visit" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button type="submit" class="btn btn-primary btn-sm" name="button">Search</button>
              </div>
            </form>
            </li>
          </ul>
        </div>

      </div>
    </nav> -->

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
                <li><a class="dropdown-item" href="expired-visit.php">Overdue</a></li>
                <li><a class="dropdown-item" href="expiring-visit.php">Overdue in 90 Days</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/Scheduler/doctor.php">MyVFC-Scheduler</a></li>
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
          <h3>MyVFC-Compliance Visit</h3>
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
                  <th>VFC PIN</th>
                  <th>Name of Practice</th>
                  <th>County</th>
                  <th>Point of Contact</th>
                  <th>Visit Type</th>
                  <th>Conducted by</th>
                  <th>Date of Visit</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  if(isset($_GET['search']))
                  {
                    $filtervalues = $_GET['search'];
                    $query = "SELECT * FROM Activities WHERE CONCAT(pin,name,county,rep,type,date) LIKE '%$filtervalues%' ";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                      foreach ($query_run as $activity)
                      {
                        ?>
                        <tr>
                          <td>
                            <a href="provider-view.php?id=<?= $activity['pin']; ?>"><?= $activity['pin']; ?></a>
                          </td>
                          <td><?= $activity['name']; ?></td>
                          <td><?= $activity['county']; ?></td>
                          <td><?= $activity['contact']; ?></td>
                          <td><?= $activity['type']; ?></td>
                          <td><?= $activity['rep']; ?></td>
                          <td><?= $activity['date']; ?></td>
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
