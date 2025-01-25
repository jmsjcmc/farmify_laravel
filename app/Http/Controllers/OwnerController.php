<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmJob;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmJobApplication;


class OwnerController extends Controller
{
    public function viewDashboard()
    {
        return view('owner.owner-dashboard');
    }

    public function viewFarmManagement()
    {
        return view('owner.farm-management.farm-management');
    }
    public function viewJobManagement()
    {
        $jobs = FarmJob::where('farm_owner_id', Auth::user()->farmOwner->id)
        ->with(['applications'])
        ->get();

    $applications = FarmJobApplication::whereHas('job', function ($query) {
            $query->where('farm_owner_id', Auth::user()->farmOwner->id);
        })
        ->with([
            'applicant' => function($query) {
                $query->role('Consumer');
            },
            'job'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('owner.job-management.job-management', compact('jobs', 'applications'));
    }

    public function addJobForFManager(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_type' => 'required|string|in:Farm Manager,Laborer',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'salary_from' => 'required|numeric|min:0',
            'salary_to' => 'required|numeric|gte:salary_from',
            'salary_type' => 'required|string|in:Per Hour,Per Day,Per Month',
            'employment_type' => 'required|string|in:Full-time,Part-time,Contract',
            'vacancies' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'location' => 'required|string',
            'benefits' => 'nullable|string',
        ]);


        $validated['farm_owner_id'] = Auth::user()->farmOwner->id;
        $job = FarmJob::create($validated);

        return redirect()->route('owner.job-management')
            ->with('success', 'Job listing created successfully');
    }

    public function updateStatus(Request $request, FarmJob $job)
    {

        $validated = $request->validate([
            'status' => 'required|string|in:Active,Closed,Draft'
        ]);


        if ($job->farm_owner_id !== Auth::user()->farmOwner->id) {
            return response()->json([
                'message' => 'Unauthorized action.'
            ], 403);
        }


        $job->update([
            'status' => $validated['status']
        ]);

        return response()->json([
            'message' => 'Job status updated successfully',
            'status' => $job->status
        ]);
    }

    // Farm Owner View Resume functions
    public function viewResume(FarmJobApplication $application)
    {
        if ($application->job->farm_owner_id !== Auth::user()->farmOwner->id) {
            abort(403);
        }
        $path = storage_path('app/public/' . $application->resume_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
