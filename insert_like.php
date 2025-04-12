<?php
header('Content-Type: application/json');

// Database configuration (same as above)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get POST data
$likeID = $_POST['Post_Like_ID'];
$postID = $_POST['Post_id'];
$userProfileID = $_POST['UserProfileID'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Post_Like (Post_Like_ID, Post_id, UserProfileID) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $likeID, $postID, $userProfileID);

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Like added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>