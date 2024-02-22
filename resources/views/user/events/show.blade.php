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
                                <h4 class="card-title">Events Table </h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Event Title</th>
                                                <th>Event Image</th>
                                                <th>Price</th>
                                                <th>Location</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $event)
                                                <tr>
                                                    <td>{{ $event->title }}</td>
                                                    <td>
                                                        @php
                                                            $image = json_decode($event->image);
                                                        @endphp

                                                        @if (!is_null($image) && is_array($image))
                                                            <img src="{{ asset($image[0]) }}" alt="Event Image"
                                                                class="img-fluid" style="max-width: 100px;">
                                                            @if (count($image) > 1)
                                                                <p>+{{ count($image) - 1 }}</p>
                                                            @endif
                                                        @endif

                                                    </td>

                                                    <td>ksh{{ $event->price }}</td>
                                                    <td>{{ $event->location }}</td>



                                                    <td>

                                                            <button type="button" class="btn btn-secondary more-btn"
                                                                data-toggle="modal"
                                                                data-target="#moreOptions_{{ $event->id }}">
                                                                More
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="moreOptions_{{ $event->id }}" tabindex="-1"
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
                                                                            {{-- <div class="dropdown-item">
                                                                                <a href="{{ route('editEvents', $event) }}"
                                                                                    class="btn btn-secondary">Edit</a>
                                                                            </div> --}}
                                                                            <form
                                                                                action="{{ route('deleteEvents', $event) }}"
                                                                                method="POST" class="dropdown-item">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Delete</button>
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('addToSlide', $event->id) }}"
                                                                                method="POST" class="dropdown-item">
                                                                                @csrf

                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Add To
                                                                                    Slider</button>
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
                                            <li class="page-item @if ($events->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $events->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $events->lastPage(); $i++)
                                                <li class="page-item @if ($i === $events->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $events->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($events->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $events->nextPageUrl() }}"
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

    @include('user.include.scripts')

</body>

</html>
