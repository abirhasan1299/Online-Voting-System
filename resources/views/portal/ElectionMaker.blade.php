@extends("master.admin")
@section("title","Admin|Create-Election")

@section("content")

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-4">
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
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create a New Election</h4>
                </div>
                <div class="card-body">
                    <form id="electionForm" method="post" action="{{route('save-election')}}"  autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Election Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter election title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the election (optional)"></textarea>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="end_date" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Create Election</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
