<?php
    session_start();
    $database_name = "product_chocolate";
    $con = mysqli_connect(host:"localhost", user:"root", password:"", "product_chocolate"):


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel ="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
        
            <title>Choclate Cake</title>

            <style>
			.chocolate{
				border: 1px solid #0000FF;
				margin: -1px 19px 3px -1px;
				padding: 10px;
				text-align: center;
				background-image: url('marblepinkbackground.jpg');
			}
            table, th, tr{
                text align: center;
            }
            .title2{
                text-align:center;
                color: #0000FF;
                background color:  #E3BC9A;
                padding: 2%;
            }
            h2{
                text-align: center;
                color:rgb(49, 49, 49);
                padding: 2%;

            }
            table th{
                background color:#0000FF;
            }
            }


</style>

</head>
<body>
    <div class="container" style="width:65%">
    <h2>Chocolate Cakes</h2>

<!----collect data from database tables----->
<?php
    $query = "SELECT * FROM chocolate ORDER BY id ASC";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) >0 ){

    

        while($row = mysqli_fetch_array($result)){
        
       
            
            ?>
            <div class="col-md-3">
                <form method ="post" action="chocolate.php?action=add&id=<?php  echo $row ["id"] ?>">
                <div class= "chocolate">
                    <!---dynamic images--->

                    <img src = "<?php echo $row["image"] ?>" class="image-responsive">
                    <h5 class="text-info"><?php $row["cname"]; ?></h5>
                    <h5 class="text-danger"><?php $row["price"]; ?></h5>
                    <input type = "text" name="quantity" class="form-control" value="1">
                    <input type="hidden" name="hidden_name" value="<?php echo $row["cname"]; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                    <input type="submit" name="add" style=" margin-top: 5px;" class="btn btn-success" value="order">

    </div>
    </form>
    </div>
    <?php
    }

}


?>

<div style="clear: both"></div>
<h3 class="title2">Order details</h3>
<div class="table table-bordered">
    <tr>
        <th width="30%">Product Name</th>
        <th width="10%">Quantity</th>
        <th width="13%">Price</th>
        <th width="10%">Total price</th>
        <th width="17%">Remove Item</th>
</tr>

<!---total amount--->

<?php
    if (!empty ($_SESSION["chocolate"])){
        $total = 0;
        foreach($_SESSION["chocolate"] as $key => $value){
            ?>
            <tr>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo $value["item_quantity"]; ?></td>
                <td>$ <?php echo $value["product_price"]; ?></td>
                <td>$ <?php echo number_format(number: $value["item_quantity"] * $value["product_price"], decimals: 2; ?></td>
                <td><a href="chocolate.php?action=delete&id=<?php echo $value["product_id"];?>"><span class="text-danger">Remove Item</span></a></td>
        </tr>
        <!---calculation formula--->

        <?php
            $total =$total + ($value["item_quantity"]* $value["product_price"]);
        }
        ?>
        <tr>
            <td colspan="3" align="right">Total</td>
            <th align="right">$ <?php echo number_format($total, decimals:2); ?></th>
            <td></td>
        </tr>
        }

    }
        







</body>
</html>