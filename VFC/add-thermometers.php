<?php session_start();
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Thermometers</title>
  </head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-4">
                  <?php
                  // Display Provider info
                  if(isset($_GET['id']))
                  {
                    $provider_pin = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM Providers WHERE pin='$provider_pin' ";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                      $provider = mysqli_fetch_array($query_run);

                  ?>
                    <div class="card-header">
                        <h4>Thermometers</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">

                            <div class="main-form mt-1">
                                <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group mb-1">
                                          <input type="text" name="pin[]" value="<?=$provider['pin']; ?>" class="form-control" Hidden>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group mb-1">
                                          <input type="text" name="name[]" value="<?=$provider['name']; ?>" class="form-control" Hidden>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group mb-1">
                                          <input type="text" name="county[]" value="<?=$provider['county']; ?>" class="form-control" Hidden>
                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-2">
                                            <select class="form-select form-select-md mb-3" name="location[]" required>
                                              <option value=""disabled selected>Location</option>
                                              <option value="Refrigerator">Refrigerator</option>
                                              <option value="Freezer">Freezer</option>
                                              <option value="Back-up">Back-up</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-1">
                                            <input type="text" name="model[]" class="form-control" required placeholder="Enter Brand/Model">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <input type="text" name="serial[]" class="form-control" required placeholder="Enter Serial Number">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <input type="date" name="exp[]" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <a href="javascript:void(0)" class="add-more-form btn btn-outline-primary btn-sm">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>
                            <a href="provider-edit.php?id=<?= $provider['pin']; ?>" class="btn btn-outline-danger btn-sm">Back</a>
                            <button type="submit" name="save_multiple_data" class="btn btn-outline-primary btn-sm">Save Thermometers</button>
                        </form>
                        <?php
                          }
                          else
                          {
                              echo "<h4>No VFC Pin Found</h4>";
                          }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });

            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-1">\
                    <div class="row">\
                      <div class="col-md-3">\
                          <div class="form-group mb-1">\
                              <input type="text" name="pin[]" value="<?=$provider['pin']; ?>" class="form-control" Hidden>\
                          </div>\
                      </div>\
                      <div class="col-md-4">\
                          <div class="form-group mb-1">\
                              <input type="text" name="name[]" value="<?=$provider['name']; ?>" class="form-control" Hidden>\
                          </div>\
                      </div>\
                      <div class="col-md-4">\
                          <div class="form-group mb-1">\
                              <input type="text" name="county[]" value="<?=$provider['county']; ?>" class="form-control" Hidden>\
                          </div>\
                      </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <select class="form-select form-select-md mb-3" name="location[]" required>\
                                  <option value=""disabled selected>Location</option>\
                                  <option value="Refrigerator">Refrigerator</option>\
                                  <option value="Freezer">Freezer</option>\
                                  <option value="Back-up">Back-up</option>\
                                </select>\
                            </div>\
                        </div>\
                        <div class="col-md-3">\
                            <div class="form-group mb-1">\
                                <input type="text" name="model[]" class="form-control" required placeholder="Enter Brand/Model">\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <input type="text" name="serial[]" class="form-control" required placeholder="Enter Serial Number">\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <input type="date" name="exp[]" class="form-control" required>\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <button type="button" class="remove-btn btn btn-outline-danger btn-sm">-</button>\
                            </div>\
                        </div>\
                    </div>\
                </div>');
            });

        });
    </script>

</body>
</html>
