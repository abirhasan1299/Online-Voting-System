@extends("master.admin")
@section("title","Admin  |Update-Candidate")

@section("content")
    <div class="container mt-4">
        <div class="card shadow-md rounded-4" style="width:50%;margin: auto;">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Update Candidate</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>There were some problems:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{route('candidates.update',[Hashids::encode($data->id)])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-center">
                        <div class="mb-3">
                            <img src="{{asset('storage/'.$data->photo)}}" style="width: 100px;height: 100px;"  alt="Candidate Image">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Candidate Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{$data->name}}">
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Candidate Image</label>
                        <input type="file" class="form-control" id="photo" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="election_id" class="form-label">Election</label>
                        <select class="form-select" id="election_id" name="election_id" required>
                            <option value="{{$data->election->id}}"  selected>{{$data->election->title}}</option>
                            @foreach($elections as $election)
                                <option value="{{ $election->id }}">{{ $election->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" >{{$data->description}}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
