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
                                                <th> Title</th>
                                                <th> Image</th>
                                                <th>Category</th>
                                                <th>Body</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $blog)
                                                <tr>
                                                    <td >{{ $blog->title }}</td>
                                                    <td>
                                                            <img src="{{ asset($blog->image) }}" alt="Event Image"
                                                                class="img-fluid" style="max-width: 100px;">

                                                    </td>
                                                    <td>{{ $blog->category->name }}</td>

                                                    <td>{{ substr($blog->description, 0, 50) }}</td>


                                                    <td>

                                                            <button type="button" class="btn btn-secondary more-btn"
                                                                data-toggle="modal"
                                                                data-target="#moreOptions_{{ $blog->id }}">
                                                                More
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="moreOptions_{{ $blog->id }}" tabindex="-1"
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
                                                      <a href="{{ route('editBlogs', $blog->id) }}"
                                                                                    class="btn btn-secondary">Edit</a>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('deleteBlogs', $blog) }}"
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

                                <div class="text-center pt-5" >
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item @if ($blogs->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                                <li class="page-item @if ($i === $blogs->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($blogs->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}"
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
