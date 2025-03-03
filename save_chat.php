<?php
$file = 'chat.json';

// Read incoming data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is valid
if ($data && isset($data['user']) && isset($data['message'])) {
    // Read existing messages
    $messages = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    
    // Add new message
    $messages[] = [
        'user' => $data['user'],
        'message' => $data['message']
    ];
    
    // Save back to JSON file
    file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT));

    // Return success response
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}
?>
