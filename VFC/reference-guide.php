<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DDL Reference Guide</title>
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
                <li><a class="dropdown-item" href="expiring-thermometers.php">Expiring Thermometers</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item active" href="reference-guide.php">DDL Reference Guide</a></li>
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

          </ul>

          <form class="d-flex" role="search" method="get">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" >
            <button class="btn btn-outline-success" type="submit" name="button">Search</button>
          </form>

        </div>
      </div>
    </nav>

      <div class="header">
          <h3>MyVFC-DDL Reference Guide</h3>
      </div>

      <?php
      include('message.php');
      ?>

      <div class="container">
        <div class="row">
         <div class="">
          <div class="col-md-12">
            <div class="mt-4">
              <div class="tablefixhead">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Vendor/Name/Model</th>
                    <th>Recommend to Providers?</th>
                    <th>Generates Summary Report</th>
                    <th>Probe Included</th>
                    <th>Temperature Display</th>
                    <th>Reset Button</th>
                    <th>Low Battery Indicator</th>
                    <th>Accuracy of +/- 1° for Refrigerator</th>
                    <th>Accuracy of +/- 1° for Freezer</th>
                    <th>Memory Storage</th>
                    <th>Program Alarm Settings</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    require 'dbcon.php';

                    if(isset($_GET['search']))
                    {
                      $filtervalues = $_GET['search'];
                      $query = "SELECT * FROM Reference WHERE CONCAT(vendor) LIKE '%$filtervalues%' ";
                      $query_run = mysqli_query($con, $query);

                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach ($query_run as $reference)
                        {
                          ?>
                          <tr>
                            <td >
                            <a href="<?= $reference['link']; ?>" target="_blank"><?= $reference['vendor']; ?></a><br><br>
                            <a href="reference-edit.php?id=<?= $reference['vendor']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                    data-bs-toggle="popover" data-bs-placement="right"
                                    data-bs-custom-class="custom-popover"
                                    data-bs-content="<?= $reference['notes']; ?>">
                              Memo
                            </button>
                            </td>
                            <td><?= $reference['requirements']; ?></td>
                            <td><?= $reference['summary']; ?></td>
                            <td><?= $reference['probe']; ?></td>
                            <td><?= $reference['display']; ?></td>
                            <td><?= $reference['reset']; ?></td>
                            <td><?= $reference['battery']; ?></td>
                            <td><?= $reference['ref_acc']; ?></td>
                            <td><?= $reference['frz_acc']; ?></td>
                            <td><?= $reference['memory']; ?></td>
                            <td><?= $reference['alarm']; ?></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript">
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
      const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
  </body>

</html>
