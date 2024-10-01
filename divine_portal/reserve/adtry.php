<?php
    $showStudent = '';
    $showAdmin = '';
            if ($userType == 1) {
                $showStudent = "none";
            } else if ($userType == 0) {
                $showStudent = "block";
            }

            if ($userType == 0) {
                $showAdmin = "none";
            } else if ($userType == 1) {
                $showAdmin = "block";
            }
    ?>

    <div style="display: <?php echo $showStudent; ?>">
            this is for student div
    </div>

    
    <div style="display: <?php echo $showAdmin; ?>">
            this is for Admin div
    </div>


    

    <?php
        if(isset($_SESSION["create"])){
            ?>

            <?php
            echo $_SESSION["create"];
            unset($_SESSION["create"]);
            ?>

    <?php
        }
    ?>

    <?php
        if(isset($_SESSION["submit"])){
            ?>

            <?php
            echo $_SESSION["submit"];
            unset($_SESSION["submit"]);
            ?>

            <?php
                }
            ?>

    <?php
        if(isset($_SESSION["edit"])){
            ?>

            <?php
            echo $_SESSION["edit"];
            unset($_SESSION["edit"]);
            ?>

    <?php
        }
    ?>

    <?php
        if(isset($_SESSION["delete"])){
            ?>

            <?php
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
            ?>

    <?php
        }
    ?>