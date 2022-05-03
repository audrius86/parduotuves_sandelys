<?php
$sql = "SELECT * FROM stores";
$action = mysqli_query($connection, $sql);
$results = mysqli_fetch_all($action, MYSQLI_ASSOC);

$order_array = [];

if(isset($_POST['product_quantity'])){
    $product_id = $_POST['product_id'];
    $unique_code = $_GET['unique_code'];
    $full_price = $_POST['full_price'];
    $in_store = $_POST['in_store'];
    $products_quantity = $_POST['product_quantity'];
    $customer_email = $_SESSION['email'];

    $errors = [];

    if($products_quantity < 1) {
        $errors['order'][] = 'You entered bad quantity value';
    }

    if($products_quantity === ''){
        $errors['order'][] = 'You leave empty Quantity field';
    }

    if($products_quantity > $in_store){
        $errors['order'][] = 'Not enough products in store';
    }

    if(empty($errors)) {
        $final_price = number_format(($full_price * $products_quantity), 2, '.');

        $sql = "INSERT INTO orders (unique_code, customer_email, product_id, products_quantity, final_price) VALUES ('$unique_code','$customer_email','$product_id', '$products_quantity', '$final_price')";
        mysqli_query($connection, $sql);

        $sql = "SELECT quantity FROM store_products_warehouse WHERE product_id='$product_id'";

        $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

        $current_quantity = $result['quantity'];

        $updated_quantity = $current_quantity - $products_quantity;

        $sql2 = "UPDATE store_products_warehouse SET quantity='$updated_quantity' WHERE product_id='$product_id'";
        mysqli_query($connection, $sql2);


        $sql3 = "SELECT wallet FROM customers WHERE email='$customer_email'";

        $result2 = mysqli_fetch_assoc(mysqli_query($connection, $sql3));

        $current_wallet = $result2['wallet'];

        $updated_wallet = $current_wallet - $final_price;

        $sql4 = "UPDATE customers SET wallet='$updated_wallet' WHERE email='$customer_email'";
        mysqli_query($connection, $sql4);
    }


}

?>

<?php
if (isset($_GET['shop_id'])) {
$shop_id = $_GET['shop_id'];
$sql = "SELECT sw.*, p.product_title, sum(sw.quantity) as in_store FROM store_products_warehouse sw JOIN products p ON sw.product_id = p.id WHERE sw.store_id = '$shop_id' GROUP BY p.product_title";
$action = mysqli_query($connection, $sql);
$results = mysqli_fetch_all($action, MYSQLI_ASSOC);

    ?>
    <?php if (isset($errors['order'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['order']);?></span>
    <?php } ?>
    <table class="products_list">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>In store</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php foreach ($results as $value_of) { ?>
            <tr>
                <form action="#" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $value_of['product_id'] ?>">

                    <td>
                        <input type="hidden" name="product_title" value="<?php echo $value_of['product_title'] ?>">
                        <?php echo $value_of['product_title'] ?>
                    </td>
                    <td>
                        <input type="hidden" name="full_price" value="<?php echo $value_of['full_price'] ?>">
                        <?php echo $value_of['full_price'] ?>
                    </td>
                    <td>
                        <input type="hidden" name="in_store" value="<?php echo $value_of['in_store'] ?>">
                        <?php echo $value_of['in_store'] ?>
                    </td>
                    <td>
                        <input id="quantity_id" type="number" name="product_quantity" min="1" placeholder="1 ... ">
                    </td>
                    <td>
                        <input type="submit" value="Buy">
                    </td>

                </form>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

<?php
if(isset($_POST['product_quantity'])){ ?>
<h3 style="color: red">Your shop list:</h3>
    <ul>
        <?php
        $unique_code = $_GET['unique_code'];
        $sql = "SELECT o.*, p.product_title FROM orders o JOIN products p ON o.product_id = p.id WHERE o.unique_code = '$unique_code'";
        $action = mysqli_query($connection, $sql);
        $result3 = mysqli_fetch_all($action, MYSQLI_ASSOC);
        foreach ($result3 as $value_of) { ?>
            <ol><?php echo $value_of['product_title'] . " - quantity: " . $value_of['products_quantity'] . ". Full price: " . $value_of['final_price']?></ol>
                <?php }
            ?>
    </ul>
<h3 style="color: darkblue">Total price: <?php
    $sql4 = "SELECT sum(final_price) AS Total FROM orders WHERE unique_code = '$unique_code'";
    $action = mysqli_query($connection, $sql4);
    $result4 = mysqli_fetch_all($action, MYSQLI_ASSOC);
    echo number_format($result4[0]["Total"], 2, '.') ?></h3>
<?php }else{
    echo 'Shop cart is empty';
}
?>