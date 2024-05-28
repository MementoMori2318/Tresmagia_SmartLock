<?php
include("db.php"); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_card_data'])) {
    file_put_contents('/var/www/html/Tresmagia_SmartLock/card_data.txt', '');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $userId = htmlspecialchars($_POST['userId']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $userRole = htmlspecialchars($_POST['userRole']);
    $cardUid = htmlspecialchars($_POST['inputCardUid']);

    // Additional logic to handle optional fields
   
    $yearSection = !empty($_POST['inputYearSection']) ? htmlspecialchars($_POST['inputYearSection']) : null;

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO users (`name`, `user_id`, `year_section`, `email`, `password`, `role`, `cards_uid`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters with correct types, using "s" for strings and "i" for integers
    $stmt->bind_param("sssssss", $name, $userId, $yearSection, $email, $password, $userRole, $cardUid);

    // Execute the query
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to usersList.php after successful insertion
        header("Location: usersList.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
