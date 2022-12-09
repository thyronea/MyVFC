<?php session_start();
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/VFC/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Activity</title>
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
                        <h4>Activity</h4>
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
                                        <label for="rep">Field Representative</label>
                                          <select class="form-select form-select-md mb-3" name="rep[]" required>
                                            <option value=""disabled selected>Select rep</option>
                                            <option value="Marcia Mangubat">Marcia Mangubat</option>
                                            <option value="Veronica Martinez">Veronica Martinez</option>
                                            <option value="Thyrone Antonio">Thyrone Antonio</option>
                                            <option value="Jerad Timmons">Jerad Timmons</option>
                                          </select>
                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-2">
                                          <label for="type">Activity Type</label>
                                            <select class="form-select form-select-md mb-3" name="type[]" id="activity" required>
                                              <option value=""disabled selected>Select activity</option>
                                              <option value="Compliance Visit">Compliance Visit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <label for="contact">Point of contact</label>
                                            <input type="text" name="contact[]" value="<?=$provider['coordinator']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <label for="date">Date of visit</label>
                                            <input type="date" name="date[]" class="form-control" required>
                                        </div>
                                    </div>
                                    <!-- will only show if "Compliance Visit" is selected-->
                                    <div class="col-md-2">
                                        <div class="form-group mb-3" id="next">
                                            <label for="next">Next CV</label>
                                            <input type="date" name="next[]" class="form-control">
                                        </div>
                                    </div>
                                    <!-- delete comment to enable "addmore" function button
                                    <div class="col-md-2">
                                        <div class="form-group mb-1">
                                            <a href="javascript:void(0)" class="add-more-form btn btn-outline-primary btn-sm">+</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <!-- Display added fields-->
                            <div class="paste-new-forms"></div>

                            <a href="provider-view.php?id=<?= $provider['pin']; ?>" class="btn btn-outline-danger btn-sm">Back</a>
                            <button type="submit" name="save_activity" class="btn btn-outline-primary btn-sm">Save</button>

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

<!-- delete comment to enable "add more" function
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
                          <div class="form-group mb-2">\
                              <select class="form-select form-select-md mb-3" name="rep[]" required>\
                                <option value=""disabled selected>Conducted by</option>\
                                <option value="Marcia Mangubat">Marcia Mangubat</option>\
                                <option value="Veronica Martinez">Veronica Martinez</option>\
                                <option value="Thyrone Antonio">Thyrone Antonio</option>\
                                <option value="Jerad Timmons">Jerad Timmons</option>\
                              </select>\
                          </div>\
                      </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-2">\
                                <select class="form-select form-select-md mb-3" name="type[]" required>\
                                  <option value=""disabled selected>Activity Type</option>\
                                  <option value="Compliance Visit">Compliance Visit</option>\
                                  <option value="Unannounced S&H">Unannounced S&H</option>\
                                  <option value="IQIP">IQIP</option>\
                                  <option value="Training/Education">Training & Education</option>\
                                </select>\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <input type="text" name="contact[]" value="<?=$provider['coordinator']; ?>" class="form-control" required>\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                            <div class="form-group mb-1">\
                                <input type="date" name="date[]" class="form-control" required>\
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
    </script> -->

    <!-- script for next visit field when "compliance visit" is selected -->
    <script>
    const source = document.querySelector("#activity");
    const target = document.querySelector("#next");

    const displayWhenSelected = (source, value, target) => {
      const selectedIndex = source.selectedIndex;
      const isSelected = source[selectedIndex].value === value;
      target.classList[isSelected
          ? "add"
          : "remove"
      ]("show");
    };
    source.addEventListener("change", (evt) =>
      displayWhenSelected(source, "Compliance Visit", target)
    );
    </script>

</body>
</html>
