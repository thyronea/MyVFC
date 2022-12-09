<?php
session_start();
require 'dbcon.php';

// Delete provider
if(isset($_POST['delete_provider']))
{
  $provider_pin = mysqli_real_escape_string($con, $_POST['delete_provider']);
  $query = "DELETE FROM Providers WHERE pin='$provider_pin' ";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
      $_SESSION['message'] = "Provider Deleted Successfully";
      header("Location: index.php");
      exit(0);
  }
  else
  {
    $_SESSION['message'] = "Unable to Delete Provider";
    header("Location: index.php");
    exit(0);
  }
}

// Delete thermometers
if(isset($_POST['delete_provider']))
{
  $provider_pin = mysqli_real_escape_string($con, $_POST['delete_provider']);
  $query = "DELETE FROM Thermometers WHERE pin='$provider_pin' ";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
      $_SESSION['message'] = "Provider Deleted Successfully";
      header("Location: index.php");
      exit(0);
  }
  else
  {
    $_SESSION['message'] = "Unable to Delete Provider";
    header("Location: index.php");
    exit(0);
  }
}

// Delete selected thermometer
if(isset($_POST['delete_reference']))
{
  $reference_vendor = mysqli_real_escape_string($con, $_POST['delete_reference']);
  $query = "DELETE FROM Reference WHERE vendor='$reference_vendor' ";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
      $_SESSION['message'] = "DDL Reference Deleted Successfully";
      header("Location: reference-guide.php?search=&button=");
      exit(0);
  }
  else
  {
    $_SESSION['message'] = "Unable to Delete DDL Reference";
    header("Location: reference-guide.php?search=&button=");
    exit(0);
  }
}

// Delete selected DDL reference
if(isset($_POST['delete_thermometer']))
{
  $provider_pin = mysqli_real_escape_string($con, $_POST['delete_thermometer']);
  $query = "DELETE FROM Thermometers WHERE serial='$provider_pin' ";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
      $_SESSION['message'] = "Provider Deleted Successfully";
      header("Location: index.php?search=&button=");
      exit(0);
  }
  else
  {
    $_SESSION['message'] = "Unable to Delete Provider";
    header("Location: index.php?search=&button=");
    exit(0);
  }
}

// Delete selected activity
if(isset($_POST['delete_activity']))
{
  $provider_pin = mysqli_real_escape_string($con, $_POST['delete_activity']);
  $query = "DELETE FROM Activities WHERE ID='$provider_pin' ";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
      $_SESSION['message'] = "Provider Deleted Successfully";
      header("Location: index.php?search=&button=");
      exit(0);
  }
  else
  {
    $_SESSION['message'] = "Unable to Delete Provider";
    header("Location: index.php?search=&button=");
    exit(0);
  }
}

// Update provider info
if(isset($_POST['update_provider']))
{
  // Provider info
  $provider_pin = mysqli_real_escape_string($con, $_POST['pin']); // Secured version of $pin
  $pin = $_POST['pin'];
  $name = $_POST['name'];
  $county = $_POST['county'];
  $coordinator = $_POST['coordinator'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $query1 = "UPDATE Providers SET pin='$pin', name='$name', county='$county', coordinator='$coordinator', email='$email', phone='$phone'
  WHERE pin='$provider_pin' ";

  $query2 = "UPDATE Thermometers SET pin='$pin', name='$name', county='$county'
  WHERE pin='$provider_pin' ";

  $query_run1 = mysqli_query($con, $query1);

  if ($query_run1)
  {
    $_SESSION['message'] = "VFC Provider Updated Successfully";
    header("Location: index.php");
    exit(0);
  }
  else
  {
    $_SESSION['message'] = "VFC Provider Not Updated";
    header("Location: index.php");
    exit(0);
  }

  $query_run2 = mysqli_query($con, $query2);

  if ($query_run2)
  {
    $_SESSION['message'] = "VFC Provider Updated Successfully";
    header("Location: index.php");
    exit(0);
  }
  else
  {
    $_SESSION['message'] = "VFC Provider Not Updated";
    header("Location: index.php");
    exit(0);
  }
}

// Update thermometers
if(isset($_POST['update_provider']))
{
  $location = $_POST['location'];
  $model = $_POST['model'];
  $serial = $_POST['serial'];
  $exp = $_POST['exp'];

  foreach($pin as $index => $pins)
  {
      $s_pin = $pins;
      $s_location = $location[$index];
      $s_model = $model[$index];
      $s_serial = $serial[$index];
      $s_exp = $exp[$index];

      $query2 = "UPDATE Thermometers SET pin='$s_pin', location='$s_location', model='$s_model', serial='$s_serial', exp='$s_exp'
      WHERE pin='$s_pin' ";
      $query_run2 = mysqli_query($con, $query2);
  }

  if($query_run2)
  {
      $_SESSION['message'] = "Multiple Data Inserted Successfully";
      header("Location: index.php?search=&button=");
      exit(0);
  }
  else
  {
      $_SESSION['message'] = "Data Not Inserted";
      header("Location: index.php?search=&button=");
      exit(0);
  }
}

// Update DDL reference
if(isset($_POST['update_reference']))
{
  $vendor = $_POST['vendor'];
  $link = $_POST['link'];
  $requirements = $_POST['requirements'];
  $summary = $_POST['summary'];
  $probe = $_POST['probe'];
  $display = $_POST['display'];
  $reset = $_POST['reset'];
  $battery = $_POST['battery'];
  $ref_acc = $_POST['ref_acc'];
  $frz_acc = $_POST['frz_acc'];
  $memory = $_POST['memory'];
  $alarm = $_POST['alarm'];
  $notes = $_POST['notes'];

  $query1 = "UPDATE Reference SET vendor='$vendor', link='$link', requirements='$requirements', summary='$summary',
  probe='$probe', display='$display', reset='$reset', battery='$battery', ref_acc='$ref_acc', frz_acc='$frz_acc', memory='$memory', alarm='$alarm', notes='$notes'
  WHERE vendor='$vendor' ";

  $query_run1 = mysqli_query($con, $query1);

  if ($query_run1)
  {
    $_SESSION['message'] = "VFC Provider Updated Successfully";
    header("Location: reference-guide.php");
    exit(0);
  }
  else
  {
    $_SESSION['message'] = "VFC Provider Not Updated";
    header("Location: reference-guide.php");
    exit(0);
  }
}


// Add new provider
if(isset($_POST['save_provider']))
{
  // Provider info
  $pin = $_POST['pin'];
  $name = $_POST['name'];
  $county = $_POST['county'];
  $coordinator = $_POST['coordinator'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $query1 = "INSERT INTO Providers (pin, name, county, coordinator, email, phone)
  VALUES ('$pin', '$name', '$county', '$coordinator', '$email', '$phone')";
  $query_run1 = mysqli_query($con, $query1);

  if($query_run1) {
    $_SESSION['message'] = "VFC Provider Added Successfully";
    header("Location: index.php?search=&button=");
    exit(0);
  }
  else {
    $_SESSION['message'] = "VFC Provider Not Added";
    header("Location: index.php?search=&button=");
    exit(0);
  }
}

// Add new IZB contact
if(isset($_POST['add_izb']))
{
  // contact info
  $name = $_POST['name'];
  $section = $_POST['section'];
  $title = $_POST['title'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $linkedin = $_POST['linkedin'];

  $query1 = "INSERT INTO Branch (name, section, title, email, phone, linkedin)
  VALUES ('$name', '$section', '$title', '$email', '$phone', '$linkedin')";
  $query_run1 = mysqli_query($con, $query1);

  if($query_run1) {
    $_SESSION['message'] = "IZ Branch contact Added Successfully";
    header("Location: izb-contact.php?search=&button=");
    exit(0);
  }
  else {
    $_SESSION['message'] = "IZ Branch contact Not Added";
    header("Location: izb-contact.php?search=&button=");
    exit(0);
  }
}

// Add thermometers
if(isset($_POST['save_multiple_data']))
{
    $pin = $_POST['pin'];
    $name = $_POST['name'];
    $county = $_POST['county'];
    $location = $_POST['location'];
    $model = $_POST['model'];
    $serial = $_POST['serial'];
    $exp = $_POST['exp'];

    foreach($pin as $index => $pins)
    {
        $s_pin = $pins;
        $s_name = $name[$index];
        $s_county = $county[$index];
        $s_location = $location[$index];
        $s_model = $model[$index];
        $s_serial = $serial[$index];
        $s_exp = $exp[$index];

        $query = "INSERT INTO Thermometers (pin,name,county,location,model,serial,exp)
        VALUES ('$s_pin', '$s_name', '$s_county','$s_location', '$s_model', '$s_serial', '$s_exp')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['message'] = "DDL Thermometer Added Successfully";
        header("Location: index.php?search=&button=");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Inserted";
        header("Location: index.php?search=&button=");
        exit(0);
    }
}

// Add DDL reference
if(isset($_POST['save_reference']))
{
    $vendor = $_POST['vendor'];
    $link = $_POST['link'];
    $requirements = $_POST['requirements'];
    $summary = $_POST['summary'];
    $probe = $_POST['probe'];
    $display = $_POST['display'];
    $reset = $_POST['reset'];
    $battery = $_POST['battery'];
    $ref_acc = $_POST['ref_acc'];
    $frz_acc = $_POST['frz_acc'];
    $memory = $_POST['memory'];
    $alarm = $_POST['alarm'];
    $notes = $_POST['notes'];

    $query1 = "INSERT INTO Reference (vendor, link, requirements, summary, probe, display, reset, battery, ref_acc, frz_acc, memory, alarm, notes)
    VALUES ('$vendor', '$link', '$requirements', '$summary', '$probe', '$display', '$reset', '$battery', '$ref_acc', '$frz_acc', '$memory', '$alarm', '$notes')";
    $query_run1 = mysqli_query($con, $query1);

    if($query_run1) {
      $_SESSION['message'] = "DDL Reference Added Successfully";
      header("Location: reference-guide.php?search=&button=");
      exit(0);
    }
    else {
      $_SESSION['message'] = "DDL Reference Not Added";
      header("Location: reference-guide.php?search=&button=");
      exit(0);
    }
  }

// Add activity
if(isset($_POST['save_activity']))
{
    $pin = $_POST['pin'];
    $name = $_POST['name'];
    $county = $_POST['county'];
    $rep = $_POST['rep'];
    $type = $_POST['type'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $next = $_POST['next'];

    foreach($pin as $index => $pins)
    {
        $s_pin = $pins;
        $s_name = $name[$index];
        $s_county = $county[$index];
        $s_rep = $rep[$index];
        $s_type = $type[$index];
        $s_contact = $contact[$index];
        $s_date = $date[$index];
        $s_next = $next[$index];

        $query = "INSERT INTO Activities (pin,name,county,rep,type,contact,date,next)
        VALUES ('$s_pin', '$s_name', '$s_county','$s_rep', '$s_type', '$s_contact', '$s_date', '$s_next')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['message'] = "Multiple Data Inserted Successfully";
        header("Location: index.php?search=&button=");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Inserted";
        header("Location: index.php?search=&button=");
        exit(0);
    }
}


?>
