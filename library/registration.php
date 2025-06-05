<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library SignUp</title>
    <link rel="stylesheet" type="text/css" href="mystyles.css">
    <script src="https://kit.fontawesome.com/af3b384222.js" crossorigin="anonymous"></script>
</head>
<body>
<style>

    body {
        background-image: url('img/cq5dam.web.1280.1280 (1).jpeg');
        background-size: cover;
        background-position: center;
    }
</style>

<div class="form-container">
    <?php
    require 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname    = $_POST['fname'];
        $lname    = $_POST['lname'];
        $suburb   = $_POST['suburb'];
        $postcode = $_POST['postcode'];
        $email    = $_POST['email'];

        $stmt = $conn->prepare("
            INSERT INTO users 
                (fname, lname, suburb, postcode, email) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "sssss",
            $fname,
            $lname,
            $suburb,
            $postcode,
            $email
        );

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            session_start();
            $_SESSION['user_id'] = $user_id;

            $stmt->close();
            $conn->close();

            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="POST" action="registration.php">
        <input type="text" name="fname"     placeholder="First Name"  required>
        <input type="text" name="lname"     placeholder="Last Name"   required>
        <input type="text" name="suburb"    placeholder="Suburb"      required>
        <input type="text" name="postcode"  placeholder="Postcode"    required>
        <input type="email" name="email"    placeholder="Email"       required>
        <button type="submit">Sign Up</button>
    </form>
</div>
</body>
</html>
