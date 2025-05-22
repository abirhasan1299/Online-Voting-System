@extends('master.user')
@section('title',"Edit-Profile")
@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top">
                <h4 class="mb-0">Create Profile</h4>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body p-4">
                <form action="{{route('user.profile-updated')}}" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input class="form-control" type="file" name="photo" id="photo" accept="image/*" >
                    </div>

                    <div class="mb-3">
                        <label for="nid_no" class="form-label">NID Number</label>
                        <input type="number" name="nid_no" id="nid_no" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender" required>
                            <option selected disabled>Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="present_address" class="form-label">Present Address</label>
                        <textarea name="present_address" id="present_address" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <textarea name="permanent_address" id="permanent_address" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" name="profession" id="profession" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="educational_qualification" class="form-label">Educational Qualification</label>
                            <input type="text" name="educational_qualification" id="educational_qualification" class="form-control" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-success px-4" type="submit">Update Profile</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
