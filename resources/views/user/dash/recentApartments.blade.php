<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Recent Apartments in your System   </h4>
            <p class="card-description">
            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Property Title</th>
                        <th>Property Image</th>
                        {{-- <th>Description</th> --}}
                        <th>Price</th>
                        <th>Location</th>
                        <th>Measurements</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($property as $property)
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
                            <td>ksh{{ $property->selling_price }}</td>
                            <td>{{ $property->location }}</td>
                            <td>{{ $property->measurement }}
                            <td>{{ $property->status ? 'On Sale' : 'Inactive' }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
