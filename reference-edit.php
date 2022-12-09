<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit DDL Reference</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>

  <body>

    <div class="container mt-3">

    <?php include('message.php'); ?>

      <div class="row">
        <div class="col-md-12">
          <div class="">
            <?php
            // Display Provider info
            if(isset($_GET['id']))
            {
              $reference_vendor = mysqli_real_escape_string($con, $_GET['id']);
              $query1 = "SELECT * FROM Reference WHERE vendor='$reference_vendor' ";
              $query_run1 = mysqli_query($con, $query1);

              if(mysqli_num_rows($query_run1) > 0)
              {
                $reference = mysqli_fetch_array($query_run1);

            ?>
              <div class="card-header">
                <form action="code.php" method="post">
                <h4>Edit DDL Reference</h4>
                </form>
              </div>
              <div class="card-body">

                    <form action="code.php" method="post">
                    <div class="row row-cols-1 row-cols-md-10 g-4 mb-3">

                      <div class="col">
                        <div class="card">
                          <div class="card-header">
                            <div class="mb-2">
                              <label>Vendor/Name/Model</label>
                                <input type="text" name="vendor" value="<?=$reference['vendor']; ?>" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                              <label>Link</label>
                                <input type="text" name="link" value="<?=$reference['link']; ?>" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                              <label for="requirements">Meets Requirements?</label><br>
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
                              <textarea name="notes" class="form-control" value="<?=$reference['notes']; ?>" required><?=$reference['notes']; ?></textarea>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>

                      <?php
                        }
                        else
                        {
                            echo "<h4>No DDL Reference Found</h4>";
                        }
                      }
                      ?>

                                      </tbody>
                                    </table>

                                  </div>
                            </div>

                            <div class="mb-1">
                              <a href="reference-guide.php" class="btn btn-outline-danger btn-sm">Back</a>
                                <form action="code.php" method="post" id="saveButton">
                                <button href="provider-view.php?id=<?= $provider['pin']; ?>" onclick="document.getElementId('saveButton').submit()" class="btn btn-outline-primary btn-sm" name="update_reference">Save</button>
                                <button type="submit" name="delete_reference" onclick="return confirm('Are you sure you want to delete this item?')" value="<?=$reference['vendor']; ?>" class="btn btn-outline-danger btn-sm">Delete</button>
                              </form>
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
