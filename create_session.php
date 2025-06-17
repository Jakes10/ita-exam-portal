<?php
session_start();

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['full_name']) && isset($data['trn'])) {
    // Format full name for avatar (replace spaces with +)
    $avatar_name = str_replace(' ', '+', $data['full_name']);
    
    // Store user data in session
    $_SESSION['user'] = [
        'id' => $data['id'] ?? 1, // Store applicant ID from API response
        'full_name' => $data['full_name'],
        'trn' => $data['trn'],
        'avatar_name' => $avatar_name,
        'date_of_birth' => $data['date_of_birth'],
        'address' => $data['address'],
        'contact_number' => $data['contact_number'],
        'email_address' => $data['email_address'],
        'service_hub_preference' => $data['service_hub_preference'],
        'appointment_date' => $data['appointment_date'],
        'test_attempt' => $data['test_attempt'],
        'is_retake' => $data['is_retake']
    ];
    
    // Return success response
    http_response_code(200);
    echo json_encode(['message' => 'Session created successfully']);
} else {
    // Return error response
    http_response_code(400);
    echo json_encode(['message' => 'Invalid data provided']);
} 