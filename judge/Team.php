<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'judgecatdata.php'; 

// if($result3[0]['T_id'] === null){
//     $result3=[];
// }
// ?>
    
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #272727;
    color: white;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.card {
  background-color: transparent;
  width: 300px;
  height: 500px;
  perspective: 1000px;
  display: flex;
  margin: auto;
  margin-bottom: 50px;
}

.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card-container{
    display: flex;
            justify-content: space-around; /* Adjust alignment */
            flex-wrap: wrap; /* Allow cards to wrap to next line */
            max-width: 1000px; /* Limit container width */
            margin: 0 auto; /* Center container */
            padding: 20px; /* Add some spacing */
}
.card:hover .card-inner {
  transform: rotateY(180deg);
}

.card h1 {
    font-size:90px;
}

.card-front, .card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 18px;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.card-front {
  background-color: white;
  color: black;
  grid-template-columns: 400px;
  grid-template-rows: 290px 210px;
  grid-template-areas: "image" "text";
}

.card-back {
  background-color: #F73634;
  color: white;
  transform: rotateY(180deg);
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-text {
    grid-area: text;
    margin: 25px;
}
    
.card-text p {
    font-size:15px;
    font-weight: 300;
}
.card-text h2 {
    margin-top:0px;
    font-size:28px;
}
.card-text h3 {
    margin-top:70px;

}

footer {
    background-color: black;
    color: #ffffff; 
    padding: 5px;
    text-align: center;
    position: sticky;
    top: 100%;
}
H1{
    text-align: center;
}

</style>
</head>
<body>
    <h1 style="text-align:center;margin-top: 90px;"><?php echo $_SESSION['CName'].'s'?></h1>  
    <?php if(!empty($result3)) { ?> 
        <div class="card-container">
            <?php foreach($result3 as $row) { ?>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div id="cadet-image">
                                <img src="https://img.freepik.com/premium-vector/red-circuit-board-wallpaper-digital-technology-background_636138-735.jpg" alt="Italian Trulli" style="width: 300px; height:290px; border-top-right-radius: 16px; border-top-left-radius: 16px;">
                            </div>
                            <div class="card-text">
                                <h2><?php echo $row['T_id'] ?></h2>
                                <h2><?php echo $row['TName'] ?></h2>
                            </div>
                        </div>
                        <div class="card-back">
                            <p>SCORE</p>
                            <h1><?php echo $row['score'] ?></h1>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h2 style="text-align: center;">No teams under this category</h2>
    <?php } ?>
    <footer>
        <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    </footer>
</body>
</html>
