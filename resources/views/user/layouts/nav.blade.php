<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button"
            data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item d-none d-lg-flex {{ request()->routeIs('calendar') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('calendar') }}" style="{{ request()->routeIs('calendar') ? 'color: #FD904B; font-weight: bold;' : '' }}">
                    Calendar
                </a>
            </li>
            <li class="nav-item d-none d-lg-flex {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}" style="{{ request()->routeIs('dashboard') ? 'color: #FD904B; font-weight: bold;' : '' }}">
                    Statistic
                </a>
            </li>
            <li class="nav-item d-none d-lg-flex {{ request()->routeIs('showUser') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('showUser') }}" style="{{ request()->routeIs('showUser') ? 'color: #FD904B; font-weight: bold;' : '' }}">
                    Employee
                </a>
            </li>
        </ul>


        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-flex  mr-2">
                <a class="nav-link" href="#">
                    Help
                </a>
            </li>
            <li class="nav-item dropdown d-flex">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-message-typing"></i>
                    <span class="count bg-success" id="commentCount">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown" id="commentsDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>

                </div>
            </li>
            <li class="nav-item dropdown  d-flex">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-bell mr-0"></i>
                    <span class="count bg-danger">2</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="typcn typcn-info-large mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                            <p class="font-weight-light small-text mb-0">
                                Just now
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="typcn typcn-cog mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                            <p class="font-weight-light small-text mb-0">
                                Private message
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="typcn typcn-user-outline mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                            <p class="font-weight-light small-text mb-0">
                                2 days ago
                            </p>
                        </div>
                    </a>
                </div>
            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="typcn typcn-user-outline mr-0"></i>
                      <span class="nav-profile-name"> {{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="typcn typcn-cog text-primary"></i>
                        Settings
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="typcn typcn-power text-primary"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const commentCountElement = document.getElementById('commentCount');
        const commentsDropdown = document.getElementById('commentsDropdown');
        const closedComments = JSON.parse(localStorage.getItem('closedComments')) || [];
        const url = '/comments-count';

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.count === 0 || data.count === closedComments.length) {
                    commentCountElement.textContent = '';
                    const noCommentsMessage = document.createElement('p');
                    noCommentsMessage.classList.add('dropdown-header');
                    noCommentsMessage.textContent = 'No comments today';
                    commentsDropdown.appendChild(noCommentsMessage);
                } else {
                    commentCountElement.textContent = data.count - closedComments.length;
                    data.comments.forEach(comment => {
                        if (!closedComments.includes(comment.id)) {
                            const commentItem = document.createElement('a');
                            commentItem.classList.add('dropdown-item', 'preview-item');
                            const truncatedMessage = comment.message.length > 20 ? `${comment.message.substring(0, 20)}...` : comment.message;
                            commentItem.innerHTML = `
                                <div class="preview-thumbnail">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTOkHm3_mPQ5PPRvGtU6Si7FJg8DVDtZ47rw&usqp=CAU" alt="profile image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal">${comment.name}</h6>
                                    <p class="font-weight-light small-text mb-0">${truncatedMessage}</p>
                                </div>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            `;
                            commentItem.querySelector('.close').addEventListener('click', function () {
                                commentItem.remove();
                                closedComments.push(comment.id);
                                localStorage.setItem('closedComments', JSON.stringify(closedComments));
                                commentCountElement.textContent = data.count - closedComments.length; // Update comment count display
                                if (closedComments.length === data.count) {
                                    commentCountElement.textContent = '';
                                }
                            });
                            commentsDropdown.appendChild(commentItem);
                        }
                    });
                }
            })
            .catch(error => console.error('Error fetching comment count:', error));
    });
</script>
