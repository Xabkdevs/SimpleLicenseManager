<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SahelLicenseManager - Admin Dashboard</title>
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
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Admin Dashboard</h2>
            <p class="mt-2 text-gray-600">Manage your SAHEL FASTFOOD software licenses</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Licenses -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-key text-blue-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Licenses</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $totalLicenses }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Licenses -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Licenses</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $activeLicenses }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inactive Licenses -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-pause-circle text-yellow-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Inactive Licenses</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $inactiveLicenses }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expired Licenses -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times-circle text-red-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Expired Licenses</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $expiredLicenses }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Licenses -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    <i class="fas fa-clock mr-2"></i>Recent Licenses
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">License Key</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentLicenses as $license)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                    {{ $license->license_key }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $license->first_name }} {{ $license->last_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $license->brand_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($license->status === 'active') bg-green-100 text-green-800
                                        @elseif($license->status === 'inactive') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($license->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $license->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.license.show', $license->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No licenses found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.licenses') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-list mr-2"></i> View All Licenses
                    </a>
                </div>
            </div>
        </div>

        <!-- API Information -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-blue-900 mb-4">
                <i class="fas fa-code mr-2"></i>API Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-medium text-blue-800 mb-2">Base URL:</h4>
                    <code class="bg-blue-100 px-2 py-1 rounded text-sm">{{ url('/api') }}</code>
                </div>
                <div>
                    <h4 class="font-medium text-blue-800 mb-2">Documentation:</h4>
                    <a href="#" class="text-blue-600 hover:text-blue-800 underline">API Documentation</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
