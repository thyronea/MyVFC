<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Provider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>

  <body>
    <div class="container mt-5">
    <?php include('message.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h4>Provider Info
                  <a href="index.php" class="btn btn-outline-success btn-sm float-end" name="button">Back</a>
                </h4>
              </div>
              <div class="card-body">

                <form action="code.php" method="post">
                  <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">

                    <div class="col">
                      <div class="card">
                        <div class="card-header">
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
                      </div>
                    </div>

                    <div class="col">
                      <div class="card">
                        <div class="card-header">
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

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <h5>Primary Thermometer</h5>

                            <select name="type1" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                              <option selected></option>
                              <option value="Refrigerator">Refrigerator</option>
                              <option value="Frfeezer">Freezer</option>
                            </select>

                            <div class="mb-1">
                              <label>Model</label>
                              <input type="text" name="ref_model" class="form-control" required>
                            </div>
                            <div class="mb-1">
                              <label>Serial Number</label>
                              <input type="text" name="ref_serial" class="form-control" required>
                            </div>
                            <div class="mb-3">
                              <label>Expiration Date</label>
                              <input type="date" name="ref_exp" class="form-control" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <h5>Primary Thermometer</h5>

                            <select name="type2" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                              <option selected></option>
                              <option value="Refrigerator">Refrigerator</option>
                              <option value="Freezer">Freezer</option>
                            </select>

                            <div class="mb-1">
                              <label>Model</label>
                              <input type="text" name="frz_model" class="form-control" required>
                            </div>
                            <div class="mb-1">
                              <label>Serial Number</label>
                              <input type="text" name="frz_serial" class="form-control" required>
                            </div>
                            <div class="mb-3">
                              <label>Expiration Date</label>
                              <input type="date" name="frz_exp" class="form-control" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <h5>Additional Thermometer</h5>

                            <select name="type3" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                              <option selected></option>
                              <option value="Refrigerator">Refrigerator</option>
                              <option value="Freezer">Freezer</option>
                              <option value="Back-up">Back-up</option>
                            </select>

                            <div class="mb-1">
                              <label>Model</label>
                              <input type="text" name="bu1_model" class="form-control" required>
                            </div>
                            <div class="mb-1">
                              <label>Serial Number</label>
                              <input type="text" name="bu1_serial" class="form-control" required>
                            </div>
                            <div class="mb-3">
                              <label>Expiration Date</label>
                              <input type="date" name="bu1_exp" class="form-control" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <h5>Additional Thermometer</h5>

                            <select name="type4" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                              <option selected></option>
                              <option value="Refrigerator">Refrigerator</option>
                              <option value="Freezer">Freezer</option>
                              <option value="Back-up">Back-up</option>
                            </select>

                            <div class="mb-1">
                              <label>Model</label>
                              <input type="text" name="bu2_model" class="form-control" >
                            </div>
                            <div class="mb-1">
                              <label>Serial Number</label>
                              <input type="text" name="bu2_serial" class="form-control" >
                            </div>
                            <div class="mb-3">
                              <label>Expiration Date</label>
                              <input type="date" name="bu2_exp" class="form-control" >
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>

                  <div class="mb-3">
                      <button type="submit" class="btn btn-outline-primary btn-sm" name="save_provider">Add</button>
                  </div>

                </form>

          </div>
        </div>
      </div>
    </div>
  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>
</html>
