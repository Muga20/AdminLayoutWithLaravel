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
                                <h4 class="card-title">User Table </h4>
                                <p class="card-description">
                                    <a href="/createNewUser" >
                                        <button class="btn btn-primary mr-2"> Add a new Member </button>
                                    </a>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Profile
                                               </th>
                                                <th>
                                                     Name
                                                </th>
                                                <th>
                                                    Role
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $amenities)
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="{{ asset($amenities->image) }}" alt="image" />
                                                    </td>
                                                    <td>{{ $amenities->name }}</td>
                                                    <td>{{ $amenities->role }}</td>
                                                    <td>{{ $amenities->email }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary more-btn" data-toggle="modal" data-target="#moreOptions_{{ $amenities->id }}">
                                                            More
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="moreOptions_{{ $amenities->id }}" tabindex="-1" role="dialog" aria-labelledby="moreOptionsLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="moreOptionsLabel">Options</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form class="dropdown-item">
                                                                            <span> There is no available action for you  </span>
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
                                            <li class="page-item @if ($users->previousPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                                <li class="page-item @if ($i === $users->currentPage()) active @endif">
                                                    <a class="page-link"
                                                        href="{{ $users->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item @if ($users->nextPageUrl() == null) disabled @endif">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}"
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
