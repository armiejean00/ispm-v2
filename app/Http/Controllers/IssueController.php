<?php

namespace App\Http\Controllers;

use App\Mail\IssueReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class IssueController extends Controller
{
    public function reportIssue(Request $request)
    {
        $request->validate([
            'issue' => 'required|string|max:255',
            'details' => 'required|string',
            'photo' => 'nullable|image|max:2048', 
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('issue_photos');
        }

      
        $username = auth()->user()->username;
        $role = auth()->user()->role;

   
        $officeManagers = User::where('role', 'office_manager')->pluck('email');

        // Send email to all office managers
        foreach ($officeManagers as $email) {
            Mail::to($email)->send(new IssueReportMail(
                $request->issue,
                $request->details,
                $photoPath,
                $username,
                $role
            ));
        }

        return back()->with('success', 'Issue report submitted successfully!');
    }
}