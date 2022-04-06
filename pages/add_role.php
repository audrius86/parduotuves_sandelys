<?php

if(isset($_POST['role'])){
    $role = $_POST['role'];

$errors = [];

$sql = "SELECT * FROM roles WHERE role = '$role'";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result)) {
    $errors['role'][] = 'This role already created!';
}



if (empty($errors)) {

    $sql = "INSERT INTO roles (role) VALUES ('$role')";
    $result = mysqli_query($connection, $sql);
    header('Location: index.php');
}
}

?>

<form action="index.php?action=add_role" method="post">
    <input type="text" name="role" placeholder="Role title " required="required"/><br> <?php
    if (isset($errors['role'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['role']);?></span>
        <?php
    }
    ?><br/>
    <input type="submit" value="Save Role">
</form>