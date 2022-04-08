<?php
if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];

    $sql = "SELECT product_id, quantity FROM warehouse_products WHERE product_id='$product_id'";

    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

    if (!isset($result['quantity']) ?? null) {
        $current_quantity = 0;
    } else {
        $current_quantity = $result['quantity'];
    }

    $updated_quantity = $current_quantity + $quantity;

    $sql = "UPDATE warehouse_products SET quantity='$updated_quantity' WHERE product_id='$product_id'";
    $result = mysqli_query($connection, $sql);
    header('Location: index.php?action=warehouse_products');
}
?>
<h1>Add more to Warehouse</h1>
<?php
$product_id = $_POST['product_id'];
$sql = "SELECT p.id, w.quantity, p.product_title, p.price, c.category FROM warehouse_products w JOIN products p ON w.product_id = p.id JOIN products_categories c ON p.category_id = c.id WHERE p.id = '$product_id' ORDER BY p.id";
$result = mysqli_fetch_array(mysqli_query($connection, $sql));
//var_dump($result);
?>
<table class="products_list">
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <tr>
        <form action="#" method="post">
            <td>
                <input type="hidden" name="product_id" value="<?php echo $result['id'] ?>">
                <?php echo $result['id']; ?>

            </td>
            <td>
                <?php echo $result['category'] ?>
            </td>
            <td>
                <?php echo $result['product_title'] ?>
            </td>
            <td>
                <?php echo $result['price'] ?>
            </td>
            <td>
                <input id="quantity_id" type="number" name="quantity" min="1" placeholder="1 ... ">
            </td>
            <td>
                <input type="submit" value="Buy More">
            </td>
        </form>
    </tr>
</table>

