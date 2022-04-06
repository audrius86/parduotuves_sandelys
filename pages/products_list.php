<h1>Products List</h1>

<table class="products_list">
    <tr>
        <th>Id</th>
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
        <form>
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
            <input type="number" placeholder="Quantity">
        </td>
        <td>
            <input type="submit" value="Add To Warehouse">
        </td>
        </form>
    </tr>
    <?php } ?>
</table>
