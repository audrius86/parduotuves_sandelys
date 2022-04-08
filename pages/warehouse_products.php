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
            <form action="index.php?action=update_quantity" method="post">
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
                    <?php echo $row['price'] ?>
                </td>
                <td>
                    <?php
                    if($row['quantity'] < 100){?>
                    <span style="color: red; font-weight: bold"><?php echo $row['quantity'] ?> </span>
                    <?php } else { ?>
                        <span style="color: green"><?php echo $row['quantity'] ?> </span>
                    <?php } ?>
                </td>
                <td>
                    <input type="submit" value="Add">
                </td>
            </form>
        </tr>
    <?php } ?>
</table>

