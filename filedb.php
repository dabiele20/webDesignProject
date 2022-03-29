


<?php
  $materia = 'Storia';
  $anno = '1';
  $tipo = '.docx';


  $mydir = 'Liceo/1° anno/Storia'; 
  
  $nomi_file_antologia_1anno = array_diff(scandir($mydir), array('.', '..')); 
  
  print_r($nomi_file_antologia_1anno); 

  // Create connection
  $conn = new mysqli('localhost', 'root', '', 'webdesignWebsite');

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
  echo "Connected successfully";

  $num = 20;
  // outputs e.g.  somefile.txt was last changed: December 29 2002 22:16:23.

  
  for($i = 2; $i<14; $i++) {
    $filename = 'Liceo/1° anno/Storia/';
    $filename .= $nomi_file_antologia_1anno[$i];

    if (file_exists($filename)) {
      echo $filename . "<br>";

      //echo "$filename was last modified: " . date ("d/m/Y.", filemtime($filename)) . '<br>';
      $datafile = date ("d/m/Y", filemtime($filename));

      $sql = "INSERT INTO File (idfile, Nome, DataCreazione, Materia, tipo, Anno, URL)
      VALUES (". $num . ", ' ". $nomi_file_antologia_1anno[$i] . "', str_TO_DATE('".
      $datafile . "', '%d/%m/%Y'), 'Storia', '.docx', 1, '" . $filename . "');";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      
    }else{
      echo 'ciao';
    }
    $num++;
  }

  $conn->close();
  



  

?>