<?php
$sql = "SELECT * FROM stores";
$action = mysqli_query($connection, $sql);
$results = mysqli_fetch_all($action, MYSQLI_ASSOC);
?>

<form action="customer.php" method="get">
    <input type="hidden" name="action" value="shops">
    <select name='shop_id'>
        <option value='0'>–</option>
        <?php
            foreach ($results as $value_of) { ?>
            <option value="<?php echo $value_of['id'] ?>"> <?php echo $value_of['store_title'] ?> </option>
        <?php }?>
    </select>
    <input type="submit" value="Go To The Store">
</form>