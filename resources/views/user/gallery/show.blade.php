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
                                <h4 class="card-title">Category Table </h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Category Name
                                                </th>
                                                <th>
                                                    Category Image
                                                </th>

                                                <th>
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gallery as $galleries)
                                                <tr>
                                                    <td>{{ $galleries->name }}</td>
                                                    <td>
                                                    @php
                                                        $images = json_decode($galleries->image);
                                                    @endphp

                                                    @if (!is_null($images) && is_array($images) && count($images) > 0)
                                                        <img src="{{ asset($images[0]) }}" alt="Property Image"
                                                             class="img-fluid" style="max-width: 100px;">
                                                        @if (count($images) > 1)
                                                            <p>+{{ count($images) - 1 }}</p>
                                                        @endif
                                                    @endif
                                                    </td>
                                                    <td>

                                                            <button type="button" class="btn btn-secondary more-btn"
                                                                data-toggle="modal"
                                                                data-target="#moreOptions_{{ $galleries->id }}">
                                                                More
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="moreOptions_{{ $galleries->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="moreOptionsLabel" aria-hidden="true">
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
                                                                                action="{{ route('deleteGallery', $galleries) }}"
                                                                                method="POST" class="dropdown-item">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Delete</button>
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
                                            <li class="page-item @if ($gallery->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $gallery->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $gallery->lastPage(); $i++)
                                                <li class="page-item @if ($i === $gallery->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $gallery->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($gallery->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $gallery->nextPageUrl() }}"
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
