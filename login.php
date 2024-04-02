<?php
global $pdo;
session_start();
require "connection_db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if($_POST['user_type'] == 'company'){
        $sql = "SELECT * FROM companies WHERE name = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //     echo "<pre>";
            //     print_r($result[0]);
            //    echo" </pre>";
        if (count($result) > 0) {
            $_SESSION["company_user"] = $username;
            $sql = "SELECT id FROM companies WHERE name = :username AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
           
            $comp_id = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($comp_id) {
                $compId = $comp_id['id'];
                $_SESSION["comp_id"] = $compId;
               // unset($_SESSION['company_user']);
                //unset($_SESSION['comp_id']);
                print_r( $_SESSION);

                // var_dump($_SESSION["comp_id"]);die;
              header("location: index.php");
                exit; 
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid username or password";
        }
    }
    else {
        $sql = "SELECT * FROM applicants WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $_SESSION["applicant_user"] = $username;
            header("location: index.php");
        } else {
            echo "Invalid username or password";
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* Basic styling for the form */
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form action="login.php" method="post">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <div>
        <p>Are you an applicant or a company?</p>
        <input type="radio" id="applicant" name="user_type" value="applicant" required>
        <label for="applicant">Applicant</label>
    </div>
    <div>
        <input type="radio" id="company" name="user_type" value="company" required>
        <label for="company">Company</label>
    </div>
    <input type="submit" value="Login">
    <div style="display:flex;gap:10px;margin-top:20px">
        <div>if you don't have account</div>
        <a href="register.php">register</a>

    </div>
</form>

</body>
</html>


