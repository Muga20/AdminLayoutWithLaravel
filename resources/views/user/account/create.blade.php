<!DOCTYPE html>
<html lang="en">
@include('user.include.header')

<body>

    <div class="container-scroller">

        @include('user.layouts.nav')
        @include('user.layouts.skin')
        @include('user.layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Create Account For User  </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form class="forms-sample"  action=" {{ route('storeUser') }}"
                                    method="post"
                                   >
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleSelectGender">Role</label>
                                        <select class="form-control" name="role" id="exampleSelectGender">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputName1">  Names </label>
                                        <input id="exampleInputName1" type="text" class="form-control"
                                         placeholder="test" name="name">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                    <div class="form-group">
                                        <label for="exampleInputName1"> Email </label>
                                        <input id="exampleInputName1" type="email" class="form-control"
                                         placeholder="example@gmail.com" name="email" >
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                    <div class="form-group">
                                        <label for="exampleInputName1"> Password </label>
                                        <input id="exampleInputName1" type="password" class="form-control"
                                         placeholder="********" name="password">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="exampleInputName1"> Confirm Password </label>
                                        <input id="exampleInputName1" type="password" class="form-control"
                                         placeholder="********" name="password_confirmation">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.include.scripts')

</body>

</html>
