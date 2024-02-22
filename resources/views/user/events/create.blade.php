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
                                <h4 class="card-title">Create Events Form </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form id="blogForm" class="forms-sample" action="{{ route('storeEvents') }}"
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

                                        <div class="form-group">
                                            <label for="exampleInputSlots">Date of the event </label>
                                            <input type="date" name="date" class="form-control"
                                                id="exampleInputSlots" value="{{ old('date') }}" placeholder="Date">

                                            @error('date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputSlots">Date and Time of the event </label>
                                            <input type="time" name="startTime" class="form-control"
                                                id="exampleInputSlots" value="{{ old('startTime') }}"
                                                placeholder="Time">

                                            @error('datetime')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="section" style="display: none;">

                                        <div class="form-group">
                                            <label for="exampleInputName1">Price for Visit </label>
                                            <input type="number" name="price" class="form-control"
                                                id="exampleInputName1" placeholder="Price for Visit"
                                                value="{{ old('price') }}">

                                            @error('price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputName1">Location</label>
                                            <input type="text" name="location" class="form-control"
                                                id="exampleInputName1" placeholder="Location"
                                                value="{{ old('location') }}">

                                            @error('location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="section" style="display: none;">
                                        <div class="form-group">
                                            <label for="imageUpload">File upload</label>

                                            <div id="dropArea" class="drop-area">

                                                <input type="file" class="file-input visually-hidden"
                                                    name="image[]" id="imageUpload" value="{{ old('image') }}"
                                                    multiple>
                                                <label for="imageUpload" class="custom-file-upload">
                                                    <i class="fas fa-cloud-upload-alt"></i> Choose File less than 1mb
                                                </label>
                                            </div>

                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleTextarea1">Write Your Content Here</label>
                                            <textarea class="form-control" id="description" name="description" id="exampleTextarea1" rows="5"
                                                value="{{ old('description') }}"></textarea>

                                            @error('description')
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
