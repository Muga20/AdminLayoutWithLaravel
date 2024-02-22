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
                                <h4 class="card-title"> Create Gallery Form </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form class="forms-sample" action="{{ route('storeGallery') }}"  method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputName1">Gallery Name </label>
                                        <input id="exampleInputName1" type="text" class="form-control"
                                         placeholder="_ _" name="name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="imageUpload">File upload</label>

                                        <div id="dropArea" class="drop-area">

                                            <input type="file" class="file-input visually-hidden"  name="image[]"
                                                   id="imageUpload" value="{{ old('image') }}" multiple>
                                            <label for="imageUpload" class="custom-file-upload">
                                                <i class="fas fa-cloud-upload-alt"></i> Choose File less than 1mb
                                            </label>
                                        </div>

                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
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
