<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>