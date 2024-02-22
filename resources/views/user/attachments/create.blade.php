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
                                <h4 class="card-title"> Create Attachment Form </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form class="forms-sample" action="{{ route('storeAttachment') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group pb-1">
                                        <label for="exampleSelectGender">Select A property to Attach with </label>
                                        <select class="form-control" name="property_id" id="exampleSelectGender">
                                            <option selected disabled>Select Property</option>
                                            @foreach ($properties as $property)
                                                <option value="{{ $property->id }}">{{ $property->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                        @error('property_id')
                                            <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                                        @enderror


                                        <div class="form-group">
                                            <label for="exampleInputName1">File  Name </label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                placeholder="_ _" name="filename" value="{{ old('filename') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Upload PDF File</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                name="file">
                                        </div>

                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('pdf_file')
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

    @include('user.include.scripts')

</body>

</html>
