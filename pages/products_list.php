<?php
if(isset($_POST['quantity'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "SELECT product_id, quantity FROM warehouse_products WHERE product_id='$product_id'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    $updated_quantity = $result['quantity'] + $quantity;
    if ($result) {
        $sql = "UPDATE warehouse_products SET quantity='$updated_quantity' WHERE product_id='$product_id'";
        $result = mysqli_query($connection, $sql);
        }else{
        $sql = "INSERT INTO warehouse_products (product_id, quantity) VALUES ('$product_id','$quantity')";
    }
}
?>

<h1>Products List</h1>

<table class="products_list">
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php
    $sql = "SELECT p.*, c.category FROM products p JOIN products_categories c ON p.category_id = c.id";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) { ?>
    <tr>
        <form action="#" method="post">
        <td>
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $row['id'] ?>">
            <?php echo $row['id'] ?>
        </td>
        <td>
            <?php echo $row['category'] ?>
        </td>
        <td>
            <?php echo $row['product_title'] ?>
        </td>
        <td>
            <?php echo $row['price'] ?>
        </td>
        <td>
            <input type="number" name="quantity" min="1" placeholder="Quantity">
        </td>
        <td>
            <input type="submit" value="Add To Warehouse">
        </td>
        </form>
    </tr>
    <?php } ?>
</table>
