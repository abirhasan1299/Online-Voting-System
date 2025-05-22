@extends('master.admin')
@section("title","Admin | Election")
@section("content")
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">

            <div style="margin-bottom: 10px;">
                <a href="{{route('new-election')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Election</a>
            </div>

            <table class="table table-bordered  table-hover text-center" >
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tbody>
                @php
                    $count=1;
                @endphp
                @foreach($elections as $election)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$election->title}}</td>
                        <td>{{$election->start_date->diffForHumans()}}</td>
                        <td>{{$election->end_date->diffForHumans()}}</td>
                        <td><span class="badge rounded-pill text-bg-@php
                        if($election->status=="pending")
                            {
                                echo "danger";
                            }elseif ($election->status=="running")
                            {
                                echo "warning";
                            }else{
                            echo "success";
                            }

                        @endphp">{{$election->status}}</span></td>
                        <td>
                            <a href="#" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="btn btn-warning"><i class="bi bi-eye"></i></a>
                            <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                <div>
                    {{$elections->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
