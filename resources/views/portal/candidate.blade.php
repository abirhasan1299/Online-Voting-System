@extends("master.admin")
@section("title","Candidate|List")
@section("content")
<div class="container mt-5">
    @if (session('candidate-success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('candidate-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">

        <div style="margin-bottom: 10px;">
            <a href="{{route('candidates.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Candidate</a>
        </div>

        <table class="table table-bordered  table-hover text-center" >
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Election</th>
                <th>Action</th>
            </tr>
            <tbody>
            @php
                $count=1;
            @endphp
            @foreach($data as $val)

                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$val->name}}</td>
                    <td>
                        <img src="{{asset('storage/'.$val->photo)}}" style="width: 100px;height: 100px;" alt="">
                    </td>
                    <td>{{$val->election->title}}</td>
                    <td>
                        <a href="#" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="btn btn-warning"><i class="bi bi-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
