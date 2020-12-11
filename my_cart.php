<?php
include 'nav_bar.php';
if (isset($_GET['add_to_cart'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'])) {
        $cart_item = array_column($_SESSION['cart'], 'p_id');

        if (in_array($_GET['id'], $cart_item)) {
            echo '<script>alert("Product is already Added to Cart")</script>';
            echo '<script>window.location="index.php"</script>';
        } else {
            $sql = "SELECT * FROM product_details WHERE p_id = '$id'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $_SESSION['count'] = count($_SESSION['cart']);
            $_SESSION['cart'][$_SESSION['count']] =
                array(
                    'p_id' => $id,
                    'p_name' => $row['p_name'],
                    'p_image' => $row['p_image'],
                    'p_price' => $row['p_price']
                );
            echo '<script>alert("Item Added")</script>';
            echo '<script>window.location="my_cart.php"</script>';
        }
    } else {
        $sql = "SELECT * FROM product_details WHERE p_id = '$id'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        $_SESSION['cart']['0'] =
            array(
                'p_id' => $id,
                'p_name' => $row['p_name'],
                'p_image' => $row['p_image'],
                'p_price' => $row['p_price']
            );
        echo '<script>alert("Item Added")</script>';
        echo '<script>window.location="my_cart.php"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-4 p-4 my-5 bg-white rounded shadow-sm">

                <!-- Shopping cart table -->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $total = 0;
                            if (!empty($_SESSION["cart"]))
                                foreach ($_SESSION["cart"] as $key => $value) {
                                    $total += $value["p_price"];
                            ?>
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="prod_images/<?php echo $value['p_image']; ?>" alt="error 404" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php echo $value['p_name']; ?></a></h5><span class="text-muted font-weight-normal font-italic d-block">Category: Watches</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>₹<?php echo $value['p_price']; ?></strong></td>
                                    <td class="border-0 align-middle"><strong>p_qty</strong></td>
                                    <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 py-3 p-4 my-5 bg-white rounded shadow-sm">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                <div class="p-4">
                    <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$390.00</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>$0.00</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                            <h5 class="font-weight-bold">₹<?php echo $total ?></h5>
                        </li>
                    </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>