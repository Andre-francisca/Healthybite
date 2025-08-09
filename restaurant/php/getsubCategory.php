<?php
require "../include/db.php";
?>
<?php

if(isset($_POST['id'])){
    $ID = htmlspecialchars($_POST['id']);

    
    $q = "SELECT *  FROM subcategory where cat_id = '$ID'";
    $result = mysqli_query($con,$q);
    
}
        ?>

        <option value="" >Select Sub-categry</option>
        <?php
        while($row = mysqli_fetch_array($result)) {
        ?>
        <option value="<?php echo $row["subcat_name"];?>"><?php echo $row["subcat_name"];?></option>
        <?php
        }
        ?>

