<?php

namespace App\Http\Controllers;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Election;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function Home()
    {

        return view("portal.home");
    }
    public function ElectionResult($id)
    {
        $decode = Hashids::decode($id);
        if(empty($decode)) abort(404);
        $candidates = Candidate::where('election_id',$decode[0])->withCount('vote')->get();

        return view('user.result',compact('candidates'));
    }
    public function ElectionMaker()
    {
        return view('portal.ElectionMaker');
    }
    public function Election()
    {
        $elections = Election::orderBy('id',"DESC")->paginate(10);
        return view('portal.election',compact('elections'));
    }
    public function createElection(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200|min:5',
            'description' => 'required|max:10000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $election = new Election();
        $election->title = $request->title;
        $election->description = $request->description;
        $election->start_date = $request->start_date;
        $election->end_date = $request->end_date;
        $election->save();

        return redirect()->route('election.home')->with('success', 'Election created successfully');
    }
}
