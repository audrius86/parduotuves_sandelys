<?php
$email = $_SESSION['email'];
$sql = "SELECT fullname, wallet FROM customers WHERE email='$email'";
$result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
?>
<h1>Welcome, <?php echo $result['fullname'] ?></h1>
<h3>Your credit limit: <span id="credit_value"><a href="customer.php?action=update_data"><?php echo $result['wallet'] ?? 0 ?></a></span> €</h3>