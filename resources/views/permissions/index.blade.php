<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Permission</title>
    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
    @vite('resources/css/app.css')
</head>

<body>
    @include('nav-link')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Pemissions <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add
                                New Permission</a></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>
                                        <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-warning">Edit</a>
                                        <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-danger mx-2">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
