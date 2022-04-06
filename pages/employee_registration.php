<?php

if(isset($_POST['employee_name'])){
    $employee_name = $_POST['employee_name'];
    $role_id = $_POST['role_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    $errors = [];

    if(strlen($employee_name) < 7) {
        $errors['employee_name'][] = 'Your name is too short!';
    }

    $sql = "SELECT * FROM roles WHERE id = '$role_id'";
    $result = mysqli_query($connection, $sql);
    if(!mysqli_num_rows($result)) {
        $errors['role_id'][] = 'Select employee`s role!';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Wrong email!';
    }

    $sql = "SELECT * FROM employees WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)) {
        $errors['email'][] = 'This email already exist!';
    }

    if (strlen($password) < 6) {
        $errors['password'][] = 'Password should be longer than 5 symbols';
    }

    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'][] = 'Password must contain at least 1 letter and 1 number';
    }

    if ($email == $password) {
        $errors['password'][] = 'Password and email can`t match!';
    }

    if ($password != $repeat_password) {
        $errors['repeat_password'][] = 'Passwords don`t match';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO employees (employee_name, role_id, email, password) VALUES ('$employee_name', '$role_id', '$email', '$password')";
        $result = mysqli_query($connection, $sql);
//        ?>
<!--        <script>alert('New Employee Added')</script>-->
<?php
        header('Location: index.php');
    }
}

?>

<form action="index.php?action=employee_registration" method="post">
    <input type="text" name="employee_name" placeholder="Employee name" required="required"/> <?php
    if (isset($errors['employee_name'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['employee_name']);?></span>
        <br>
        <?php }

    $sql = "SELECT * FROM roles";
    $action = mysqli_query($connection ,$sql);?>
    <br>
    <label><b>Select role</b></label>
    <br>
    <select name='role_id'>
       <option value='-1'>–</option>
        <?php while ($row = mysqli_fetch_array($action)) {?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['role'] ?></option>";
        <?php } ?>
        </select>
    <?php if (isset($errors['role_id'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['role_id']);?></span>
    <?php
    }
    ?>
    <br>
    <input type="email" name="email" placeholder="Employee email" required="required"/> <?php
    if (isset($errors['email'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['email']);?></span>
    <?php }?>
    <br>
    <input type="password" name="password" value="" placeholder="Enter a password" required="required"/> <?php
    if (isset($errors['password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['password']);?></span>
    <?php }?>
    <br>
    <input type="password" name="repeat_password" placeholder="Repeat password" required="required"/> <?php
    if (isset($errors['repeat_password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['repeat_password']);?></span>
    <?php }?>
    <br>
    <input type="submit" value="Save">
</form>