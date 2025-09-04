<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <!-- Sidebar Toggle (Left) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Right-aligned Navbar items -->
    <ul class="navbar-nav ms-auto d-flex align-items-center">

        <!-- Subscribers Dropdown -->
        <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle position-relative" href="#" id="subscribersDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-users fa-fw"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle" id="newSubscribersCount" style="font-size: 0.6rem;">
                    {{ $newSubscribersCount ?? 0 }}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="subscribersDropdown" style="min-width: 300px;">
                <li class="dropdown-header">Recent Subscribers</li>
                <div id="subscribersList" class="px-2">
                    @forelse($recentSubscribers ?? [] as $subscriber)
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $subscriber->created_at->diffForHumans() }}</div>
                                <span class="fw-bold">{{ $subscriber->email }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="dropdown-item text-center small text-gray-500">
                            No subscribers yet
                        </div>
                    @endforelse
                </div>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-center small text-gray-500" href="#" id="viewAllSubscribers">
                        <i class="fas fa-list me-1"></i> View All Subscribers
                    </a>
                </li>
            </ul>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <span class="me-2 d-none d-lg-inline text-gray-600 small">Ekta Verma</span>
                <img class="rounded-circle" src="{{ asset('img/profile.jpg') }}" height="32" width="32">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>

<!-- Centered All Subscribers Panel -->
<div id="allSubscribersInline" class="position-fixed top-50 start-50 translate-middle bg-white p-4 border rounded shadow" 
     style="display: none; width: 500px; max-height: 70vh; overflow-y: auto; z-index: 1050;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5><i class="fas fa-users me-2"></i>All Subscribers</h5>
        <button id="closeSubscribersInline" class="btn btn-sm btn-secondary">&times;</button>
    </div>
    <table class="table table-striped table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Email</th>
                <th>Subscribed At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="allSubscribersInlineList">
            <tr>
                <td colspan="3" class="text-center py-4">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Scripts -->
@push('scripts')
<script>
$(function() {

    // Update recent subscribers badge
    function updateSubscribers() {
        $.get('{{ route("admin.subscribers.check") }}', function(data) {
            $('#newSubscribersCount').text(data.count);

            let html = data.subscribers.length
                ? data.subscribers.map(sub => `
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="me-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">${sub.time}</div>
                            <span class="fw-bold">${sub.email}</span>
                        </div>
                    </a>
                `).join('')
                : '<div class="dropdown-item text-center small text-gray-500">No subscribers yet</div>';

            $('#subscribersList').html(html);
        });
    }

    // Open Centered Panel
    $('#viewAllSubscribers').click(function(e) {
        e.preventDefault();
        let $panel = $('#allSubscribersInline');
        $panel.show();

        $.get('{{ route("admin.subscribers.all") }}', function(data) {
            const html = data.length
                ? data.map(sub => `
                    <tr>
                        <td>${sub.email}</td>
                        <td>${sub.time}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-subscriber" data-id="${sub.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `).join('')
                : '<tr><td colspan="3" class="text-center py-4">No subscribers found</td></tr>';

            $('#allSubscribersInlineList').html(html);

            // Delete subscriber
            $('.delete-subscriber').click(function() {
                if(confirm('Delete this subscriber?')) {
                    const $btn = $(this);
                    $.ajax({
                        url: '/admin/subscribers/' + $btn.data('id'),
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function() {
                            $btn.closest('tr').remove();
                            updateSubscribers();
                        }
                    });
                }
            });
        });
    });

    // Close Centered Panel
    $('#closeSubscribersInline').click(function() {
        $('#allSubscribersInline').hide();
    });

    // Initial update + refresh every 30 sec
    updateSubscribers();
    setInterval(updateSubscribers, 30000);

});
</script>
@endpush
