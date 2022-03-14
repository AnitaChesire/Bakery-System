<?php

include_once('connection.php');
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

$search = $_POST['search'];

//query to get order based on the search keyword
$searchResult = "SELECT * FROM orders WHERE product_name LIKE '%$search%' OR phone LIKE '%$search%' ";
//execue the query

$res = mysqli_query($conn, $searchResult);
//count all the rows with the results
$queryResults = mysqli_num_rows($res);
//check for availabilty
if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        //fetch all resulting data from the db
        $name = $row['product_name'];
        $quantity = $row['quantity'];
        $amount = $row['amount'];
        $totalAmount = $row['total_amount'];
        $phone = $row['phone'];
        $paymentCode = $row['payment_code'];
        $status = $row['status'];
?>
        <tr>
            <td><?php echo $name  ?>" </td>
            <td><?php echo $quantity  ?>"</td>
            <td><?php echo $amount ?>"</td>
            <td><?php echo $totalAmount  ?>"</td>
            <td><?php echo $phone  ?>"</td>
            <td><?php echo $paymentCode  ?>"</td>
            <td><?php echo $status  ?>"</td>
            <!-- <td><input id="text" type="text" name="text" /></td> -->
            <!-- UPDATING AN ORDER IS TO PROGRESS ITS TRACKING  -->
            <td><button type="submit">Update</button><button type="submit">Delete</button></td>
        </tr>
<?php


    }
} else {
    echo "<div class='alert'>
                No records matching your search
                </div>";
}
?>