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
    <title>Add Provider</title>

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

          </ul>

        </div>
      </div>
    </nav>

    <div class="header">
      <h3>MyVFC-Provider</h3>
    </div>

    <div class="container mt-5">
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="card">

              <div class="card-header">
                <h4>Provider Info</h4>
              </div>
              <div class="card-body">

                <form action="code.php" method="post">
                  <div class="row row-cols-1 row-cols-md-2 g-4 mb-1">

                    <div class="col">
                      <div class="mb-1">
                        <label>VFC PIN</label>
                        <input type="text" name="pin" class="form-control" required>
                      </div>
                      <div class="mb-1">
                        <label>Name of Practice</label>
                        <input type="text" name="name" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>County</label>
                        <input type="text" name="county" class="form-control" required>
                      </div>
                    </div>

                    <div class="col">
                          <div class="mb-1">
                            <label>VFC Coordinator</label>
                            <input type="text" name="coordinator" class="form-control" required>
                          </div>
                          <div class="mb-1">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" required>
                          </div>
                          <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                          </div>
                    </div>

            </div>
          </div>
        </div>
      </div>
    </div>

        <div class="mt-3">
          <a href="index.php" class="btn btn-outline-danger btn-sm" name="button">Back</a>
          <button type="submit" class="btn btn-outline-success btn-sm" name="save_provider">Save</button>
        </div>

    </form>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
