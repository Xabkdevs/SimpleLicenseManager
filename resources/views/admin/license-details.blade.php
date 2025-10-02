<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Details - SahelLicenseManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.licenses') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Licenses
            </a>
        </div>

        <!-- License Details -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">License Details</h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        @if($license->status === 'active') bg-green-100 text-green-800
                        @elseif($license->status === 'inactive') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($license->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">License Key</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-100 p-2 rounded">{{ $license->license_key }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">First Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->first_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->last_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Brand Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->brand_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Operating System</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->os }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Status and Dates -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status & Dates</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Current Status</dt>
                                <dd class="mt-1">
                                    <form method="POST" action="{{ route('admin.license.update-status', $license->id) }}" class="inline">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                            <option value="inactive" {{ $license->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="active" {{ $license->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="expired" {{ $license->status === 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                    </form>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->created_at->format('F d, Y \a\t g:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->updated_at->format('F d, Y \a\t g:i A') }}</dd>
                            </div>
                            @if($license->expires_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Expires At</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $license->expires_at->format('F d, Y \a\t g:i A') }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Additional Data -->
                @if($license->additional_data)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Data</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <pre class="text-sm text-gray-700">{{ json_encode($license->additional_data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
                @endif

                <!-- API Testing Section -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">
                        <i class="fas fa-code mr-2"></i>API Testing
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-blue-800 mb-2">Validate License:</h4>
                            <div class="flex items-center space-x-2">
                                <code class="bg-blue-100 px-2 py-1 rounded text-sm flex-1">
                                    GET {{ url('/api/validate/' . $license->license_key) }}
                                </code>
                                <button onclick="testValidation()" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                    Test
                                </button>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-blue-800 mb-2">Activate License:</h4>
                            <div class="flex items-center space-x-2">
                                <code class="bg-blue-100 px-2 py-1 rounded text-sm flex-1">
                                    POST {{ url('/api/activate') }}
                                </code>
                                <button onclick="testActivation()" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                    Test
                                </button>
                            </div>
                        </div>
                        <div id="api-result" class="mt-4 hidden">
                            <h4 class="font-medium text-blue-800 mb-2">API Response:</h4>
                            <pre id="api-response" class="bg-gray-100 p-3 rounded text-sm overflow-x-auto"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function testValidation() {
            fetch('{{ url("/api/validate/" . $license->license_key) }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('api-result').classList.remove('hidden');
                    document.getElementById('api-response').textContent = JSON.stringify(data, null, 2);
                })
                .catch(error => {
                    document.getElementById('api-result').classList.remove('hidden');
                    document.getElementById('api-response').textContent = 'Error: ' + error.message;
                });
        }

        function testActivation() {
            fetch('{{ url("/api/activate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    license_key: '{{ $license->license_key }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('api-result').classList.remove('hidden');
                document.getElementById('api-response').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                document.getElementById('api-result').classList.remove('hidden');
                document.getElementById('api-response').textContent = 'Error: ' + error.message;
            });
        }
    </script>
</body>
</html>
