<?php
header('Content-Type: application/json');

// Database configuration (same as above)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get POST data
$commentID = $_POST['Post_Comment_ID'];
$postID = $_POST['Post_id'];
$userProfileID = $_POST['UserProfileID'];
$text = $_POST['Text_commented'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Post_Comment (Post_Comment_ID, Post_id, UserProfileID, Text_commented) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $commentID, $postID, $userProfileID, $text);

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Comment added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>