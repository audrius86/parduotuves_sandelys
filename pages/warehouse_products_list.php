<?php
if(isset($_POST['order_quantity'])) {
    $sql = "SELECT * FROM stores s JOIN employment_contracts ec ON s.id = ec.store_id WHERE ec.employee_id = ' " . $_SESSION['employee_id'] . " '";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    $store_id = $result['id'];

    $product_id = $_POST['product_id'] ?? null;
    $purchase_price = $_POST['purchase_price'] ?? null;
    $warehouse_quantity = $_POST['warehouse_quantity'] ?? null;
    $order_quantity = $_POST['order_quantity'] ?? null;

    $errors = [];
    if($warehouse_quantity < $order_quantity) {
        $errors['order_quantity'][] = 'Not enough product quantity in warehouse';
    }

    if($order_quantity === ''){
        $errors['order_quantity'][] = 'Empty order quantity field';
    }

if (empty($errors)) {
    $product_quantity_after_purchase = $warehouse_quantity - $order_quantity;

    $sql = "INSERT INTO store_products_warehouse (store_id, product_id, purchase_price) VALUES ('$store_id','$product_id','$purchase_price')";

    for($counter = 1; $counter <= $order_quantity; $counter++){
        mysqli_query($connection, $sql);
    }

    $sql2 = "UPDATE warehouse_products SET quantity='$product_quantity_after_purchase' WHERE product_id = '$product_id'";
    mysqli_query($connection, $sql2);

    header('Location: index.php?action=warehouse_products_list');
}

}
?>


<?php
$sql2 = "SELECT * FROM products_categories";
$result2 = mysqli_query($connection, $sql2);
$categories_array = [];

while ($row = mysqli_fetch_array($result2)) {
    $categories_array[] = $row['category'];
}
?>



<input type="button" onclick="location.href='index.php?action=products_list';" value="Go to Products" />
<h1>Warehouse Products</h1>

<form action="#" method="post">
    <?php
    $sql = "SELECT * FROM products_categories";
    $action = mysqli_query($connection ,$sql);?>
    <br>
    <label><b>Select product category</b></label>
    <br>

    <select name='category_id'>
        <option value='-1'>–</option>
        <?php
        while ($row = mysqli_fetch_array($action)) { ?>
            <option value="<?php echo $row['category'] ?>"> <?php echo $row['category'] ?> </option>
        <?php }?>
    </select>
    <input type="submit" value="Filter By Category">
</form>
<?php if (isset($errors['order_quantity'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['order_quantity']);?></span>
<?php } ?>
<table class="products_list">
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Order</th>
        <th>Action</th>
    </tr>
    <?php
    $sql = "SELECT p.id, w.quantity, p.product_title, p.price, c.category FROM warehouse_products w JOIN products p ON w.product_id = p.id JOIN products_categories c ON p.category_id = c.id ORDER BY p.id";

    if(isset($_POST['category_id'])){

        $category = $_POST['category_id'];

        if(in_array($category, $categories_array)){
            $sql = "SELECT p.id, w.quantity, p.product_title, p.price, c.category FROM warehouse_products w JOIN products p ON w.product_id = p.id JOIN products_categories c ON p.category_id = c.id WHERE c.category = '$category' ORDER BY p.id";
        }
        else{
            $sql = "SELECT p.id, w.quantity, p.product_title, p.price, c.category FROM warehouse_products w JOIN products p ON w.product_id = p.id JOIN products_categories c ON p.category_id = c.id ORDER BY p.id";
        }
    }

    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <form action="index.php?action=warehouse_products_list" method="post">
                <td>
                    <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
                    <?php echo $row['id'] ?>
                </td>
                <td>
                    <?php echo $row['category'] ?>
                </td>
                <td>
                    <?php echo $row['product_title'] ?>
                </td>
                <td>
                    <input type="hidden" name="purchase_price" value="<?php echo $row['price'] ?>">
                    <?php echo $row['price'] ?>
                </td>
                <td>
                    <input type="hidden" name="warehouse_quantity" value="<?php echo $row['quantity'] ?>">
                    <?php
                    if($row['quantity'] < 100){?>
                        <span style="color: red; font-weight: bold"><?php echo $row['quantity'] ?> </span>
                    <?php } else { ?>
                        <span style="color: green"><?php echo $row['quantity'] ?> </span>
                    <?php } ?>
                </td>
                <td>
                    <input id="quantity_id" type="number" name="order_quantity" min="1" placeholder="1 ... ">
                </td>
                <td>
                    <input type="submit" value="Add">
                </td>
            </form>
        </tr>
    <?php } ?>
</table>

