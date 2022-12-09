<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>

  <body>
    <div class="container mt-5">
    <?php include('message.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body">

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

                <form action="code.php" method="post">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email:</label>
                    <input type="text" name="email" value="<?=$provider['email']; ?>" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subject:</label>
                    <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" value="VFC Compliance Visit - <?=$provider['pin']; ?> <?=$provider['name']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message:</label>
                    <div  name="message" class="form-control" id="box" rows="5">
Dear <?=$provider['coordinator']; ?>,<br><br>

This is a reminder that your office is due for a VFC compliance visit within the next 90 days. Please click <a href="/Scheduler/index.php">HERE</a> to schedule your next VFC Compliance visit. <br><br>

Thank you,<br>
Vaccines for Children Program
                    </div>
                    <a href="expiring-visit.php" class="btn btn-outline-success float-end mt-3" name="button">Back</a>
                    <button type="submit" class="btn btn-outline-primary mt-3" name="send_email">Send</button>
                  </div>

                </form>

                <?php
                    }
                  }
                ?>


          </div>
        </div>
      </div>
    </div>
  </div>


    <script type="text/javascript">document.getElementById("box").contentEditable='true'; </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>
</html>
