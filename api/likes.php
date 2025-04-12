<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../config.php';

try {
    $stmt = $pdo->query("SELECT * FROM post_like");
    $likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($likes);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 