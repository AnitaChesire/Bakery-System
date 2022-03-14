<?php

include_once('includes/connection.php');

if (isset($_POST['updateCat'])){

    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];

    $query = "UPDATE categories SET category_name = ' $catName', category_description = $catDesc WHERE ";

}

?>