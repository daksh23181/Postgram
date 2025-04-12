<?php
header('Content-Type: application/json');

// Database configuration (same as above)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get POST data
$userProfileID1 = $_POST['UserProfileID1'];
$userProfileID2 = $_POST['UserProfileID2'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Friendship (UserProfileID1, UserProfileID2) VALUES (?, ?)");
$stmt->bind_param("ii", $userProfileID1, $userProfileID2);

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Friendship added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>