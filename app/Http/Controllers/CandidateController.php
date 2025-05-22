<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Candidate::orderBy('id', 'DESC')->paginate(10);
        return view('portal.candidate',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Election::all();
        return view('portal.CandidateMaker',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'election_id'=>'required|exists:elections,id',
            'name'=>'required|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description'=>'required|min:50'
        ]);
        $imagePath = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('candidates', $imageName, 'public');
        }

        $candidate = new Candidate();
        $candidate->election_id = $request->election_id;
        $candidate->name = $request->name;
        $candidate->photo = $imagePath;
        $candidate->description = $request->description;

        $candidate->save();

        return redirect()->route('candidates.index')->with('candidate-success','Candidate added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decode = Hashids::decode($id);
        if(empty($decode)) abort(404);
        $data = Candidate::with('election')->findOrFail($decode[0]);
        $elections = Election::all();

        return view('portal.candidate-edit',compact('data','elections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decode = Hashids::decode($id);
        if(empty($decode)) abort(404);

        $request->validate([
            'election_id'=>'required|exists:elections,id',
            'name'=>'required|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description'=>'required|min:50'
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('candidates', $imageName, 'public');
        }

        $candidate = Candidate::findOrFail($decode[0]);

        $candidate->election_id = $request->election_id;
        $candidate->name = $request->name;

        if($request->file('image')!=null) $candidate->photo=$imagePath;

        $candidate->description = $request->description;

        $candidate->save();
        return redirect()->route('candidates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $decode = Hashids::decode($id);
        if(empty($decode)) abort(40);

        $candidate = Candidate::findOrFail($decode[0]);
        $candidate->delete();
        return redirect()->route('candidates.index');
    }
}
