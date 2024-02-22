<div class="col-xl-8 d-flex grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Recent Property Reviews By Users (Today)</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    @foreach($todayComments as $comment)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <img class="img-sm rounded-circle mb-md-0 mr-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTOkHm3_mPQ5PPRvGtU6Si7FJg8DVDtZ47rw&usqp=CAU" alt="profile image">
                                    <div>
                                        <div>Property Name</div>
                                        <div class="font-weight-bold mt-1">
                                            @if($comment->property)
                                                {{ $comment->property->name }}
                                            @elseif($comment->apartment)
                                                {{ $comment->apartment->name }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                Message
                                <div class="font-weight-bold mt-1">{{ substr($comment->message, 0, 50)}}</div>
                            </td>

                            <td>
                                Date Reviewed
                                <div class="font-weight-bold mt-1">{{ $comment->created_at->format('d M Y') }}</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary view-comment" data-message="{{ $comment->message }}">View</button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center pt-5" >
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item @if ($todayComments->previousPageUrl() == null) disabled @endif">
                            <a class="page-link" href="{{ $todayComments->previousPageUrl() }}"
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $todayComments->lastPage(); $i++)
                            <li class="page-item @if ($i === $todayComments->currentPage()) active @endif">
                                <a class="page-link"
                                   href="{{ $todayComments->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item @if ($todayComments->nextPageUrl() == null) disabled @endif">
                            <a class="page-link" href="{{ $todayComments->nextPageUrl() }}"
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

<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Comment Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="commentMessage"></p>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-4 d-flex grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Events</h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between mb-md-5 mt-3">
                                <div class="small">Critical</div>
                                <div class="text-danger small">Error</div>
                                <div  class="text-warning small">Warning</div>
                            </div>
                            <canvas id="eventChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-comment');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const message = this.getAttribute('data-message');
                document.getElementById('commentMessage').textContent = message;
                $('#commentModal').modal('show');
            });
        });
    });
</script>
