<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-tools"></i>
        </div>
        <div class="sidebar-brand-text mx-1">Ekta Interior</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Sidebar Menu Buttons -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}" data-section="dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/header-content')}}" data-section="header">
            <i class="fas fa-image"></i>
            <span>Header Section</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/hero-content')}}" data-section="hero">
            <i class="fas fa-image"></i>
            <span>Hero Section</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/about-content')}}" data-section="about">
            <i class="fas fa-user"></i>
            <span>About Us</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/whyus-content')}}" data-section="why-us">
            <i class="fas fa-briefcase"></i>
            <span>Why-Us</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/projects-content')}}" data-section="projects">
            <i class="fas fa-briefcase"></i>
            <span>Projects</span>
        </a>
    </li>

    <!-- Services with dropdown -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" href="#"
           data-bs-toggle="collapse" data-bs-target="#servicesCollapse"
           aria-expanded="false" aria-controls="servicesCollapse">
            <span><i class="fas fa-concierge-bell me-2"></i>Services</span>
            <i class="fas fa-chevron-down"></i> <!-- Dropdown arrow -->
        </a>
        <div id="servicesCollapse" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('admin/services-content')}}">
                    <i class="fas fa-list me-2"></i>Services
                </a>
                <a class="collapse-item" href="{{url('admin/counters-content')}}">
                    <i class="fas fa-chart-line me-2"></i>Counter
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/team-content')}}" data-section="team">
            <i class="fas fa-users"></i>
            <span>Team</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/testimonials-content')}}" data-section="testimonials">
            <i class="fas fa-envelope"></i>
            <span>Testimonials</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/contact-content')}}" data-section="contact">
            <i class="fas fa-envelope"></i>
            <span>Contact Info</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Bootstrap 5 JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Arrow rotation -->
<script>
document.querySelectorAll('#accordionSidebar .nav-link[data-bs-toggle="collapse"]').forEach(function(link){
    link.addEventListener('click', function(){
        const icon = link.querySelector('.fas.fa-chevron-down');
        const target = document.querySelector(link.getAttribute('data-bs-target'));
        setTimeout(() => {
            if(target.classList.contains('show')){
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }, 200); // Match collapse animation
    });
});
</script>

<!-- Optional: Sidebar toggle button -->
<script>
const sidebar = document.getElementById('accordionSidebar');
const toggleBtn = document.getElementById('sidebarToggle');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('toggled'); // Add your CSS to shrink/expand sidebar
});
</script>
