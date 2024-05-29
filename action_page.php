<?php
include("db.php"); // Include the database connection

    // ADD User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_card_data'])) {
    file_put_contents('/var/www/html/Tresmagia_SmartLock/card_data.txt', '');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['add_user'])) {
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
        $success_message = "User added successfully";
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to usersList.php after successful insertion
        header("Location: usersList.php?success_message=" . urlencode($success_message));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
    //  END ADD User

    // Add Section
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_section'])) {
    // Capture and sanitize form data
    $section_name = htmlspecialchars($_POST['section_name']);
    $course = htmlspecialchars($_POST['course']);
    $year = htmlspecialchars($_POST['year']);
    $section = htmlspecialchars($_POST['section']);

    // Validate that section_name is not empty
    if (empty($section_name) || empty($course) || empty($year) || empty($section)) {
        die("All fields are required.");
    }

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO `section` (`section_name`, `course`, `year`, `section`) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $section_name, $course, $year, $section);

    // Execute the query
    if ($stmt->execute()) {
        $success_message = "Section added successfully";
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to addSchedule.php after successful insertion
        header("Location: addSchedule.php?success_message=" . urlencode($success_message));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
        // End Add Section

        // Add Subject
if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['add_subject'])) {
    // Capture and sanitize form data
    $subject_name = htmlspecialchars($_POST['subject_name']);

    // Validate that subject_name is not empty
    if (empty($subject_name)) {
        die("Subject name is required.");
    }

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO `subject` (`subject_name`) VALUES (?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $subject_name);

    // Execute the query
    if ($stmt->execute()) {
        $success_message = "Subject added successfully";
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to the same page after successful insertion
        header("Location: addSchedule.php?success_message=" . urlencode($success_message));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
        // END Add Subject

        // Start Add Schedule

        // Handle form submission for adding a schedule
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_schedule'])) {
    // Capture and sanitize form data
    $dayOfWeek = htmlspecialchars($_POST['day_of_week']);
    $startTime = htmlspecialchars($_POST['inputStartTime']);
    $endTime = htmlspecialchars($_POST['inputEndTime']);
    $subjectName = htmlspecialchars($_POST['subject']);
    $sectionName = htmlspecialchars($_POST['section']);

    // Prepare SQL to get subject_id based on subject_name
    $stmt = $conn->prepare("SELECT subject_id FROM subject WHERE subject_name = ?");
    $stmt->bind_param("s", $subjectName);
    $stmt->execute();
    $result = $stmt->get_result();
    $subjectRow = $result->fetch_assoc();
    $subjectId = $subjectRow['subject_id'];

    // Prepare SQL to get section_id based on section_name
    $stmt = $conn->prepare("SELECT section_id FROM section WHERE section_name = ?");
    $stmt->bind_param("s", $sectionName);
    $stmt->execute();
    $result = $stmt->get_result();
    $sectionRow = $result->fetch_assoc();
    $sectionId = $sectionRow['section_id'];

    // Prepare SQL and bind parameters for INSERT query
    $stmt = $conn->prepare("INSERT INTO schedules (day_of_week, start_time, end_time, subject_id, section_id) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssi", $dayOfWeek, $startTime, $endTime, $subjectId, $sectionId);

    // Execute the query
    if ($stmt->execute()) {
        $success_message = "Schedule added successfully";
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to the same page after successful insertion
        header("Location: schedule.php?success_message=" . urlencode($success_message));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Handle AJAX request for autocomplete suggestions
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search']) && isset($_POST['query'])) {
    include("db.php"); // Include your database connection

    $searchType = htmlspecialchars($_POST['search']);
    $query = htmlspecialchars($_POST['query']);

    if ($searchType === 'subject') {
        $stmt_subject = $conn->prepare("SELECT subject_name FROM subject WHERE subject_name LIKE CONCAT('%', ?, '%')");
        $stmt_subject->bind_param("s", $query);
        $stmt_subject->execute();
        $result_subject = $stmt_subject->get_result();
        if ($result_subject->num_rows > 0) {
            while ($row = $result_subject->fetch_assoc()) {
                echo '<div class="autocomplete-suggestion">' . $row["subject_name"] . '</div>';
            }
        }
        $stmt_subject->close();
    }

    if ($searchType === 'section') {
        $stmt_section = $conn->prepare("SELECT section_name FROM section WHERE section_name LIKE CONCAT('%', ?, '%')");
        $stmt_section->bind_param("s", $query);
        $stmt_section->execute();
        $result_section = $stmt_section->get_result();
        if ($result_section->num_rows > 0) {
            while ($row = $result_section->fetch_assoc()) {
                echo '<div class="autocomplete-suggestion">' . $row["section_name"] . '</div>';
            }
        }
        $stmt_section->close();
    }

    $conn->close();
    exit();
}
      
?>
