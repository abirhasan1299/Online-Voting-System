@extends('master.user')
@section('title',"Profile")
@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header bg-primary text-white text-center rounded-top">
                <h4 class="mb-0">User Profile</h4>
            </div>
            <div class="card-body p-4">

                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        @if(!empty($profile->photo))
                            <img src="{{asset('storage/'.$profile->photo)}}" alt="User Photo" class="img-fluid rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                                <span class="text-muted">No Photo</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>First Name</th>
                                <td>{{$profile->fname}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{$profile->lname}}</td>
                            </tr>
                            <tr>
                                <th>NID Number</th>
                                <td>{{$profile->nid_no}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{$profile->gender}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Present Address</th>
                                <td>{{$profile->present_address}}</td>
                            </tr>
                            <tr>
                                <th>Permanent Address</th>
                                <td>{{$profile->permanent_address}}</td>
                            </tr>
                            <tr>
                                <th>Profession</th>
                                <td>{{$profile->profession}}</td>
                            </tr>
                            <tr>
                                <th>Educational Qualification</th>
                                <td>{{$profile->educational_qualification}}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{$profile->created_at->diffForHumans()}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="text-end">
                            <a href="{{route('user.profile-edit')}}" class="btn btn-warning">Update  Profile</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
