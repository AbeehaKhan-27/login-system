<?php

include 'config.php';

$message="";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailStmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email ID already exists.";
        $toastClass = "#007bff";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "Account created successfully!";
            $toastClass = "#28a745";
        } else {
            $message = "Error: " . $stmt->error;
            $toastClass = "#dc3545";
        }

        $stmt->close();
    }
    
    $checkEmailStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <style>
        .center {
            position: absolute;
            left:50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type='Submit'] {
            cursor: pointer;
            width: 50%;
            text-align: center;
        }
    </style>
    <title>Registration</title>
</head>

<body>
    <div class="center">
        <h1>Resgister</h1>
        <form action="" method="POST">
            <input type="name" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input name="submit" type="Submit" value="Register">
        </form>
    </div>
</body>

</html>