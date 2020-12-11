<?php

include 'nav_bar.php';

$query = "SELECT * from product_details";
$res = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="copied_bs.css" type="text/css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy here</title>
</head>

<body>
    <div class="container py-5">
        <div class="row pb-5 mb-4">
            <?php while (list($p_id, $p_name, $p_image, $p_price) = mysqli_fetch_array($res)) { ?>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-body p-4">
                            <img src="prod_images/<?php echo $p_image ?>" alt="" class="card-img-top img-fluid d-block  mx-auto mb-3" />
                            <h5><a href="#" class="text-dark"><?php echo $p_id, $p_name ?></a></h5>
                            <p class="small text-muted font-italic">
                                Price: ₹<?php echo $p_price ?>
                            </p>
                            <ul class="list-inline small">
                                <li class="list-inline-item m-0">
                                    <form action="my_cart.php" method="get">
                                        <input type="submit" class="btn btn-secondary btn-sm" name="add_to_cart" value="Add To Cart" />
                                        <input type="hidden" name="id" value="<?php echo $p_id; ?>">
                                    </form>
                                    </i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>