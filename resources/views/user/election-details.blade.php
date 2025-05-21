@extends('master.user')
@section('title',"Election | Details")

@section('content')
    <style>
        .blinking-warning {
            animation: blinkText 1s steps(5, start) infinite;
        }

        @keyframes blinkText {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease-in-out;
        }
        .card-title {
            font-size: 1.25rem;
        }
    </style>
    <h2 class="text-center mt-4 display-4">{{ $election->title }}</h2>
    <p class="text-muted text-center mb-5 ">{{ $election->description }}</p>
    <p class="text-center mb-5 blinking-warning" style="color:red;font-weight: bolder;">**For stability Once you voted, you can't undo it. So decide first then vote**</p>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="mb-4">Candidates</h4>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @forelse($election->candidates as $candidate)
                <div class="col">
                    <div class="card h-100 shadow border-0 rounded-4 overflow-hidden">
                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="card-img-top object-fit-cover" alt="{{ $candidate->name }}" style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $candidate->name }}</h5>
                            <p class="card-text text-secondary small">{{$candidate->description }}</p>
                        </div>

                        <div class="card-footer bg-white border-0 text-end" >

                            @if(!$voted)
                                <form action="{{route('user.vote-taken')}}" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" value="{{$election->id}}" name="election_id">
                                    <input type="hidden" value="{{$candidate->id}}" name="candidate_id">
                                    <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 50%;"><i class="bi bi-mailbox-flag"></i> Vote</button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No candidates found for this election.</p>
            @endforelse
        </div>
    </div>

@endsection
