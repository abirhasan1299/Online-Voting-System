@extends('master.user')
@section('title','Election | Result')
@section("content")
    <h2>Election Results</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($candidates as $candidate)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('storage/'.$candidate->photo)}}" class="card-img-top" alt="candidate image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $candidate->name }}</h5>
                        <p class="card-text">
                            {{ $candidate->bio ?? 'No bio provided.' }}<br>
                            <strong>Votes:</strong> {{ $candidate->vote_count }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p>No candidates found for this election.</p>
        @endforelse
    </div>

@endsection
