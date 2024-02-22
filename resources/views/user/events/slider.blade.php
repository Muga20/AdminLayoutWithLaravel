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
                                <h4 class="card-title">Events Slider Table </h4>
                                <p class="card-description">
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Event Title</th>
                                                <th>Event Image</th>
                                                <th>Location</th>
                                                 <th>Sales Ends On</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $slider)
                                                <tr>
                                                    <td>{{ $slider->event->title }}</td>
                                                    <td>
                                                      @php
                                                            $image = json_decode($slider->event->image);
                                                        @endphp

                                                        @if (!is_null($image) && is_array($image))
                                                            <img src="{{ asset($image[0]) }}" alt="Event Image"
                                                                class="img-fluid" style="max-width: 100px;">

                                                            @if (count($image) > 1)
                                                                <p>+{{ count($image) - 1 }}</p>
                                                            @endif
                                                        @endif

                                                    </td>
                                                    <td>{{ $slider->event->location }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($slider->event->date)->format('F j, Y g:i A') }}</td>


                                                    <td>
                                                        @if (auth()->user()->id === $slider->event->user_id)
                                                            <button type="button" class="btn btn-secondary more-btn"
                                                                data-toggle="modal"
                                                                data-target="#moreOptions_{{ $slider->event->id }}">
                                                                More
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="moreOptions_{{ $slider->event->id }}" tabindex="-1"
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

                                                                            <form
                                                                                action=""
                                                                                method="POST" class="dropdown-item">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger"> Remove </button>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

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
