<?php
require_once 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

try {
    $stmt = $pdo->prepare("INSERT INTO User (UserID, Email, Address_street, Address_city, Address_state, Pincode, Mobile) 
                          VALUES (:user_id, :email, :street, :city, :state, :pincode, :mobile)");
    
    $stmt->execute([
        ':user_id' => $data['user-id'],
        ':email' => $data['email'],
        ':street' => $data['street'],
        ':city' => $data['city'],
        ':state' => $data['state'],
        ':pincode' => $data['pincode'],
        ':mobile' => $data['mobile'] ?? null
    ]);

    echo json_encode(['success' => true, 'message' => 'User added successfully']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>