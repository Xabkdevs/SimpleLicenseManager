<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    /**
     * Register a license with user information
     * POST /api/register
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'license_key' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'os' => 'required|string|max:255',
            'additional_data' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $license = License::updateOrCreate(
                ['license_key' => $request->license_key],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'brand_name' => $request->brand_name,
                    'phone' => $request->phone,
                    'os' => $request->os,
                    'additional_data' => $request->additional_data,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'License registered successfully',
                'data' => [
                    'license_key' => $license->license_key,
                    'status' => $license->status,
                    'user_info' => [
                        'first_name' => $license->first_name,
                        'last_name' => $license->last_name,
                        'brand_name' => $license->brand_name,
                        'phone' => $license->phone,
                        'os' => $license->os,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register license',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activate a license
     * POST /api/activate
     */
    public function activate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'license_key' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $license = License::where('license_key', $request->license_key)->first();

            if (!$license) {
                return response()->json([
                    'success' => false,
                    'message' => 'License not found'
                ], 404);
            }

            if ($license->isExpired()) {
                return response()->json([
                    'success' => false,
                    'message' => 'License has expired'
                ], 400);
            }

            $license->update(['status' => 'active']);

            return response()->json([
                'success' => true,
                'message' => 'License activated successfully',
                'data' => [
                    'license_key' => $license->license_key,
                    'status' => $license->status,
                    'expires_at' => $license->expires_at,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate license',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate a license
     * GET /api/validate/{license_key}
     */
    public function validateLicense(string $licenseKey): JsonResponse
    {
        try {
            $license = License::where('license_key', $licenseKey)->first();

            if (!$license) {
                return response()->json([
                    'success' => false,
                    'message' => 'License not found'
                ], 404);
            }

            $isActive = $license->isActive();
            $isExpired = $license->isExpired();

            return response()->json([
                'success' => true,
                'status' => $isActive ? 'active' : ($isExpired ? 'expired' : 'inactive'),
                'expires_at' => $license->expires_at,
                'user_info' => [
                    'first_name' => $license->first_name,
                    'last_name' => $license->last_name,
                    'brand_name' => $license->brand_name,
                    'phone' => $license->phone,
                    'os' => $license->os,
                    'additional_data' => $license->additional_data,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to validate license',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * List all licenses (admin use)
     * GET /api/licenses
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = License::query();

            // Filter by status if provided
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Search by license key, name, or brand
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('license_key', 'like', "%{$search}%")
                      ->orWhere('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('brand_name', 'like', "%{$search}%");
                });
            }

            $licenses = $query->orderBy('created_at', 'desc')->paginate(15);

            return response()->json([
                'success' => true,
                'data' => $licenses
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve licenses',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
