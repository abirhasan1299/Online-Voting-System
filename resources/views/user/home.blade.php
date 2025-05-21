@extends('master.user')
@section("title","Home")

@section("content")
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="d-flex justify-content-between">
                <div>
{{--                    <p class="display-4">Elections</p>--}}
                </div>
                <div>
                    <input type="search" class="form-control" placeholder="Search" style="border-radius:0px;">
                </div>
            </div>
        </div>
            <br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($election as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('images/vote.jpg') }}" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h3 class="card-title" style="font-weight: bolder;">{{ $item->title }}</h3>
                                <p class="card-text" style="color:grey;">{{ Str::limit($item->description, 100) }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-white border-0">
                                <div>
                                    <a href="{{route('election.details',[Hashids::encode($item->id)])}}" class="btn btn-primary btn-sm">View</a>
                                </div>
                                <div>
                                    <i class="bi bi-hourglass-split" style="color:rgba(255,38,0,0.75);">  End: </i>  {{$item->end_date->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
