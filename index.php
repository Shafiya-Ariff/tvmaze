<!DOCTYPE HTML>


<html>
    <head>
        
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Spectral">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <title>TvMaze</title>
        <style>
            body{
                background-color: black;
                background-attachment:fixed;
                background-size: cover;
            }
            h1{
                font-family: Spectral,sans-serif;
                font-weight:bold;
                margin-top:10px;
                color:white;
            }
        </style>
        
    </head>
    
    <body>

<?php

date_default_timezone_set("America/New_York");

$url = "http://api.tvmaze.com/schedule?country=US&date=". date("Y-m-d");

$data = file_get_contents($url);

$dataArray = json_decode($data,TRUE);

echo "<h1 style='text-align:center'>Recent Shows</h1>";

for($i=0 ; $i < count($dataArray) ; $i++){
    
    $img= $dataArray[$i]['show']['image']['original'];
    $image=base64_encode(file_get_contents($img));
    $date = $dataArray[$i]['airdate'];
    $time = $dataArray[$i]['airtime'];
    $content = $dataArray[$i]['show']['summary'];
    $id=$i;
    
    echo "<div class='container'>";
     echo "<div class='card mb-3' style='max-width:1000px; '>";
      echo "<div class='row no-gutters'>";
       echo "<div class='col-md-4'>";
      echo "<img src='data:image/jpg;base64,$image' class='card-img'>";
    echo "</div>";
    echo "<div class='col-md-8'>";
      echo "<div class='card-body'>";
        echo "<h5 class='card-title'>$date <span class='badge badge-success'>$time</span></h5>";
        echo "<p class='card-text'><i>$content</i></p>";
        echo " <p class='card-text'><small class='text-muted'><a href='show.php?id=$id' class='btn btn-info'>Click here</a></small></p>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
echo "</div>";
    echo "</div>";
}
        ?>

        </body>
            </html>
