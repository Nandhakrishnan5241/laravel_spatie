<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h4> Edit User <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('users/' . $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            @error('name')<span class="text-danger">{{$message}}</span>
                                
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            {{-- <input type="text" name="password" class="form-control" value="{{ $user->password }}"> --}}
                            <input type="text" name="password" class="form-control" >
                            @error('password')<span class="text-danger">{{$message}}</span> @enderror

                        </div>
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                <option value="">Select a Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{in_array($role,$userRoles) ? 'selected' : ''}}
                                    >
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')<span class="text-danger">{{$message}}</span> @enderror

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
