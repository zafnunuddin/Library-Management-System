<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgb(59, 105, 213);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:40px;height:40px;object-fit:contain;border-radius:6px;">
                <div class="sidebar-brand-text mx-3">LMS Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
              <!-- লাইব্রেরি ম্যানেজমেন্ট সিস্টেম মেনুবার শুরু -->
<div class="sidebar-heading">
    Library Management
</div>



<!-- ২. নতুন বই যোগ করার ফর্ম -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('add_book') }}">
        <i class="fas fa-fw fa-plus"></i>
        <span>Add New Book</span>
    </a>
</li>

<!-- ৩. সব বইয়ের তালিকা -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('all_book') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>All Books List</span>
    </a>
</li>

<!-- ৪. বই ইস্যু করার ফর্ম -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('issue') }}">
        <i class="fas fa-fw fa-arrow-right"></i>
        <span>Issue Book</span>
    </a>
</li>

<!-- ৫. বই ফেরত নেওয়ার ফর্ম -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('return') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        <span>Return Process</span>
    </a>
</li>

<!-- 6. সব users তালিকা -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('users') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>All Users List</span>
    </a>
</li>
<!-- 7. Legal Pages (Terms / Privacy Policy) -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.legal.index') }}">
        <i class="fas fa-fw fa-file-contract"></i>
        <span>Legal Pages</span>
    </a>
</li>
<!-- 8. System Settings -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.settings.index') }}">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Settings</span>
    </a>
</li>
<!-- লাইব্রেরি ম্যানেজমেন্ট সিস্টেম মেনুবার শেষ -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            
           
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>