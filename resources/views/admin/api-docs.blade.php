<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - SahelLicenseManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-key mr-2"></i>
                    <h1 class="text-xl font-bold">SahelLicenseManager</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.licenses') }}" class="hover:text-blue-200">
                        <i class="fas fa-list mr-1"></i> All Licenses
                    </a>
                    <a href="{{ route('admin.api-docs') }}" class="hover:text-blue-200">
                        <i class="fas fa-code mr-1"></i> API Docs
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">API Documentation</h2>
            <p class="mt-2 text-gray-600">Complete REST API documentation for SahelLicenseManager</p>
        </div>

        <!-- Quick Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h3 class="font-medium text-blue-900">Base URL</h3>
                    <code class="text-blue-800">{{ $baseUrl }}</code>
                </div>
                <div>
                    <h3 class="font-medium text-blue-900">Authentication</h3>
                    <span class="text-blue-800">Bearer Token (Sanctum)</span>
                </div>
                <div>
                    <h3 class="font-medium text-blue-900">Content Type</h3>
                    <span class="text-blue-800">application/json</span>
                </div>
            </div>
        </div>

        <!-- Table of Contents -->
        <div class="bg-white shadow rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Table of Contents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-medium text-gray-800 mb-2">Authentication</h4>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li><a href="#register-user" class="text-blue-600 hover:text-blue-800">Register User</a></li>
                            <li><a href="#login" class="text-blue-600 hover:text-blue-800">Login</a></li>
                            <li><a href="#logout" class="text-blue-600 hover:text-blue-800">Logout</a></li>
                            <li><a href="#me" class="text-blue-600 hover:text-blue-800">Get User Info</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 mb-2">License Management</h4>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li><a href="#register-license" class="text-blue-600 hover:text-blue-800">Register License</a></li>
                            <li><a href="#activate-license" class="text-blue-600 hover:text-blue-800">Activate License</a></li>
                            <li><a href="#validate-license" class="text-blue-600 hover:text-blue-800">Validate License</a></li>
                            <li><a href="#list-licenses" class="text-blue-600 hover:text-blue-800">List Licenses</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Authentication Endpoints -->
        <div class="space-y-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6" id="authentication">Authentication Endpoints</h2>
                    
                    <!-- Register User -->
                    <div class="mb-8" id="register-user">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Register User</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">POST</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/register-user</code>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Request Body</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "name": "Admin User",
  "email": "admin@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@example.com"
    },
    "token": "1|abcdef123456...",
    "token_type": "Bearer"
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('register-user', 'POST', {
                                name: 'Test Admin',
                                email: 'test@example.com',
                                password: 'password123',
                                password_confirmation: 'password123'
                            })" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>

                    <!-- Login -->
                    <div class="mb-8" id="login">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Login</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">POST</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/login</code>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Request Body</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "email": "admin@example.com",
  "password": "password123"
}</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin User",
      "email": "admin@example.com"
    },
    "token": "2|xyz789...",
    "token_type": "Bearer"
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('login', 'POST', {
                                email: 'test@example.com',
                                password: 'password123'
                            })" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- License Management Endpoints -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6" id="license-management">License Management Endpoints</h2>
                    
                    <!-- Register License -->
                    <div class="mb-8" id="register-license">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Register License</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">POST</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/register</code>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Request Body</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "license_key": "{{ $sampleLicenseKey }}",
  "first_name": "John",
  "last_name": "Doe",
  "brand_name": "Johns Restaurant",
  "phone": "+1234567890",
  "os": "Windows 11",
  "additional_data": {
    "restaurant_id": "REST001",
    "location": "New York"
  }
}</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "message": "License registered successfully",
  "data": {
    "license_key": "{{ $sampleLicenseKey }}",
    "status": "inactive",
    "user_info": {
      "first_name": "John",
      "last_name": "Doe",
      "brand_name": "Johns Restaurant",
      "phone": "+1234567890",
      "os": "Windows 11"
    }
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('register', 'POST', {
                                license_key: '{{ $sampleLicenseKey }}',
                                first_name: 'John',
                                last_name: 'Doe',
                                brand_name: 'Test Restaurant',
                                phone: '+1234567890',
                                os: 'Windows 11',
                                additional_data: {
                                    restaurant_id: 'TEST001',
                                    location: 'Test City'
                                }
                            })" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>

                    <!-- Activate License -->
                    <div class="mb-8" id="activate-license">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Activate License</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">POST</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/activate</code>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Request Body</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "license_key": "{{ $sampleLicenseKey }}"
}</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "message": "License activated successfully",
  "data": {
    "license_key": "{{ $sampleLicenseKey }}",
    "status": "active",
    "expires_at": null
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('activate', 'POST', {
                                license_key: '{{ $sampleLicenseKey }}'
                            })" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>

                    <!-- Validate License -->
                    <div class="mb-8" id="validate-license">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Validate License</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">GET</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/validate/{license_key}</code>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">URL Parameters</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{{ $baseUrl }}/validate/{{ $sampleLicenseKey }}</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "status": "active",
  "expires_at": null,
  "user_info": {
    "first_name": "John",
    "last_name": "Doe",
    "brand_name": "Johns Restaurant",
    "phone": "+1234567890",
    "os": "Windows 11",
    "additional_data": {
      "restaurant_id": "REST001",
      "location": "New York"
    }
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('validate/{{ $sampleLicenseKey }}', 'GET')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>

                    <!-- List Licenses -->
                    <div class="mb-8" id="list-licenses">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">List Licenses</h3>
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">GET</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <code class="text-sm">{{ $baseUrl }}/licenses</code>
                            <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Requires Authentication</span>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Query Parameters</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>?status=active&search=John&page=1</code></pre>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Response</h4>
                                <pre class="bg-gray-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "total": 100,
    "per_page": 15
  }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button onclick="testEndpoint('licenses', 'GET', null, true)" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-play mr-2"></i>Test Endpoint
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Responses -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Error Responses</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Validation Error (422)</h3>
                            <pre class="bg-gray-900 text-red-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "license_key": ["The license key field is required."],
    "first_name": ["The first name field is required."]
  }
}</code></pre>
                        </div>
                        
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Not Found (404)</h3>
                            <pre class="bg-gray-900 text-red-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": false,
  "message": "License not found"
}</code></pre>
                        </div>
                        
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Unauthorized (401)</h3>
                            <pre class="bg-gray-900 text-red-400 p-4 rounded-lg text-sm overflow-x-auto"><code>{
  "success": false,
  "message": "Invalid credentials"
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- API Test Results -->
        <div id="api-test-results" class="hidden mt-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">API Test Results</h3>
                    <div class="bg-gray-900 text-green-400 p-4 rounded-lg">
                        <pre id="api-response" class="text-sm overflow-x-auto"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let authToken = null;

        function testEndpoint(endpoint, method, data = null, requiresAuth = false) {
            const url = '{{ $baseUrl }}/' + endpoint;
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            };

            if (requiresAuth && authToken) {
                options.headers['Authorization'] = 'Bearer ' + authToken;
            }

            if (data && method !== 'GET') {
                options.body = JSON.stringify(data);
            }

            fetch(url, options)
                .then(response => response.json())
                .then(data => {
                    // Store token if it's a login response
                    if (endpoint === 'login' && data.success && data.data && data.data.token) {
                        authToken = data.data.token;
                        data.message = data.message + ' (Token stored for authenticated requests)';
                    }
                    
                    showApiResult(data);
                })
                .catch(error => {
                    showApiResult({ error: error.message });
                });
        }

        function showApiResult(data) {
            document.getElementById('api-test-results').classList.remove('hidden');
            document.getElementById('api-response').textContent = JSON.stringify(data, null, 2);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
