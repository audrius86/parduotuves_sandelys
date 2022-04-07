<?php

if(isset($_POST['store_id'])){
    $store_id = $_POST['store_id'];
    $employee_id = $_POST['employee_id'];
    $salary = $_POST['salary'];

    $errors = [];

    $sql = "SELECT * FROM stores WHERE id = '$store_id'";
    $result = mysqli_query($connection, $sql);
    if(!mysqli_num_rows($result)) {
        $errors['store_id'][] = 'Select store!';
    }

    $sql = "SELECT * FROM employees WHERE id = '$employee_id'";
    $result = mysqli_query($connection, $sql);
    if(!mysqli_num_rows($result)) {
        $errors['employee_id'][] = 'Select employee!';
    }


    if (empty($errors)) {
        $sql = "INSERT INTO employment_contracts (store_id, employee_id, salary) VALUES ('$store_id', '$employee_id', '$salary')";
        $result = mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

?>

<form action="index.php?action=hire_employee" method="post">
    <?php
    $sql = "SELECT * FROM stores";
    $action = mysqli_query($connection ,$sql);?>
    <br>
    <label><b>Choose Store</b></label>
    <br>

    <select name='store_id'>
        <option value='-1'>–</option>
        <?php
        while ($row = mysqli_fetch_array($action)) { ?>
            <option value="<?php echo $row['id'] ?>"> <?php echo $row['store_title'] ?> </option>
        <?php }?>
    </select>
    <?php
    if (isset($errors['store_id'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['store_id']);?></span>
        <?php
    }
    ?>
    <br>
    <?php
    $sql = "SELECT e.*, r.role FROM employees e JOIN roles r ON e.role_id = r.id WHERE r.role='Store employee'";
    $action = mysqli_query($connection ,$sql);?>
    <br>
    <label><b>Choose Employee</b></label>
    <br>

    <select name='employee_id'>
        <option value='-1'>–</option>
        <?php
        while ($row = mysqli_fetch_array($action)) { ?>
            <option value="<?php echo $row['id'] ?>"> <?php echo $row['employee_name'] ?> </option>
        <?php }?>
    </select>
    <?php
    if (isset($errors['employee_id'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['employee_id']);?></span>
        <?php
    }
    ?>
    <br>
    <input type="number" step="0.01" name="salary" placeholder="Salary" required="required"/> <br/>
    <br>
    <input type="submit" value="Hire Employee">
</form>