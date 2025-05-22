<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Profile;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;

class UserController extends Controller
{
    public function Home()
    {
        $election =Election::whereNotIn('status',['pending'])->get();

        return view('user.home', compact('election'));
    }
    public function Profile()
    {
        $isExist = Profile::where('user_id',Auth::id())->exists();
        $profile = Profile::where('user_id',Auth::id())->findOrFail(1);

        if($isExist)
        {
            return view('user.profile',compact('profile'));
        }
        else
        {
            return redirect()->route('user.profile-edit');
        }

    }
    public function ProfileEdit()
    {

        return view('user.edit-profile');
    }
    public function ProfileUpdate(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:20',
            'lname' => 'required|string|max:20',
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:2048',
            'nid_no'=>'required|max:20',
            'gender'=>'required|string|max:10',
            'date_of_birth'=>'required|date',
            'present_address'=>'nullable|string',
            'permanent_address'=>'nullable|string',
            'profession'=>'nullable|string',
            'educational_qualification'=>'nullable|string'
        ]);
        $imagePath = null;
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $imageName = uniqid()."_".$image->getClientOriginalName();
            $imagePath = $image->storeAs('usersProfile',$imageName,'public');
        }
        $profile = new Profile();
        $profile->user_id = Auth::id();
        $profile->fname = $request->input('fname');
        $profile->lname = $request->input('lname');
        $profile->photo = $imagePath;
        $profile->nid_no = $request->input('nid_no');
        $profile->gender = $request->input('gender');
        $profile->date_of_birth = $request->input('date_of_birth');
        $profile->present_address = $request->input('present_address');
        $profile->permanent_address = $request->input('permanent_address');
        $profile->profession = $request->input('profession');
        $profile->educational_qualification = $request->input('educational_qualification');
        $profile->save();

        return redirect()->route('user.profile')->with('success','Profile updated successfully');

    }
    public function ElectionDetails($id)
    {
        $decode = Hashids::decode($id);
        if(empty($decode))  abort(404);

        $election = Election::with('candidates')->findOrFail($decode[0]);
        $isVoted = Vote::where('user_id',Auth::id())
                        ->where('election_id',$decode[0])
                        ->exists();

        $voted = ( $isVoted ? true : false);


        return view('user.election-details',compact('election','voted'));
    }

    public function VoteTaken(Request $request)
    {
        $vote = new Vote();
        $vote->election_id = $request->election_id;
        $vote->user_id = Auth::id();
        $vote->candidate_id = $request->candidate_id;
        $vote->save();
        return redirect()->back()->with('success', 'Vote taken successfully');

    }
    public function Login()
    {
        return view('login');
    }

    public function LoginCheck(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credential))
        {
            $request->session()->regenerate();
            $isProfiled = Profile::where('user_id',Auth::id())->exists();
            if(!$isProfiled)
            {
                return redirect()->route('user.profile-edit');
            }else{
                return redirect()->route('user.home')->with('success', 'You are logged in');
            }

        }
        return back()->with('error', 'Invalid email or password');
    }
    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
    public function Registration()
    {
        return view('registration');
    }
    public function RegisterUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('success', 'Registration Successful');
    }
}
