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


                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Property Table </h4>
                                <p class="card-description">

                                </p>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" id="downloadReportBtn">Download Report</button>
                                    <div id="downloadReportDropdown" style="display: none;">
                                        @php
                                        // Get the current month name
                                        $currentMonth = date('F');
                                        @endphp

                                        <div class="dropdown-item">
                                            <a href="{{ route('download.monthly.apartment.report', ['month' => strtolower($currentMonth)]) }}" class="btn" style="background-color: crimson">
                                                Download Report for {{ $currentMonth }}
                                            </a>
                                        </div>

                                        <div class="dropdown-item">
                                            <a href="{{ route('download.yearly.apartment.report') }}" class="btn" style="background-color: chocolate">
                                                Download Report Full year
                                            </a>
                                        </div>
                                    </div>
                                    </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Property Title</th>
                                                <th>Property Image</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Location</th>
                                                <th>Number of Bedrooms</th>
                                                <th>All Rooms</th>
                                                <th>Number of Kitchens</th>
                                                <th>Number of Bathrooms</th>
                                                <th>Category</th>
                                                <th>Amenities</th>
                                                <th>Reviews</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($properties as $property)
                                                <tr>
                                                    <td>{{ $property->name }}</td>
                                                    <td>
                                                        @php
                                                            $images = json_decode($property->image);
                                                        @endphp

                                                        @if (!is_null($images) && is_array($images) && count($images) > 0)
                                                            <img src="{{ asset($images[0]) }}" alt="Property Image"
                                                                class="img-fluid" style="max-width: 100px;">
                                                            @if (count($images) > 1)
                                                                <p>+{{ count($images) - 1 }}</p>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{!! $property->description !!}</td>
                                                    <td>ksh{{ $property->selling_price }}</td>
                                                    <td>{{ $property->location }}</td>
                                                    <td>{{ $property->number_of_bedrooms }}</td>
                                                    <td>{{ $property->all_rooms }}</td>
                                                    <td>{{ $property->number_of_kitchen }}</td>
                                                    <td>{{ $property->number_of_bathrooms }}</td>
                                                    <td>{{ $property->category->name }}</td>
                                                    <td>
                                                        @if($property->amenities->isNotEmpty())
                                                            <button class="toggle-amenities">Show Amenities</button>
                                                            <ul class="amenities-list" style="display: none;">
                                                                @foreach($property->amenities as $amenity)
                                                                    <li>{{ $amenity->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            No amenities available
                                                        @endif
                                                    </td>


                                                    <td>{{ $property->reviews }}</td>
                                                    <td>{{ $property->status ? 'Available' : 'Sold' }}</td>


                                                    <td>

                                                            <button type="button" class="btn btn-secondary more-btn"
                                                                data-toggle="modal"
                                                                data-target="#moreOptions_{{ $property->id }}">
                                                                More
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="moreOptions_{{ $property->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="moreOptionsLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="moreOptionsLabel">Options</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="dropdown-item">
                                                                                <a href="{{ route('editPropertyAp', $property->id) }}"
                                                                                    class="btn btn-secondary">Edit</a>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('deletePropertyAp', $property) }}"
                                                                                method="POST" class="dropdown-item">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Delete</button>
                                                                            </form>

                                                                            <form
                                                                            action="{{ route('deletePropertyAp', $property) }}"
                                                                            method="POST" class="dropdown-item">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Mark As Sold </button>
                                                                        </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Your existing HTML content -->

                                <!-- Pagination -->
                                <div class="text-center pt-5">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item @if ($properties->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $properties->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $properties->lastPage(); $i++)
                                                <li class="page-item @if ($i === $properties->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $properties->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($properties->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $properties->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    </div>

    <script>
        // Get all elements with the class "toggle-amenities"
        const toggleButtons = document.querySelectorAll('.toggle-amenities');

        // Loop through each button and add a click event listener
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Find the closest ".amenities-list" element and toggle its display style
                const amenitiesList = this.nextElementSibling;
                amenitiesList.style.display = amenitiesList.style.display === 'none' ? 'block' : 'none';
            });
        });

        document.getElementById('downloadReportBtn').addEventListener('click', function() {
        var dropdown = document.getElementById('downloadReportDropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });
    </script>


    @include('user.include.scripts')

</body>

</html>
