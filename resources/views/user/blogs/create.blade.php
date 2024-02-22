<!DOCTYPE html>
<html lang="en">
@include('user.include.header')

<style>
    .drop-area {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    .highlight {
        background-color: #f0f0f0;
    }
</style>

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
                                <h4 class="card-title">Create Blogs  Form </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form id="blogForm" class="forms-sample"
                                    action="{{ route('storeBlogs') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="section">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                id="exampleInputName1" placeholder="Title" value="{{ old('title') }}">

                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="section" style="display: none;">
                                        <div class="form-group">
                                            <label for="exampleSelectGender">Category</label>
                                            <select class="form-control" name="category_id" id="exampleSelectGender">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleTextarea1">Write Your Description Content Here</label>
                                            <textarea class="form-control"   name="description" id="exampleTextarea1" rows="5"
                                                value="{{ old('description') }}"></textarea>

                                            @error('description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>



                                    <div class="section" style="display: none;">
                                        <div class="form-group">
                                            <label for="exampleTextarea1">Write Your Body Content Here</label>
                                            <textarea class="form-control" id="description"  name="body" id="exampleTextarea1" rows="5"
                                                value="{{ old('body') }}"></textarea>

                                            @error('body')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="section" style="display: none;">
                                        <div class="form-group">
                                            <label for="imageUpload">File upload</label>

                                            <div id="dropArea" class="drop-area">

                                                <input type="file" class="file-input visually-hidden"
                                                    name="image" id="imageUpload" value="{{ old('image') }}"
                                                    multiple>
                                                <label for="imageUpload" class="custom-file-upload">
                                                    <i class="fas fa-cloud-upload-alt"></i> Choose File less than 1mb
                                                </label>
                                            </div>

                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div style="display: flex;">
                                        <button type="button" class="btn btn-primary mr-2"
                                            id="prevBtn">Previous</button>
                                        <button type="button" class="btn btn-primary mr-2"
                                            id="nextBtn">Next</button>
                                        <button type="submit" class="btn btn-primary mr-2" id="submitBtn"
                                            style="display: none;">Submit</button>
                                    </div>


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

    <script>
        // Get the button and the VIP price input field
        const vipButton = document.getElementById('vipButton');
        const vipPriceField = document.getElementById('vipPriceField');

        // Set initial state
        let isVipFieldVisible = false;

        // Function to toggle visibility and prevent form submission
        function toggleVipField() {
            if (!isVipFieldVisible) {
                vipPriceField.style.display = 'block';
            } else {
                vipPriceField.style.display = 'none';
            }
            isVipFieldVisible = !isVipFieldVisible;
        }

        // Add a click event listener to the button
        vipButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            toggleVipField();
        });
    </script>

</body>

</html>
