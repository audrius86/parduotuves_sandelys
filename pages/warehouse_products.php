<?php

?>
<input type="button" onclick="location.href='index.php?action=products_list';" value="Go to Products" />
<h1>Warehouse Products</h1>

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
    $sql = "SELECT w.id, w.quantity, p.product_title, p.price, c.category FROM warehouse_products w JOIN products p ON w.product_id = p.id JOIN products_categories c ON p.category_id = c.id ORDER BY w.id";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <form action="#" method="post">
                <td>
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
                    <?php echo $row['quantity'] ?>
                </td>
                <td>
                    <input type="submit" value="Change Quantity">
                </td>
            </form>
        </tr>
    <?php } ?>
</table>

