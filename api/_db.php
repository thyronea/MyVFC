<?php

$db_exists = file_exists("daypilot.sqlite");

$db = new PDO('sqlite:daypilot.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS events (
                        id INTEGER PRIMARY KEY, 
                        name TEXT, 
                        start DATETIME, 
                        end DATETIME)");

    $messages = array(
                    array('name' => 'Event 1',
                        'start' => '20121-05-09T00:00:00',
                        'end' => '2021-05-09T10:00:00')
                );

    $insert = "INSERT INTO events (name, start, end) VALUES (:name, :start, :end)";
    $stmt = $db->prepare($insert);
 
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':start', $start);
    $stmt->bindParam(':end', $end);

    foreach ($messages as $m) {
      $name = $m['name'];
      $start = $m['start'];
      $end = $m['end'];
      $stmt->execute();
    }
    
}
