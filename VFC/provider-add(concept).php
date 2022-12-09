<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Provider</title>

  </head>

  <body>

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
                        <input type="text" name="pin[]" class="form-control" required>
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


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Thermometers</h4>
              </div>
              <div class="card-body">

                <div class="main-form mt-3">

                    <div class="row">
                      <div class="col-md-2">
                          <div class="form-group mb-3">
                            <select class="form-select form-select-md mb-2" name="location[]">
                              <option value=""disabled selected>Location</option>
                              <option value="Refrigerator">Refrigerator</option>
                              <option value="Freezer">Freezer</option>
                              <option value="Back-up">Back-up</option>
                            </select>
                          </div>
                      </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <input type="text" name="model[]" class="form-control" required placeholder="Enter Brand/Model">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <input type="text" name="serial[]" class="form-control" required placeholder="Enter Serial Number">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <input type="date" name="exp[]" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                          <a href="javascript:void(0)" class="add-more-form btn btn-outline-success btn-md">+</a>
                        </div>
                    </div>
                </div>

                <div class="paste-new-forms"></div>
                <div class="mt-3">
                  <a href="index.php" class="btn btn-outline-danger btn-sm" name="button">Back</a>
                  <button type="submit" class="btn btn-outline-success btn-sm" name="save_provider">Save</button>
                </div>

              </div>
            </div>
          </div>
        </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
      $(document).ready(function () {

          $(document).on('click', '.remove-btn', function () {
              $(this).closest('.main-form').remove();
          });

          $(document).on('click', '.add-more-form', function () {
              $('.paste-new-forms').append('<div class="main-form mb-2">\
                  <div class="row">\
                    <div class="col-md-2">\
                        <div class="form-group mb-2">\
                        <select class="form-select form-select-md mb-2" name="location[]">\
                          <option value="" disabled selected>Location</option>\
                          <option value="Refrigerator">Refrigerator</option>\
                          <option value="Freezer">Freezer</option>\
                          <option value="Back-up">Back-up</option>\
                        </select>\
                        </div>\
                    </div>\
                      <div class="col-md-3">\
                          <div class="form-group mb-2">\
                              <input type="text" name="model[]" class="form-control" required placeholder="Enter Brand/Model">\
                          </div>\
                      </div>\
                      <div class="col-md-3">\
                          <div class="form-group mb-2">\
                              <input type="text" name="serial[]" class="form-control" required placeholder="Enter Serial Number">\
                          </div>\
                      </div>\
                      <div class="col-md-2">\
                          <div class="form-group mb-2">\
                              <input type="date" name="exp[]" class="form-control" required>\
                          </div>\
                      </div>\
                                  <div class="col-md-2">\
                                      <div class="form-group mb-2">\
                                          <button type="button" class="remove-btn btn btn-outline-danger btn-md">-</button>\
                                      </div>\
                                  </div>\
                              </div>\
                          </div>');
          });

      });
  </script>

</body>
</html>
