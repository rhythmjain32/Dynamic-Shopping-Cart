<?php
include 'nav_bar.php';

$sql = "SELECT * FROM product_details WHERE p_id = '01'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);

echo $row['p_id'];
echo $row['p_name'];
