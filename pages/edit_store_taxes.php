<?php
//
//$sql = "SELECT *, ec.store_id FROM stores s JOIN employment_contracts ec ON s.id = ec.store_id WHERE ec.employee_id = ' ". $_SESSION['employee_id'] ." '";

$sql = "SELECT *, ec.store_id FROM stores s JOIN employment_contracts ec ON s.id = ec.store_id WHERE ec.employee_id = ' ". $_SESSION['employee_id'] ." '";
$result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
$store_id = $result['store_id'];

$category_id = $_POST['category_id'] ?? null;

if (isset($_POST['surcharge'])) {
    $surcharge = $_POST['surcharge'];

    $sql = "UPDATE store_management SET surcharge ='$surcharge' WHERE store_id = '$store_id' and category_id = '$category_id'";
    mysqli_query($connection, $sql);
}

if (isset($_POST['category_discount'])) {
    $category_discount = $_POST['category_discount'];

    $sql = "UPDATE store_management SET category_discount ='$category_discount' WHERE store_id = '$store_id' and category_id = '$category_id'";
    mysqli_query($connection, $sql);
}
?>
<table class="products_list">
    <tr>
        <td>Category</td>
        <td>Surcharge</td>
        <td>Category_discount</td>
    </tr>
    <?php $sql = "SELECT pc.*, sm.surcharge, sm.category_discount FROM products_categories pc JOIN store_management sm ON pc.id = sm.category_id WHERE sm.store_id = '$store_id'";
    $action = mysqli_query($connection ,$sql);
    while ($row = mysqli_fetch_array($action)) { ?>
    <tr>
        <td><?php echo $row['category'] ?></td>
        <form action="#" method="post">
            <td>
                <input type="hidden" name="category_id" value="<?php echo $row['id'] ?>">
                <input type="number" step="0.01" name="surcharge" placeholder="<?php echo $row['surcharge'] ?>">
                <input type="submit" value="update">
            </td>
        </form>
        <form action="#" method="post">
            <td><input type="hidden" name="category_id" value="<?php echo $row['id'] ?>">
                <input type="number" step="0.01" name="category_discount" placeholder="<?php echo $row['category_discount'] ?>">
                <input type="submit" value="update">
            </td>
        </form>
    </tr>
    <?php } ?>
</table>
