<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provider Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>

  <body>
    

    <div class="container mt-3">

    <?php include('message.php'); ?>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <?php
            // Display Provider info
            if(isset($_GET['id']))
            {
              $provider_pin = mysqli_real_escape_string($con, $_GET['id']);
              $query1 = "SELECT * FROM Providers WHERE pin='$provider_pin' ";
              $query_run1 = mysqli_query($con, $query1);

              if(mysqli_num_rows($query_run1) > 0)
              {
                $provider = mysqli_fetch_array($query_run1);

            ?>
              <div class="card-header">
                <form action="code.php" method="post">
                <h4>Update VFC Provider
                    <button type="submit" name="delete_provider" onclick="return confirm('Are you sure you want to delete this item?')" value="<?=$provider['pin']; ?>" class="btn btn-outline-danger btn-sm float-end">Delete Profile</button>
                </h4>
                </form>
              </div>
              <div class="card-body">

                    <form action="code.php" method="post">
                    <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <div class="mb-1">
                              <label>VFC PIN</label>
                                <input type="text" name="pin" value="<?=$provider['pin']; ?>" class="form-control">
                            </div>
                            <div class="mb-1">
                              <label>Name of Practice</label>
                                <input type="text" name="name" value="<?=$provider['name']; ?>" class="form-control">
                            </div>
                            <div class="mb-1">
                              <label>County</label>
                                <input type="text" name="county" value="<?=$provider['county']; ?>" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <div class="mb-1">
                              <label>VFC Coordinator</label>
                              <input type="text" name="coordinator" value="<?=$provider['coordinator']; ?>" class="form-control">
                            </div>
                            <div class="mb-1">
                              <label>Email</label>
                              <input type="text" name="email" value="<?=$provider['email']; ?>" class="form-control">
                            </div>
                            <div class="mb-1">
                              <label>Phone</label>
                              <input type="text" name="phone" value="<?=$provider['phone']; ?>" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
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
                                    <th>Action</th>
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
                                    <td><button type="submit" name="delete_thermometer" onclick="return confirm('Are you sure you want to delete this item?')" value="<?=$thermometers['serial']; ?>" class="btn btn-outline-danger btn-sm">Delete</button></td>
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
                                    <th>Action</th>
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
                                    <td><button type="submit" name="delete_activity" onclick="return confirm('Are you sure you want to delete this item?')" value="<?=$activity['ID']; ?>" class="btn btn-outline-danger btn-sm">Delete</button></td>
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


                          <!--  <div class="col-md-12">
                                  <div class="tablefixhead">
                                    <h5>Thermometers</h5>
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Location</th>
                                          <th>Brand/Model</th>
                                          <th>Serial Number</th>
                                          <th>Expiration Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    <(insert ?)php
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
                                          <td><select class="form-select form-select-md mb-3" name="location" selected>
                                              <option value="<?=$thermometers['location']; ?>"><?=$thermometers['location']; ?></option>
                                              <option value="Refrigerator">Refrigerator</option>
                                              <option value="Freezer">Freezer</option>
                                              <option value="Back-up">Back-up</option>
                                            </select></td>
                                          <td><input type="text" name="model" value="<?=$thermometers['model']; ?>" class="form-control" required placeholder="Enter Brand/Model"></td>
                                          <td><input type="text" name="serial" value="<?=$thermometers['serial']; ?>" class="form-control" required placeholder="Enter Brand/Model"></td>
                                          <td><input type="date" name="exp" value="<?=$thermometers['exp']; ?>" class="form-control" required placeholder="Enter Brand/Model"></td>
                                          <td>
                                            <button type="submit" name="delete_thermometer" onclick="return confirm('Are you sure you want to delete this item?')" value="<?=$thermometers['serial']; ?>" class="btn btn-outline-danger btn-sm">Delete</button>
                                          </td>
                                        </tr>
                                        <(insert ?)php
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
                            </div> -->

                            <div class="mb-1">
                              <a href="provider-view.php?id=<?= $provider['pin']; ?>" class="btn btn-outline-danger btn-sm">Back</a>
                                <form action="code.php" method="post" id="saveButton">
                                <button href="provider-view.php?id=<?= $provider['pin']; ?>" onclick="document.getElementId('saveButton').submit()" class="btn btn-outline-primary btn-sm" name="update_provider">Save</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
