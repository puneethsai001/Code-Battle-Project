<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';

    $query1="SELECT (H_id) from judges_category where username=:username;";
    $stmt=$pdo->prepare($query1);
    $username=$_SESSION['user_username'];
    $stmt->bindParam(":username",$username);
    $stmt->execute();
    $H_id = $stmt->fetchColumn();
    $_SESSION['H_id']=$H_id;
    // echo $H_id;
    $query2="SELECT * FROM `judges_category` where H_id=:H_id AND username=:username group by C_id;";
    $stmt=$pdo->prepare($query2);
    $stmt->bindParam(":H_id",$H_id);
    $stmt->bindParam(":username",$username);
   
    $stmt->execute();
    $result=$stmt->fetchAll();
    ?>

<?php 
    foreach($result as $row){   
?>
        <div class = "all-cards"> 
            <?php 
            if( $row['CName']=='Jr_Cadet'){
            ?>
                <div class="card" id = "cadet-card" value="">
                    <div id="cadet-image">
                    </div>
                    <div class="card-text">
                        <h2>Jr Cadet</h2>
                        <p>
                        The Jr Cadet category in the hackathon is designed 
                        for young minds brimming with potential, specifically 
                        targeting students from Grades 1 to 4.
                        </p>
                    </div>
                </div>
            <?php 
                }
            if($row['CName']=='Jr_Colonel'){ 
            ?>
                <div class="card" id = "colonel-card">
                    <div id="colonel-image" >
                    </div>
                    <div class="card-text">
                        <h2>Jr Colonel</h2>
                        <p>The Jr Colonel category in the hackathon welcomes high 
                        schoolers and young minds embarking on their undergraduate 
                        journeys, encompassing students from Grades 9-12 and first-year 
                        undergraduates.
                        </p>
                    </div>
                </div>
            <?php 
                } 
            if(($row['CName']=='Jr_Captain')){ 
            ?>
                <div class="card" id = "captain-card">
                    <div id="captain-image">
                    </div>
                    <div class="card-text">
                        <h2>Jr Captain</h2>
                        <p>The Jr Captain category in the hackathon sets sail for students in 
                        Grades 5-8, a period marked by burgeoning independence, intellectual 
                        curiosity, and a thirst for exploration.
                        </p>
                    </div>
                </div>
            <?php 
                }
            ?>
        </div>
<?php
    } 
?>