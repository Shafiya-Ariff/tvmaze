<!DOCTYPE HTML>
<?php

$id = $_GET['id'];

?>


<html>
    <head>
        
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>TvMaze</title>
        <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Spectral">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            #name{
                margin-bottom:10px;
                font-family: Spectral,sans-serif;
                font-size:20px;
            }
            
            #image{
                width:350px;
                height:450px;
            }
            
            .badge{
                margin-right:5px;
                padding:5px;
            }
            
            #span{
                margin-left:5px;
            }
            
            H1{
                font-family: Spectral,sans-serif;
                font-weight:bold;
                margin-top:10px;
                color:white;
            }
            
            body{
                background-color: black;
                background-attachment:fixed;
                background-size: cover;
            }
            
            #button{
                margin-right:10px;
            }
            
            .btn-group{
                margin-bottom:15px;
            }
            
            .card-title{
                text-decoration:underline;
            }
            
            
        </style>
    </head>

<body>
<?php

    $url = "http://api.tvmaze.com/schedule?country=US&date=". date("Y-m-d");

    $data = file_get_contents($url);

    $dataArray = json_decode($data,TRUE);

    $name = $dataArray[$id][name];
    
    $img= $dataArray[$id]['show']['image']['original'];
    $image=base64_encode(file_get_contents($img));
    
    $summary= $dataArray[$id]['summary'];
    $season= $dataArray[$id]['season'];
    $epnumber= $dataArray[$id]['number'];
    $duration= $dataArray[$id]['runtime'];
    $type= $dataArray[$id]['show']['type'];
    $language= $dataArray[$id]['show']['language'];
    
    $count = count($dataArray[$id]['show']['genres']);
    
    for($x=0; $x<$count ; $x++){
        $genres[$x] = $dataArray[$id]['show']['genres'][$x];
    }
    
    $rating= $dataArray[$id]['show']['rating']['average'];
    
    $content =$dataArray[$id]['show']['summary'];
    
    $site =$dataArray[$id]['show']['officialSite'];
    
    $url =$dataArray[$id]['show']['url'];
    
    $preEp =$dataArray[$id]['show']['_links']['previousepisode']['href'];
    
    $preNext =$dataArray[$id]['show']['_links']['nextepisode']['href'];
    

    
    echo "<div class='container'>";
    echo "<H1>Show Details</H1>";
    echo "</div>";


    echo "<div class='container'>";
   echo "<div class='card' >";
  echo "<div class='row no-gutters'>";
    echo "<div class='col-md-4'>";
      echo "<img src='data:image/jpg;base64,$image' class='card-img'>";
    echo "</div>";
    echo "<div class='col-md-8'>";
      echo "<div class='card-body'>";
        echo "<h5 class='card-title'> $name</h5>";
        echo "<p class='card-text'><i>$summary</i></p>";
        echo "<p class='card-text'><strong>Season</strong> : $season</p>";
        echo "<p class='card-text'><strong>Episode Number</strong> : $epnumber</p>";
        echo "<p class='card-text'><strong>Duration</strong> : $duration minutes</p>";
        echo "<p class='card-text'><strong>Type</strong> : $type</p>";
        echo "<p class='card-text'><strong>Language</strong> : $language</p>";
        echo "<p class='card-text'><strong>Genre(s)</strong> :</p>";
    for($x=0; $x<$count ; $x++){
        echo "<p class='card-text badge badge-primary'> $genres[$x] 
        </p>";
    }
        echo "<p class='card-text'>Rating :<span class='badge badge-success' id='span'>$rating</span></p>";

    
      echo "</div>";
    echo "</div>";
  echo "</div>";
echo "</div>";
    
    echo "<div class='container'>";
    echo "<div class='card' style='max-width:1000px;border-style:none;background-color:black;color:white;'>";
    echo "<div class='card-body'>";
    echo "<p class='card-text' id='content'> $content</p>";
    echo "</div>";
    
    echo "<div class='btn-group' role='group' aria-label='Basic example'>";
    echo "<a href=$site target='_blank' class='btn btn-success' id='button'>Click here to go to the official website!</a>";
    echo "<a href=$url target='_blank' class='btn btn-success'>Click here to watch the show!</a>";
    echo "</div>";

    
   ?> 
    </body>
    
    
    </html>


