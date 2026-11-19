<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <header class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="LMS EDU" onerror="this.onerror=null; this.src='https://placehold.co/120x40/2d50d2/ffffff?text=LMS+EDU';">
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#books">Books</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>

        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="login-btn">Login</a>
            <a href="{{ route('register') }}" class="signup-btn">Sign Up</a>
        </div>
    </header>

    <!-- ================= HERO SECTION ================= -->
    <section class="hero" id="home">
        <div class="hero-content">
            <p class="small-title">WELCOME TO</p>
            <h1>LIBRARY<br>MANAGEMENT<br>SYSTEM</h1>
            <p class="hero-text">
                Discover a world of knowledge, explore your favorite books, and make your learning journey easier.
            </p>
            <div class="hero-buttons">
                <a href="#books" class="primary-btn">Explore Books</a>
                <a href="#about" class="secondary-btn">Learn More</a>
            </div>
        </div>
    </section>

    <!-- ================= FEATURED BOOKS SECTION ================= -->
    <section class="books" id="books">
        <div class="section-title">
            <p>OUR COLLECTION</p>
            <h2>Featured Books</h2>
        </div>

        <div class="book-container">
            @forelse($books as $book)
               @php
    $categoryName = strtolower(optional($book->category)->name ?? '');
    $titleName = strtolower($book->title ?? '');

    // ১. নির্দিষ্ট ক্যাটাগরি বা কিওয়ার্ড থাকলে স্পেশাল কভার
    if (str_contains($categoryName, 'stat') || str_contains($titleName, 'stat')) {
        $defaultImage = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600&auto=format&fit=crop';
    } elseif (str_contains($categoryName, 'code') || str_contains($titleName, 'c++') || str_contains($titleName, 'java') || str_contains($categoryName, 'program')) {
        $defaultImage = 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=600&auto=format&fit=crop';
    } elseif (str_contains($categoryName, 'cse') || str_contains($titleName, 'tech') || str_contains($titleName, 'hardware')) {
        $defaultImage = 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=600&auto=format&fit=crop';
    } elseif (str_contains($categoryName, 'bba') || str_contains($categoryName, 'busin') || str_contains($titleName, 'manag')) {
        $defaultImage = 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=600&auto=format&fit=crop';
    } else {
        // ২. সাধারণ বইয়ের জন্য আইডি অনুযায়ী অটোমেটিক ভিন্ন ভিন্ন সুন্দর বইয়ের রিয়েল কভার ছবি
        $imageSeed = $book->id ?? rand(1, 100);
        $defaultImage = "https://picsum.photos/seed/book_{$imageSeed}/600/400";
    }

    // ব্যাকআপ সোর্স
    $fallbackImage = "https://images.unsplash.com/photo-1543002588-bfa74002ed7e?q=80&w=600&auto=format&fit=crop";
@endphp

                <div class="book-card">
                    <div class="book-image">
                        {{-- Badges --}}
                        <span class="badge badge-new">NEW</span>
                        <span class="badge badge-cat">{{ optional($book->category)->name ?? 'General' }}</span>

                        {{-- Image Logic --}}
                        @if(!empty($book->photo))
                            <img src="{{ asset('storage/' . $book->photo) }}" 
                                 alt="{{ $book->title }}" 
                                 onerror="this.onerror=null; this.src='{{ $fallbackImage }}';">
                        @else
                            <img src="{{ $defaultImage }}" 
                                 alt="{{ $book->title }}" 
                                 onerror="this.onerror=null; this.src='{{ $fallbackImage }}';">
                        @endif
                    </div>

                    <div class="book-info">
                        <h3>{{ $book->title }}</h3>
                        <p class="author">{{ $book->author }}</p>

                        {{-- Quantity Status --}}
                        @if(($book->quantity ?? 1) > 0)
                            <p class="qty available">Qty: {{ $book->quantity ?? 1 }} Available</p>
                        @else
                            <p class="qty out-of-stock">Qty: 0 (Out of Stock)</p>
                        @endif

                        <a href="{{ route('book.details', $book->id) }}" class="details-btn">View Details</a>
                    </div>
                </div>
            @empty
                <p>No books available yet.</p>
            @endforelse
        </div>
    </section>

    <!-- ================= ABOUT US SECTION ================= -->
    <section class="about-section" id="about">
        <div class="section-title">
            <p>ABOUT OUR LIBRARY</p>
            <h2>About Us</h2>
        </div>

        <div class="about-container">
            <div class="about-content">
                <h3>Welcome to Library Management System</h3>
                <p>Our Library Management System is designed to make library services simple, organized and accessible.</p>
                <p>Students can explore books, check book information and easily access the library system. Administrators can efficiently manage books, members, issuing, returning and other library activities.</p>
                <p>Our goal is to provide a convenient digital library experience for both students and administrators.</p>
            </div>
            <div class="about-icon">
                <div class="about-icon-circle">📚</div>
            </div>
        </div>
    </section>

    <!-- ================= STATS SECTION ================= -->
    <section class="stats">
        <div class="stat-box">
            <h2>{{ number_format($totalBooks ?? 0) }}+</h2>
            <p>Books Available</p>
        </div>
        <div class="stat-box">
            <h2>{{ number_format($totalMembers ?? 0) }}+</h2>
            <p>Registered Members</p>
        </div>
        <div class="stat-box">
            <h2>{{ number_format($totalCategories ?? 0) }}+</h2>
            <p>Book Categories</p>
        </div>
        <div class="stat-box">
            <h2>24/7</h2>
            <p>Easy Access</p>
        </div>
    </section>

    <!-- ================= CATEGORIES SECTION ================= -->
    <section class="categories-section" id="categories">
        <div class="section-title">
            <p>EXPLORE OUR COLLECTION</p>
            <h2>Book Categories</h2>
        </div>

        <div class="category-container">
            <div class="category-card"><div class="category-icon">💻</div><h3>Computer Science & Engineering</h3><p>Programming, algorithms, architecture.</p></div>
            <div class="category-card"><div class="category-icon">🖥️</div><h3>Information Technology</h3><p>IT infrastructure, operating systems.</p></div>
            <div class="category-card"><div class="category-icon">⚙️</div><h3>Software Engineering</h3><p>Software development, design, and testing.</p></div>
            <div class="category-card"><div class="category-icon">🌐</div><h3>Networking & Communication</h3><p>Routing, switching, network security.</p></div>
            <div class="category-card"><div class="category-icon">🤖</div><h3>Artificial Intelligence & ML</h3><p>AI, machine learning, and robotics.</p></div>
            <div class="category-card"><div class="category-icon">📊</div><h3>Data Science & Statistics</h3><p>Data analysis and statistical methods.</p></div>
            <div class="category-card"><div class="category-icon">📐</div><h3>Mathematics & Physics</h3><p>Scientific fundamentals and formulas.</p></div>
            <div class="category-card"><div class="category-icon">💼</div><h3>Business & Management</h3><p>Finance, marketing, and administration.</p></div>
            <div class="category-card"><div class="category-icon">📚</div><h3>English & Literature</h3><p>Literature, history, and humanities.</p></div>
        </div>
    </section>

    <!-- ================= CONTACT SECTION ================= -->
    <section class="contact-section" id="contact">
        <div class="section-title">
            <p>GET IN TOUCH</p>
            <h2>Contact Us</h2>
        </div>

        <div class="contact-container">
            <div class="contact-info">
                <h3>Library Management System</h3>
                <p>Have questions or need help? Feel free to contact us.</p>
                <div class="contact-item"><strong>Email</strong><p>admin@edu.bd</p></div>
                <div class="contact-item"><strong>Phone</strong><p>+880 1734567876</p></div>
                <div class="contact-item"><strong>Address</strong><p>Bangladesh</p></div>
            </div>

            <div class="contact-box">
                <h3>Library Support</h3>
                <p>Our library administration team is available to assist students with services, books and account-related issues.</p>
                <a href="mailto:admin@edu.bd" class="primary-btn">Contact Library</a>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="LMS EDU" class="footer-logo-img" onerror="this.onerror=null; this.src='https://placehold.co/100x30/ffffff/2d50d2?text=LMS+EDU';">
                <p>A simple and easy way to explore, manage and enjoy your library.</p>
            </div>

            <div class="footer-links">
                <h3>Quick Links</h3>
                <a href="#home">Home</a>
                <a href="#books">Books</a>
                <a href="#about">About Us</a>
                <a href="#contact">Contact Us</a>
            </div>

            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: admin@edu.bd</p>
                <p>Phone: +880 1734567876</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} Library Management System. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/landing.js') }}"></script>
</body>
</html>