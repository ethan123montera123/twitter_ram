<?php

    if(isset($_POST["submit"])){
        include ("../database/connection.php");
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM login_twitter WHERE email ='$email'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password']) == true){
                $_SESSION['logged_in'] = true;
                header("Location: ../home.php");
                exit();
            }else{
                echo '<script>alert("Incorrect password!"); window.location.href = "../home.php";</script>';
                exit();
            }
        }else{
            echo '<script>alert("User not found!"); window.location.href = "login.php";</script>';
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Twitter</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96" id="form">
        <h2 class="text-2xl font-semibold mb-6">Let's Begin</h2>
        <form  name="form" action="login.php" method="POST">
            <div class="mb-6">
                <input type="email" id="email" name="email" placeholder="Email" class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-6">
                <input type="password" id="password" name="password" placeholder="Password" class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-6">
                <input type="submit" name="submit" value="Login" class="bg-indigo-500 text-white w-full py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600" required>
            </div>
        </form>
        <div class="text-center">
            <p class="text-sm text-gray-600 mb-2">Don't have an account?</p>
            <a href="signup.php" class="text-indigo-500 hover:text-indigo-700">Sign up</a>
        </div>
    </div>
</body>
</html>