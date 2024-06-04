<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class UserController extends Controller
{
    // Show all users
    public function index() {
        return view('users.index', [
            'cssPaths' => [
                'resources/css/main/content.css',
            ],
            'title' => 'Manage Users | ApexHubSpot',
            'users' => User::latest()->filter(request(['search']))->paginate(10)
        ]);
    }

    // Show single user
    // public function show(User $user) {
    //     return view('users.show', [
    //         'cssPaths' => [
    //             'resources/css/main/content.css',
    //             'resources/css/main/content2.css',
    //         ],
    //         'title' => 'User | ApexHubSpot',
    //         'user' => $user
    //     ]);
    // }

    // Show create form
    public function create() {
        return view('users.create', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
            ],
            'title' => 'Create User | ApexHubSpot',
        ]);
    }

    // Store item data
    public function admin_store(Request $request) {
        $formFields = $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users', 'username')],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => [
                'required',
                Password::min(10)->letters()
                                ->mixedCase()
                                ->numbers()
                                ->symbols()
                                ->uncompromised()
            ],
            'role' => 'required',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        User::create($formFields);

        return redirect('/users')->with('success', 'Update: User created!');
    }

    // Show edit form
    public function edit(User $user) {
        return view('users.edit', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
            ],
            'title' => "Edit" . $user->username . "'s Profile | ApexHubSpot",
            'user' => $user,
        ]);
    }

    // Update item data
    public function update(Request $request, User $user) {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin') {
            $formFields = $request->validate([
                'username' => ['required', 'min:3', Rule::unique('users', 'username')],
                'first_name' => 'required',
                'last_name' => 'required',
                'role' => 'required',
                // 'email' => ['required', 'email'],
                // 'password' => 'required',
            ]);

            $user->update($formFields);
 return redirect('/users')->with('message', 'Update: User edited!');
           
        } else {
            return back()->with('error', 'Error: You cannot do that!');
        }
    }

    // Delete item
    public function destroy(User $user) {
        $user->delete();
        return redirect('/users')->with('message', 'Update: User deleted!');
    }

    // Switch is_approve
    public function approve(User $user) {
        $message = '';
        if ($user->is_approved === 0) {
            $user->update(['is_approved' => 1]);
            return back()->with('sucess', 'Update: User approved!');
        } elseif ($user->is_approved === 1) {
            $user->update(['is_approved' => 0]);
            return back()->with('message', 'Update: User put on hold!');
        }
    }

    // Register form
    public function register() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users', 'username')],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'confirmed',
                Password::min(10)->letters()
                                ->mixedCase()
                                ->numbers()
                                ->symbols()
                                ->uncompromised()
            ],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Creates user
        $user = User::create($formFields);

        return redirect('/hold');
    }

    // Logout
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Sign in form
    public function sign_in() {
        return view('users.sign_in');
    }

   public function authenticate(Request $request) {
    $formFields = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if(auth()->attempt($formFields)) {
        $request->session()->regenerate();

        if(auth()->user()->is_approved == 0) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/hold');
        }

        $otp = rand(100000, 999999);
        $user = auth()->user();

     
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'otp' => Hash::make($otp),
                'otp_expires_at' => Carbon::now()->addMinutes(10),
            ]);

       
        Mail::to($user->email)->send(new OTPMail($otp));

        return redirect('/verify-otp')->with('success', 'OTP has been sent to your email!');
    }

    return back()->withErrors(['username' => 'Invalid credentials!'])->onlyInput('username');
}
    public function hold() {
        return view('users.hold');
    }

public function editProfile() {
    return view('profile.customize', ['user' => auth()->user(),
 
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
            ],
            'title' => 'Update User | ApexHubSpot',
           
        ]);
    
}



public function updateProfile(Request $request) {
    $user = auth()->user();

  
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'username' => 'required|string|max:255',
         'bio' => 'nullable|string|max:255'
    ]);

    

    try {
     
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                 'bio' => $validatedData['bio'],
                'updated_at' => now(), 
            ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');


        
    } catch (\Exception $e) {
     
        return back()->with('error', 'Error: Profile could not be updated.');
    }
}


  public function updateProfileImage(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

   
    if ($request->hasFile('profile_image')) {
      
        if ($user->profile_image && $user->profile_image != 'default.jpg') {
            $oldImagePath = storage_path('app/public/profile_images/' . $user->profile_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

      
        $file = $request->file('profile_image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

     
        DB::table('users')
            ->where('id', $user->id)
            ->update(['profile_image' => $filename]);
    }

    return back()->with('success', 'Profile image updated successfully!');
}

public function showVerifyOtpForm() {
    return view('auth.verify-otp');
}

public function verifyOtp(Request $request) {
    $request->validate([
        'otp' => 'required|numeric',
    ]);

    $user = auth()->user();

  
    $otpExpiresAt = Carbon::parse($user->otp_expires_at);

    if ($otpExpiresAt->isPast()) {
        return redirect('/login')->withErrors(['otp' => 'OTP has expired. Please login again.']);
    }

    if (Hash::check($request->otp, $user->otp)) {
    
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'otp' => null,
                'otp_expires_at' => null,
            ]);

        return redirect('/dashboard')->with('success', 'You are now logged in!');
    }

    return back()->withErrors(['otp' => 'Invalid OTP.']);
}
}
