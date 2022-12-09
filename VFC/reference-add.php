<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/Scheduler/css/layout.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Reference</title>

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
                <li><a class="dropdown-item" href="reference-guide.php">DDL Reference Guide</a></li>
                <li><a class="dropdown-item active" href="reference-add.php">Add Reference</a></li>
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

    <div class="container mt-5">
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="card">

              <div class="card-header">
                <h4>Thermometer Info</h4>
              </div>
              <div class="card-body">

                <form action="code.php" method="post">
                  <div class="row row-cols-1 row-cols-md-2 g-4 mb-1">

                    <div class="col">
                      <div class="form-group mb-2">
                      <div class="form-group mb-2">
                        <label>Vendor/Name/Model</label>
                        <input type="text" name="vendor" class="form-control" required>
                      </div>
                      <div class="form-group mb-2">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" required>
                      </div>
                      <div class="form-group mb-2">
                        <label for="requirements">Recommend to Providers?</label><br>
                          <label for="requirements">Yes</label>
                          <input type="radio" name="requirements" value="Yes">
                          <label for="requirements">No</label>
                          <input type="radio" name="requirements" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="summary">Generates Summary Report?</label><br>
                          <label for="summary">Yes</label>
                          <input type="radio" name="summary" value="Yes">
                          <label for="summary">No</label>
                          <input type="radio" name="summary" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="probe">Temperature Probe Included?</label><br>
                          <label for="probe">Yes</label>
                          <input type="radio" name="probe" value="Yes">
                          <label for="probe">No</label>
                          <input type="radio" name="probe" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="display">Active Temperature Display?</label><br>
                          <label for="display">Yes</label>
                          <input type="radio" name="display" value="Yes">
                          <label for="display">No</label>
                          <input type="radio" name="display" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="reset">Reset Button?</label><br>
                          <label for="reset">Yes</label>
                          <input type="radio" name="reset" value="Yes">
                          <label for="reset">No</label>
                          <input type="radio" name="reset" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="battery">Low Battery Indicator?</label><br>
                          <label for="battery">Yes</label>
                          <input type="radio" name="battery" value="Yes">
                          <label for="battery">No</label>
                          <input type="radio" name="battery" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="ref_acc">Accuracy of +/- 1° for Refrigerator?</label><br>
                          <label for="battery">Yes</label>
                          <input type="radio" name="ref_acc" value="Yes">
                          <label for="ref_acc">No</label>
                          <input type="radio" name="ref_acc" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="frz_acc">Accuracy of +/- 1° for Freezer?</label><br>
                          <label for="battery">Yes</label>
                          <input type="radio" name="frz_acc" value="Yes">
                          <label for="ref_acc">No</label>
                          <input type="radio" name="frz_acc" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="memory">Memory Storage?</label><br>
                          <label for="memory">Yes</label>
                          <input type="radio" name="memory" value="Yes">
                          <label for="memory">No</label>
                          <input type="radio" name="memory" value="No">
                      </div>
                      <div class="form-group mb-2">
                        <label for="alarm">Program Alarm Settings?</label><br>
                          <label for="alarm">Yes</label>
                          <input type="radio" name="alarm" value="Yes">
                          <label for="alarm">No</label>
                          <input type="radio" name="alarm" value="No">
                      </div>
                      <div class="form-group mb-1">
                        <label>Memo</label>
                        <input type="textbox" name="notes" class="form-control" required>
                      </div>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <div class="mt-3">
          <a href="reference-guide.php" class="btn btn-outline-danger btn-sm" name="button">Back</a>
          <button type="submit" class="btn btn-outline-success btn-sm" name="save_reference" onclick="buildUrl();">Save</button>
        </div>

    </form>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
