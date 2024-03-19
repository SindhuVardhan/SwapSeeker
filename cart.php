<?php
include "includes/header.php";

$db = mysqli_connect("localhost", "root", "", "swapseeker");
$id = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $productid = $_POST['product_id'];
        $sql = "INSERT INTO cart(productid, userid) VALUES('$productid','$id')";
        mysqli_query($db, $sql);

    header("Location: cart.php");
    exit();
    }
}

if (isset($_GET['product_id'])) {
    $productid = $_GET['product_id'];
    $sql = "INSERT INTO cart(productid, userid) VALUES('$productid','$id')";
    mysqli_query($db, $sql);
}

if (isset($_GET['id'])) {
    $cartid = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id='$cartid' ";

    if ($db->query($sql) === TRUE) {
    }
}

$totalprice = 0;

$GetProductDetails = "SELECT cart.id, productid, add_product.product_name, add_product.image_name, add_product.price FROM cart LEFT JOIN add_product ON cart.productid = add_product.id WHERE userid='{$_SESSION['uid']}'";

$Result = mysqli_query($db, $GetProductDetails);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
 <script>   
    function multiply() {
  a = Number(document.getElementById('qty').value);
  a++;
  b = Number(document.getElementById('price').value);
  c = a * b;

  document.getElementById('TOTAL').value = c;
  document.getElementById('subtotal').value = c;
    document.getElementById('tot').value = c;
}


 function minus() {
  a = Number(document.getElementById('qty').value);
  a--;
  b = Number(document.getElementById('price').value);
  c = a * b;

  document.getElementById('TOTAL').value = c;
  document.getElementById('subtotal').value = c;
    document.getElementById('tot').value = c;
}



     </script>
    
</head>

<body>
    
   


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">

            <table class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark">
            <tr>
                <th>Products</th>
                <th>Price</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody class="align-middle">
    <?php
    if (mysqli_num_rows($Result) > 0) {
        while ($rows = mysqli_fetch_assoc($Result)) {
            $rprice = $rows['price'];
            $fullPrice = (int) str_replace(",", "", $rprice);
            $totalprice += $fullPrice;

            $imagestring = $rows['image_name'] . ",dummy.png";
            $image = explode(",", $imagestring);
    ?>
            <tr>
                <td class="align-middle">
                    <img class="cart-image" src="uploads/<?php echo $image[0]; ?>" alt="" style="width: 100px;">
                    <?php echo $rows['product_name']; ?>
                </td>
                <td class="align-middle">
                    <!-- Use number_format to format the price -->
                    <input type="text" name="price" id="price" value="<?php echo number_format($fullPrice); ?>" disabled="disabled" style="width: 60px;">
                </td>
                <td class="align-middle">
                    <a href="cart.php?action=remove&id=<?php echo $rows["id"]; ?>">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                    </a>
                </td>
            </tr>
    <?php
        }
    } else {
        // Display a single row with an empty cart image
    ?>
        <tr>
            <td colspan="3" class="text-center">
                <img class="cart-image" src="img/empty.jpg" alt="Empty Cart" style="width: 500px;">
                <p style="font-weight: bold; color: black;">Your cart is empty</p>
                <a href="index.php" style="text-decoration: none;">
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-2" style="width: 150px; margin: auto;">Shop Now</button>
                </a>
            </td>
        </tr>
        
    <?php
    }
    ?>
</tbody>

    </table>
    
                </form>
            </div>
            <div class="col-lg-4">
                
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3" onClick="multiply()">
                            <h6>Subtotal</h6>
                            <h6><input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="TOTAL" id="TOTAL"
                             value="<?php echo $totalprice;?>" disabled="disabled"> </h6>
                        </div>
                        
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="tot" id="tot"
                             value="<?php echo $totalprice;?>" disabled="disabled"> </h5>
                        </div>
                     <a href="checkout.php"  style="text-decoration: none;">    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


    