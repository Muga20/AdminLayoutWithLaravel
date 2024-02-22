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
                                <h4 class="card-title">Update Blogs Form </h4>
                                <p class="card-description">
                                    Create Blogs
                                </p>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form class="forms-sample" action="{{ route('updateEvents', $event->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputName1">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputName1"
                                            placeholder="Title" value="{{ $blog->title }}">

                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            id="exampleInputEmail3" placeholder="description"
                                            value="{{ $blog->description }}" />

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleSelectGender">Category</label>
                                        <select class="form-control" name="category_id" id="exampleSelectGender"
                                            value="{{ $blog->category }}">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            {{-- The $attributeValue field is/must be $validationRule --}}
                                            <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>File upload</label>

                                        <div class="input-group col-xs-12">
                                            <input type="file" class="form-control file-upload-info" name="image"
                                                id="exampleFormControlFile1" value="{{ $blog->image }}">

                                        </div>


                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}
                                        </div>
                                    @enderror




                                    <div class="form-group">
                                        <label for="exampleTextarea1">Write Your Content Here</label>
                                        <textarea class="form-control " name="body" id="exampleTextarea1" rows="4" value="{{ $blog->body }}"></textarea>

                                        @error('body')
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
    </div>

    @include('user.include.scripts')
</body>

</html>
