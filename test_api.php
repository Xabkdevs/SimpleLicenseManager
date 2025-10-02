<?php
/**
 * Simple PHP script to test SahelLicenseManager API
 * 
 * Usage: php test_api.php
 * 
 * Make sure to update the $baseUrl variable with your actual API URL
 */

$baseUrl = 'http://localhost:8000/api';
$token = '';

// Helper function to make HTTP requests
function makeRequest($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
        'Content-Type: application/json',
        'Accept: application/json'
    ], $headers));
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status_code' => $httpCode,
        'body' => json_decode($response, true)
    ];
}

// Test functions
function testUserRegistration($baseUrl) {
    echo "=== Testing User Registration ===\n";
    
    $data = [
        'name' => 'Test Admin',
        'email' => 'admin@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password123'
    ];
    
    $response = makeRequest($baseUrl . '/register-user', 'POST', $data);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['data']['token'] ?? null;
}

function testUserLogin($baseUrl) {
    echo "=== Testing User Login ===\n";
    
    $data = [
        'email' => 'admin@test.com',
        'password' => 'password123'
    ];
    
    $response = makeRequest($baseUrl . '/login', 'POST', $data);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['data']['token'] ?? null;
}

function testLicenseRegistration($baseUrl) {
    echo "=== Testing License Registration ===\n";
    
    $data = [
        'license_key' => 'SAHEL-TEST-1234-5678-9012',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'brand_name' => 'Test Restaurant',
        'phone' => '+1234567890',
        'os' => 'Windows 11',
        'additional_data' => [
            'restaurant_id' => 'TEST001',
            'location' => 'Test City'
        ]
    ];
    
    $response = makeRequest($baseUrl . '/register', 'POST', $data);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['success'] ?? false;
}

function testLicenseActivation($baseUrl) {
    echo "=== Testing License Activation ===\n";
    
    $data = [
        'license_key' => 'SAHEL-TEST-1234-5678-9012'
    ];
    
    $response = makeRequest($baseUrl . '/activate', 'POST', $data);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['success'] ?? false;
}

function testLicenseValidation($baseUrl) {
    echo "=== Testing License Validation ===\n";
    
    $response = makeRequest($baseUrl . '/validate/SAHEL-TEST-1234-5678-9012');
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['success'] ?? false;
}

function testListLicenses($baseUrl, $token) {
    echo "=== Testing List Licenses ===\n";
    
    $headers = ['Authorization: Bearer ' . $token];
    $response = makeRequest($baseUrl . '/licenses', 'GET', null, $headers);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['success'] ?? false;
}

function testGetUserInfo($baseUrl, $token) {
    echo "=== Testing Get User Info ===\n";
    
    $headers = ['Authorization: Bearer ' . $token];
    $response = makeRequest($baseUrl . '/me', 'GET', null, $headers);
    
    echo "Status Code: " . $response['status_code'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
    
    return $response['body']['success'] ?? false;
}

// Main test execution
echo "SahelLicenseManager API Test Script\n";
echo "====================================\n\n";

// Test 1: User Registration
$token = testUserRegistration($baseUrl);

// Test 2: User Login (if registration failed, try login)
if (!$token) {
    $token = testUserLogin($baseUrl);
}

// Test 3: License Registration
testLicenseRegistration($baseUrl);

// Test 4: License Activation
testLicenseActivation($baseUrl);

// Test 5: License Validation
testLicenseValidation($baseUrl);

// Test 6: Get User Info (requires authentication)
if ($token) {
    testGetUserInfo($baseUrl, $token);
    
    // Test 7: List Licenses (requires authentication)
    testListLicenses($baseUrl, $token);
} else {
    echo "Skipping authenticated tests - no token available\n\n";
}

echo "Test completed!\n";
echo "Note: Make sure your Laravel application is running on the specified URL.\n";
echo "You can start the development server with: php artisan serve\n";
?>
