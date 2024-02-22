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
                                <h4 class="card-title">Create Property Form </h4>

                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                        {{ Session::get('status') }}
                                    </div>
                                @endif

                                <form id="blogForm" class="forms-sample" action="{{ route('storePropertyAp') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="section">
                                        <div class="form-group">
                                            <label for="propertyName">Property Name</label>
                                            <input type="text" name="name" class="form-control" id="propertyName"
                                                placeholder="Property Name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="propertyPrice">Selling Price</label>
                                            <input type="number" name="selling_price" class="form-control" id="propertyPrice"
                                                placeholder="Selling Price" value="{{ old('selling_price') }}" required>
                                            @error('selling_price')
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
                                            <label for="exampleSelectGender">Amenities</label>
                                            <select class="form-control" name="amenity_id[]" id="exampleSelectGender" multiple>
                                                <option selected disabled>Select Category</option>
                                                @foreach ($amenities as $amenities)
                                                    <option value="{{ $amenities->id }}">{{ $amenities->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                                            @enderror
                                        </div>


                                    </div>


                                    <div class="section" style="display: none;">

                                        <div class="form-group">
                                            <label for="propertyMeasurement">Measurement</label>
                                            <input type="text" name="measurement" class="form-control"
                                                id="propertyMeasurement" placeholder="Measurement"
                                                value="{{ old('measurement') }}">
                                            @error('measurement')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="propertyLocation">Location</label>
                                            <input type="text" name="location" class="form-control"
                                                id="propertyLocation" placeholder="Location"
                                                value="{{ old('location') }}">
                                            @error('location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>



                                    <div class="section" style="display: none;">

                                        <div class="form-group">
                                            <label for="propertyBedrooms">Number of Bedrooms</label>
                                            <input type="text" name="number_of_bedrooms" class="form-control" id="propertyBedrooms" placeholder="Number of Bedrooms" value="{{ old('number_of_bedrooms') }}">
                                            @error('number_of_bedrooms')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="propertyRooms">All Rooms</label>
                                            <input type="text" name="all_rooms" class="form-control" id="propertyRooms" placeholder="All Rooms" value="{{ old('all_rooms') }}">
                                            @error('all_rooms')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="propertyKitchen">Number of Kitchens</label>
                                            <input type="text" name="number_of_kitchen" class="form-control" id="propertyKitchen" placeholder="Number of Kitchens" value="{{ old('number_of_kitchen') }}">
                                            @error('number_of_kitchen')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="propertyBathrooms">Number of Bathrooms</label>
                                            <input type="text" name="number_of_bathrooms" class="form-control" id="propertyBathrooms" placeholder="Number of Bathrooms" value="{{ old('number_of_bathrooms') }}">
                                            @error('number_of_bathrooms')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>





                                    <div class="section" style="display: none;">
                                        <div class="form-group">
                                            <label for="imageUpload">File upload</label>

                                            <div id="dropArea" class="drop-area">

                                                <input type="file" class="file-input visually-hidden" name="image[]"
                                                    id="imageUpload" value="{{ old('image') }}" multiple>
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
