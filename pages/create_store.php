<?php

if(isset($_POST['store_title'])){
    $store_title = $_POST['store_title'];
    $address = $_POST['address'];

    $errors = [];

    $sql = "SELECT * FROM stores WHERE store_title = '$store_title'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result)) {
        $errors['store_title'][] = 'This store title already exist!';
    }

    if($store_title === '') {
        $errors['store_title'][] = 'Empty `Store title` field!';
    }

    if($address === '') {
        $errors['address'][] = 'Empty `Address` field!';
    }

 if (empty($errors)) {

        $sql = "INSERT INTO stores (store_title, address) VALUES ('$store_title', '$address')";
        $result = mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

?>

<form action="index.php?action=create_store" method="post">
    <input type="text" name="store_title" placeholder="Store title " required="required"/><br> <?php
    if (isset($errors['store_title'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['store_title']);?></span>
        <?php
    }
    ?><br/>
    <input type="text" name="address" placeholder="Store address" required="required"/><br> <?php
    if (isset($errors['address'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['address']);?></span>
        <?php
    }
    ?><br/>
    <input type="submit" value="Open New Store">
</form>