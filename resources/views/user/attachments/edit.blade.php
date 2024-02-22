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
                                <h4 class="card-title"> Edit Tag Form </h4>
                                <p class="card-description">
                                  
                                </p>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form class="forms-sample" action="{{ route('updateTag', $tag->id) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputName1">Tag Name </label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                      placeholder="Name" name="name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
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
    </div>
   
    
   @include("user.include.scripts")

</body>

</html>
