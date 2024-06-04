<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Desk;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\AvailableDesk;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;



class BookingController extends Controller
{
    // public function index()
    // {
    //     $today = Carbon::create(Carbon::now()->toDateString()); // set to current day at 12am
    //     foreach(Booking::all() as $booking) {
    //         if ($today->greaterThan(Carbon::create(AvailableDesk::find($booking->available_desk_id)->date))) {
    //             $booking->delete();
    //         }
    //     }
    //     // $today = Carbon::now(); // to be used for sorting out bookings from yesterday to preceding days
    //     return view('bookings.index', [
    //         'cssPaths' => [
    //             'resources/css/main/content.css',
    //         ],
    //         'title' => 'Bookings | ApexHubSpot',
    //         'bookings' => Booking::query()
    //                              ->orderBy('available_desk_id', 'asc')
    //                              ->orderBy('desk_id', 'asc')
    //                              ->paginate(10),
    //     ]);
    // }


  public function index()
    {
        $today = Carbon::create(Carbon::now()->toDateString());

   
        foreach (Booking::all() as $booking) {
            if ($today->greaterThan(Carbon::create(AvailableDesk::find($booking->available_desk_id)->date))) {
                $booking->delete();
            }
        }

  
        $auto_accept_setting = Setting::where('key', 'auto_accept')->first();
        $auto_accept = $auto_accept_setting ? $auto_accept_setting->value : 0;

        return view('bookings.index', [
            'cssPaths' => [
                'resources/css/main/content.css',
            ],
            'title' => 'Bookings | ApexHubSpot',
            'bookings' => Booking::query()
                ->orderBy('available_desk_id', 'asc')
                ->orderBy('desk_id', 'asc')
                ->paginate(10),
            'auto_accept' => $auto_accept,
        ]);
    }

   public function toggleAutoAccept(Request $request)
       {
           $auto_accept = $request->input('auto_accept');

     
           Setting::updateOrCreate(
               ['key' => 'auto_accept'],
               ['value' => $auto_accept]
           );

         
           if ($auto_accept == 1) {
               Booking::where('status', 'pending')->update(['status' => 'accepted']);
           }

           return redirect()->back()->with('message', 'Auto Accept setting updated.');
       }
   



    public function profile()
    {
        return view('profile', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
                'resources/css/main/faqs.css',
                'resources/css/main/guide.css',
            ],
            'title' => 'Profile | ApexHubSpot',
            'bookings' => Booking::query()->where('user_id', auth()->id())
                                          ->orderBy('available_desk_id', 'asc')
                                          ->orderBy('desk_id', 'asc')
                                          ->paginate(5),
        ]);
    }

   

    public function book(Request $request, AvailableDesk $available_desk)
{
    $desk_id = $available_desk->desk_id;
    $date = $request->input('date');

   
    if (Desk::find($desk_id)->is_out_of_order == 1) {
        return back()->with('error', 'The desk is out of order!');
    }

   
    $booked_by_user = Booking::where('user_id', auth()->id())
        ->where('date', $date)
        ->first();
    
  
    $booked_by_other = Booking::where('available_desk_id', $available_desk->id)
        ->first();

    $today = Carbon::now()->format('Y-m-d');
         if ($date == $today) {
         Desk::where('id', $desk_id)->update(['is_available' => 0]);
         }

    if ($booked_by_user) {
        return back()->with('error', 'You have already booked a desk for this day.');
    } elseif ($booked_by_other) {
        return back()->with('error', 'Someone booked this already, try another desk.');
    }

    $auto_accept_setting = \App\Models\Setting::where('key', 'auto_accept')->value('value');
    $auto_accept = $auto_accept_setting == 1 || $date == $today;
    $status = $auto_accept ? 'accepted' : 'pending';

  
    Booking::create([
        'date' => $date,
        'user_id' => auth()->user()->id,
        'desk_id' => $desk_id,
        'available_desk_id' => $available_desk->id,
        'auto_accept' => $auto_accept,
        'status' => $status,
    ]);

    if ($auto_accept) {
        return redirect('/dashboard')->with('message', 'Your booking has been automatically accepted for ' . $available_desk->date . '!');
    }

    return redirect('/dashboard')->with('message', 'Your booking is pending and needs to be accepted by an admin.');
}
    // public function acceptBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $booking->status = 'accepted';
    //     $booking->save();

    //     return response()->json(['message' => 'Booking accepted successfully']);
    // }

    public function destroy(Booking $booking)
    {
        $today = Carbon::now()->toDateString();
        $book_date = AvailableDesk::find($booking->available_desk_id)->date;
        if($today == $book_date){
            return back()->with('error','The booking is currently on going!');
        }
        $booking->delete(); 
        return redirect('/bookings')->with('message', 'Update: Booking canceled!');
    }


    public function destroy_self(Booking $booking)
    {
        $today = Carbon::now()->toDateString();
        $book_date = AvailableDesk::find($booking->available_desk_id)->date;
        if($today == $book_date){
            return back()->with('error','The booking is currently on going!');
        }
        $booking->delete();
        return redirect('/dashboard')->with('message', 'Update: One of your bookings is canceled!');
    }



     public function getBookingsData()
    {
        $today = Carbon::today();
        $startDate = $today->subDays(13); // Last 14 days

        $bookingsData = DB::table('bookings')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, Carbon::now()])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        $dates = [];
        $counts = [];

        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::today()->subDays(13 - $i)->toDateString();
            $dates[] = $date;
            $count = $bookingsData->firstWhere('date', $date)->count ?? 0;
            $counts[] = $count;
        }

        return response()->json(['dates' => $dates, 'counts' => $counts]);
    }


      public function adminIndex()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('bookings.admin', compact('bookings'));
    }

  
    public function acceptBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        return back()->with('message', 'Booking accepted successfully');
    }

    // public function rejectBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $booking->status = 'rejected';
    //     $booking->save();

    //     return back()->with('message', 'Booking rejected successfully');
    // }
}
