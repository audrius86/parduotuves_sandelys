<?php

if(isset($_POST['category_id'])){
    $category_id = $_POST['category_id'];
    $surcharge = $_POST['surcharge'];

    $errors = [];

    $sql = "SELECT * FROM stores s JOIN employment_contracts ec ON s.id = ec.store_id WHERE ec.employee_id = ' ". $_SESSION['employee_id'] ." '";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    $store_id = $result['id'];


    $sql = "SELECT * FROM products_categories WHERE id = '$category_id'";
    $result = mysqli_query($connection, $sql);
    if(!mysqli_num_rows($result)) {
        $errors['category_id'][] = 'Select employee!';
    }

    $sql = "SELECT * FROM store_management WHERE category_id = '$category_id' and store_id = '$store_id'";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)) {
        $errors['category_id'][] = 'This category already completed!';
    }

    if($surcharge === ''){
        $errors['surcharge'][] = 'Enter the surcharge!';
    }


    if (empty($errors)) {
        $sql = "INSERT INTO store_management (store_id, category_id, surcharge) VALUES ('$store_id', '$category_id', '$surcharge')";
        mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

?>

<h1>Manage Store Products</h1>
<form action="index.php?action=register_category" method="post">
    <?php
    $sql = "SELECT * FROM stores";
    $action = mysqli_query($connection ,$sql);?>
<!--    <br>-->
<!--    <label><b>Choose Store</b></label>-->
<!--    <br>-->
<!---->
<!--    <select name='store_id'>-->
<!--        <option value='-1'>–</option>-->
<!--        --><?php
//        while ($row = mysqli_fetch_array($action)) { ?>
<!--            <option value="--><?php //echo $row['id'] ?><!--"> --><?php //echo $row['store_title'] ?><!-- </option>-->
<!--        --><?php //}?>
<!--    </select>-->
<!--    --><?php
//    if (isset($errors['store_id'])) { ?>
<!--        <span style="color: red">--><?php //echo implode(',', $errors['store_id']);?><!--</span>-->
<!--        --><?php
//    }
//    ?>
    <br>
    <?php $sql = "SELECT * FROM products_categories";
    $action = mysqli_query($connection ,$sql); ?>
    <br>
    <label><b>Select product category</b></label>
    <br>

    <select name='category_id'>
        <option value='-1'>–</option>
        <?php
        while ($row = mysqli_fetch_array($action)) { ?>
            <option value="<?php echo $row['id'] ?>"> <?php echo $row['category'] ?> </option>
        <?php }?>
    </select>
    <?php
    if (isset($errors['category_id'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['category_id']);?></span>
        <?php
    }
    ?>
    <br>
    <input type="number" step="0.01" name="surcharge" placeholder="Surcharge"/>
    <?php
    if (isset($errors['surcharge'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['surcharge']);?></span>
        <?php
    }
    ?>
    <br/>
    <br>
    <input type="submit" value="Save Data">
</form>
