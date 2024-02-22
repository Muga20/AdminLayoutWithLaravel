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
                                <h4 class="card-title">Attachment Table </h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Attachment Name
                                                </th>

                                                <th>
                                                   For property Name
                                                </th>

                                                <th>
                                                    Actions
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($attachments && count($attachments) > 0)
                                                @foreach ($attachments as $attachment)
                                                    <tr>

                                                        <td>{{ $attachment->filename }}</td>
                                                        <td>{{ $attachment->property->name }}</td>

                                                        <td>

                                                                <button type="button"
                                                                    class="btn btn-secondary more-btn"
                                                                    data-toggle="modal"
                                                                    data-target="#moreOptions_{{ $attachment->id }}">
                                                                    More
                                                                </button>

                                                                <div class="modal fade"
                                                                    id="moreOptions_{{ $attachment->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="moreOptionsLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="moreOptionsLabel">Options</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <form
                                                                                    action="{{ route('deleteAttachment', $attachment) }}"
                                                                                    method="POST"
                                                                                    class="dropdown-item">
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
                                            @else
                                                <p>No tags found!</p>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Your existing HTML content -->

                                <!-- Pagination -->
                                <div class="text-center pt-5">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item @if ($attachments->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $attachments->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $attachments->lastPage(); $i++)
                                                <li class="page-item @if ($i === $attachments->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $attachments->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($attachments->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $attachments->nextPageUrl() }}"
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
