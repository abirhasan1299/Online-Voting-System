<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body{
            overflow-x: hidden;
            font-family: "TechFont";
        }
        .btn{
            border-radius:0px;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">eVote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('portal.home')}}"><i class="bi bi-house-door"></i>  Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('candidates.index')}}"><i class="bi bi-people"></i> Candidates</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route("election.home")}}" ><i class="bi bi-mailbox2-flag"></i> Elections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" ><i class="bi bi-pc-display-horizontal"></i>  Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" ><i class="bi bi-person-arms-up"></i>  Users</a>
                </li>
            </ul>
            <div class="d-flex" >
                <a href="#" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    @yield("content")
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>
