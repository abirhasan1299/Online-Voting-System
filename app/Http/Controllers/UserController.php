<?php

namespace App\Http\Controllers;

use App\Models\Election;
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
        $election =Election::all();

        return view('user.home', compact('election'));
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
            return redirect()->route('user.home')->with('success', 'You are logged in');
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
