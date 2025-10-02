<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $totalLicenses = License::count();
        $activeLicenses = License::where('status', 'active')->count();
        $inactiveLicenses = License::where('status', 'inactive')->count();
        $expiredLicenses = License::where('status', 'expired')->count();
        
        $recentLicenses = License::orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('admin.dashboard', compact(
            'totalLicenses', 
            'activeLicenses', 
            'inactiveLicenses', 
            'expiredLicenses',
            'recentLicenses'
        ));
    }
    
    /**
     * Show all licenses with pagination
     */
    public function licenses(Request $request)
    {
        $query = License::query();
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('license_key', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('brand_name', 'like', "%{$search}%");
            });
        }
        
        $licenses = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.licenses', compact('licenses'));
    }
    
    /**
     * Show license details
     */
    public function showLicense($id)
    {
        $license = License::findOrFail($id);
        return view('admin.license-details', compact('license'));
    }
    
    /**
     * Update license status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,expired'
        ]);
        
        $license = License::findOrFail($id);
        $license->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'License status updated successfully!');
    }
    
    /**
     * Show API documentation page
     */
    public function apiDocs()
    {
        $sampleLicenseKey = License::first()?->license_key ?? 'SAHEL-XXXX-XXXX-XXXX-XXXX';
        $baseUrl = url('/api');
        
        return view('admin.api-docs', compact('sampleLicenseKey', 'baseUrl'));
    }
}
