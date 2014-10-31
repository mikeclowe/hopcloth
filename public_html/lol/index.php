<?php
  header('Content-type: text/plain');

  // create curl resource
  $ch = curl_init();

  // set url
  curl_setopt($ch, CURLOPT_URL, "https://na.api.pvp.net/api/lol/na/v2.2/match/1546456773?includeTimeline=1&api_key=62150982-7cbb-42bb-b9ef-6bcade71caf5");

  //return the transfer as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // $output contains the output string
  $output = curl_exec($ch);

  // close curl resource to free up system resources
  curl_close($ch);   
        
  $data = json_decode($output);
  $data->participants = null;

  $timeline = $data->participants[0]->timeline;
		
  print_r($data);
  

 
?>


