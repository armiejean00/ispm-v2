<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Desk;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\AvailableDesk;
use Illuminate\Validation\Rule;

class DeskController extends Controller
{
    public function index()
    {
        return view('desks.index', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
            ],
            'title' => 'Manage Desks | ApexHubSpot',
            'desks' => Desk::orderBy('desk_number', 'asc')->paginate(10)
        ]);
    }

   

    

    // Show create form
    public function create()
    {
        return view('desks.create', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
            ],
            'title' => 'Create Desk | ApexHubSpot',
        ]);
    }

    // Store item data
   public function store(Request $request)
{
    $formFields = $request->validate([
        'desk_number' => ['required', Rule::unique('desks', 'desk_number')],
        'is_out_of_order' => 'required',
        'amenities' => 'array', 
        'amenities.*' => 'string', 
        'area' => 'nullable|string'
    ]);

    $formFields['amenities'] = json_encode($request->amenities); 

    $desk = Desk::create($formFields);

    $date = Carbon::now();
    for ($i = 1; $i <= 14; $i++) {
        AvailableDesk::create([
            'date' => $date->toDateString(),
            'desk_id' => $desk->id,
        ]);
        $date->addDays(1);
    }

    return redirect('/desks')->with('success', 'Update: Desk created!');
}
    // Delete desk
    public function destroy(Desk $desk)
    {
        $desk_number = $desk->desk_number;
        $desk->delete();
        return redirect('/desks')->with('message', 'Update: Desk ' . $desk_number . ' deleted!');
    }

    // Switch is_out_of_order
    public function availability(Desk $desk)
    {
        if ($desk->is_out_of_order === 0) {
            Booking::where('desk_id', $desk->id)->delete();
            $desk->update(['is_out_of_order' => 1]);
            return back()->with('message', 'Update: Desk' . $desk->desk_number . ' CLOSED for booking!');
        } elseif ($desk->is_out_of_order === 1) {
            $desk->update(['is_out_of_order' => 0]);
            return back()->with('success', 'Update: Desk' . $desk->desk_number . ' OPEN for booking!');
        }
    }


 public function availableDesks()
{
    // Fetch all desks
    $desks = Desk::paginate(10);

    return view('availabledesks', [
        'cssPaths' => [
            'resources/css/main/content.css',
            'resources/css/main/content2.css',
        ],
        'title' => 'Available Desk | ApexHubSpot',
        'desks' => $desks
    ]);
}

}
