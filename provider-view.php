<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provider Info</title>
    <link type="text/css" rel="stylesheet" href="/Scheduler/css/layout.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
              <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Provider</a>
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
                <li><a class="dropdown-item" href="expired-visit.php">Overdue</a></li>
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
        <h3>MyVFC-Provider</h3>
    </div>

    <div class="container mt-3">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <?php
            // Display Providers data
            if(isset($_GET['id']))
            {
              $provider_pin = mysqli_real_escape_string($con, $_GET['id']);
              $query1 = "SELECT * FROM Providers WHERE pin='$provider_pin' ";
              $query_run1 = mysqli_query($con, $query1);

              if(mysqli_num_rows($query_run1) > 0)
              {
                $provider = mysqli_fetch_array($query_run1);

                  foreach ($query_run1 as $providers)
                  {
            ?>
              <div class="card-header">
                <h4>
                  <a class="navbar-brand">
                    Provider Info
                  </a>
                </h4>
              </div>

              <div class="card-body">

                    <form action="code.php" method="post">
                      <div class="row row-cols-1 row-cols-md-2 g-4 mb-1">

                        <div class="col">
                          <div class="card">
                            <div class="card-header">
                              <div class="mb-1">
                                <b>VFC PIN:</b>
                               <?=$providers['pin']; ?>
                              </div>
                              <div class="mb-1">
                                <b>Name of Practice:</b>
                                <?=$providers['name']; ?>
                              </div>
                              <div class="mb-1">
                                <b>County:</b>
                                <?=$providers['county']; ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col">
                          <div class="card">
                            <div class="card-header">
                              <div class="mb-1">
                                <b>VFC Coordinator:</b>
                                <?=$providers['coordinator']; ?>
                              </div>
                              <div class="mb-1">
                                <b>Email:</b>
                                <a href=mailto:"<?=$providers['email']; ?>"><?=$providers['email']; ?></a>
                              </div>
                              <div class="mb-1">
                                <b>Phone</b>
                                <a href=tel:"<?=$providers['phone']; ?>"><?=$providers['phone']; ?></a>
                              </div>
                            </div>
                          </div>
                        </div>


                        <?php
                            }
                          }
                          else
                          {
                              echo "<h4>No VFC Pin Found</h4>";
                          }
                        }
                        ?>


                                        <div class="col-md-12">
                                              <div class="tablefixhead">
                                                <h5>Thermometers</h5>
                                                <table class="table table-bordered">
                                                  <thead>
                                                    <tr>
                                                      <th>Location</th>
                                                      <th>Brand/Model</th>
                                                      <th>Serial Number</th>
                                                      <th>Expiration Date</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php
                                                    // Display Providers data
                                                    if(isset($_GET['id']))
                                                    {
                                                      $thermometers_pin = mysqli_real_escape_string($con, $_GET['id']);
                                                      $query2 = "SELECT * FROM Thermometers WHERE pin='$thermometers_pin' ";
                                                      $query_run2 = mysqli_query($con, $query2);

                                                      if(mysqli_num_rows($query_run1) > 0)
                                                      {
                                                        $thermometer = mysqli_fetch_array($query_run2);

                                                          foreach ($query_run2 as $thermometers)
                                                          {
                                                    ?>
                                                    <tr>
                                                      <td><?=$thermometers['location']; ?></td>
                                                      <td><?=$thermometers['model']; ?></td>
                                                      <td><?=$thermometers['serial']; ?></td>
                                                      <td><?=$thermometers['exp']; ?></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                      }
                                                      else
                                                      {
                                                          echo "<h4>No Thermometers Found</h4>";
                                                      }
                                                    }
                                                    ?>
                                                  </tbody>
                                                </table>

                                              </div>
                                        </div>

                                        <div class="col-md-12">
                                              <div class="tablefixhead">
                                                <h5>Activities</h5>
                                                <table class="table table-bordered">
                                                  <thead>
                                                    <tr>
                                                      <th>Conducted By</th>
                                                      <th>Visit Type</th>
                                                      <th>Point of Contact</th>
                                                      <th>Date of Visit</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php
                                                    // Display Providers data
                                                    if(isset($_GET['id']))
                                                    {
                                                      $activity_pin = mysqli_real_escape_string($con, $_GET['id']);
                                                      $query2 = "SELECT * FROM Activities WHERE pin='$activity_pin' ";
                                                      $query_run2 = mysqli_query($con, $query2);

                                                      if(mysqli_num_rows($query_run1) > 0)
                                                      {
                                                        $activity = mysqli_fetch_array($query_run2);

                                                          foreach ($query_run2 as $activity)
                                                          {
                                                    ?>
                                                    <tr>
                                                      <td><?=$activity['rep']; ?></td>
                                                      <td><?=$activity['type']; ?></td>
                                                      <td><?=$activity['contact']; ?></td>
                                                      <td><?=$activity['date']; ?></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                      }
                                                      else
                                                      {
                                                          echo "<h4>No Thermometers Found</h4>";
                                                      }
                                                    }
                                                    ?>
                                                  </tbody>
                                                </table>

                                              </div>
                                        </div>


                              <div class="mt-1">
                                <a href="index.php" class="btn btn-outline-danger btn-sm">Back</a>
                                <a href="provider-edit.php?id=<?= $providers['pin']; ?>" class="btn btn-outline-primary btn-sm">Update</a>
                                <a href="add-thermometers.php?id=<?= $provider['pin']; ?>" class="btn btn-outline-success btn-sm">Add Thermometer</a>
                                <a href="add-activity.php?id=<?= $provider['pin']; ?>" class="btn btn-outline-success btn-sm">Add Activity</a>
                              </div>

                          </div>

                  </form>


              </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      // Disconnect
      mysqli_close($con);
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
