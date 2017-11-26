<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin login</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/rwdgrid.min.css">
    <link rel="stylesheet" href="../css/admin.css?version=124">
</head>

<body class="background">
    <div class="admin-form">
        <?php if(isset($_SESSION['user_error'])): ?>
        <span class="red"><?php echo $_SESSION['user_error'];
                unset($_SESSION['user_error']); ?></span>
        <?php endif; ?>
        <form method="post">
            <h1>Admin login form</h1>
            <input type="text" name="name" placeholder="Enter username..."></br>
            <input type="password" name="pass" placeholder="Enter password...">
            <button type="submit" name="login" class="btn-4"> <span> submit</span> </button>
        </form>
        <a href="../">Back to home page...</a>
    </div>
</body>

</html>
