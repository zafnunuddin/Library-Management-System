<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library LMS - Add New Book</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

    <div class="card shadow mb-4">

        <div class="card-header py-3 text-white"
        style="background-color: rgb(32, 92, 232);">
            <h5 class="m-0 font-weight-bold">
                <i class="fas fa-book-open mr-2"></i>
                Add New Book Details
            </h5>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('books.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">
                            Book Title
                        </label>

                        <input type="text"
                         name="title"
                         value="{{ old('title') }}"
                         class="form-control"
                               placeholder="Enter Book Title"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">
                            Author Name
                        </label>

                        <input type="text"
                               name="author"
                               value="{{ old('author') }}"
                               class="form-control"
                               placeholder="Enter Author Name"
                               required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">
                            Edition
                        </label>

                        <input type="text"
                               name="edition"
                               value="{{ old('edition') }}"
                               class="form-control"
                               placeholder="1st, 2nd, Global"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">
                            Genre
                        </label>

                        <select name="genre"
                                class="form-control"
                                required>

                            <option value="">Select Genre</option>

                            <option value="Programming" {{ old('genre') == 'Programming' ? 'selected' : '' }}>
    Programming
</option>

<option value="Computer Science" {{ old('genre') == 'Computer Science' ? 'selected' : '' }}>
    Computer Science
</option>

<option value="Information Technology" {{ old('genre') == 'Information Technology' ? 'selected' : '' }}>
    Information Technology
</option>

<option value="Software Engineering" {{ old('genre') == 'Software Engineering' ? 'selected' : '' }}>
    Software Engineering
</option>

<option value="Database" {{ old('genre') == 'Database' ? 'selected' : '' }}>
    Database
</option>

<option value="Networking" {{ old('genre') == 'Networking' ? 'selected' : '' }}>
    Networking
</option>

<option value="Cybersecurity" {{ old('genre') == 'Cybersecurity' ? 'selected' : '' }}>
    Cybersecurity
</option>

<option value="Artificial Intelligence" {{ old('genre') == 'Artificial Intelligence' ? 'selected' : '' }}>
    Artificial Intelligence
</option>

<option value="Machine Learning" {{ old('genre') == 'Machine Learning' ? 'selected' : '' }}>
    Machine Learning
</option>

<option value="Data Science" {{ old('genre') == 'Data Science' ? 'selected' : '' }}>
    Data Science
</option>

<option value="Web Development" {{ old('genre') == 'Web Development' ? 'selected' : '' }}>
    Web Development
</option>

<option value="Mobile App Development" {{ old('genre') == 'Mobile App Development' ? 'selected' : '' }}>
    Mobile App Development
</option>

<option value="Computer Architecture" {{ old('genre') == 'Computer Architecture' ? 'selected' : '' }}>
    Computer Architecture
</option>

<option value="Operating Systems" {{ old('genre') == 'Operating Systems' ? 'selected' : '' }}>
    Operating Systems
</option>

<option value="Algorithms & Data Structures" {{ old('genre') == 'Algorithms & Data Structures' ? 'selected' : '' }}>
    Algorithms & Data Structures
</option>

<option value="Computer Graphics" {{ old('genre') == 'Computer Graphics' ? 'selected' : '' }}>
    Computer Graphics
</option>

<option value="Digital Logic Design" {{ old('genre') == 'Digital Logic Design' ? 'selected' : '' }}>
    Digital Logic Design
</option>

<option value="Computer Networks" {{ old('genre') == 'Computer Networks' ? 'selected' : '' }}>
    Computer Networks
</option>

<option value="Cloud Computing" {{ old('genre') == 'Cloud Computing' ? 'selected' : '' }}>
    Cloud Computing
</option>

<option value="Internet of Things (IoT)" {{ old('genre') == 'Internet of Things (IoT)' ? 'selected' : '' }}>
    Internet of Things (IoT)
</option>

<option value="Robotics" {{ old('genre') == 'Robotics' ? 'selected' : '' }}>
    Robotics
</option>

<option value="Mathematics" {{ old('genre') == 'Mathematics' ? 'selected' : '' }}>
    Mathematics
</option>

<option value="Statistics" {{ old('genre') == 'Statistics' ? 'selected' : '' }}>
    Statistics
</option>

<option value="Physics" {{ old('genre') == 'Physics' ? 'selected' : '' }}>
    Physics
</option>

<option value="Electrical & Electronics Engineering" {{ old('genre') == 'Electrical & Electronics Engineering' ? 'selected' : '' }}>
    Electrical & Electronics Engineering
</option>

<option value="Business & Management" {{ old('genre') == 'Business & Management' ? 'selected' : '' }}>
    Business & Management
</option>

<option value="Economics" {{ old('genre') == 'Economics' ? 'selected' : '' }}>
    Economics
</option>

<option value="English & Communication" {{ old('genre') == 'English & Communication' ? 'selected' : '' }}>
    English & Communication
</option>

<option value="Research & Thesis" {{ old('genre') == 'Research & Thesis' ? 'selected' : '' }}>
    Research & Thesis
</option>

<option value="General / Reference" {{ old('genre') == 'General / Reference' ? 'selected' : '' }}>
    General / Reference
</option>

<option value="Fiction" {{ old('genre') == 'Fiction' ? 'selected' : '' }}>
    Fiction
</option>

<option value="Novel" {{ old('genre') == 'Novel' ? 'selected' : '' }}>
    Novel
</option>

<option value="Short Story" {{ old('genre') == 'Short Story' ? 'selected' : '' }}>
    Short Story
</option>

<option value="Mystery" {{ old('genre') == 'Mystery' ? 'selected' : '' }}>
    Mystery
</option>

<option value="Thriller" {{ old('genre') == 'Thriller' ? 'selected' : '' }}>
    Thriller
</option>

<option value="Detective" {{ old('genre') == 'Detective' ? 'selected' : '' }}>
    Detective
</option>

<option value="Adventure" {{ old('genre') == 'Adventure' ? 'selected' : '' }}>
    Adventure
</option>

<option value="Romance" {{ old('genre') == 'Romance' ? 'selected' : '' }}>
    Romance
</option>

<option value="Historical Fiction" {{ old('genre') == 'Historical Fiction' ? 'selected' : '' }}>
    Historical Fiction
</option>

<option value="Science Fiction" {{ old('genre') == 'Science Fiction' ? 'selected' : '' }}>
    Science Fiction
</option>

<option value="Fantasy" {{ old('genre') == 'Fantasy' ? 'selected' : '' }}>
    Fantasy
</option>

<option value="Horror" {{ old('genre') == 'Horror' ? 'selected' : '' }}>
    Horror
</option>

<option value="Crime" {{ old('genre') == 'Crime' ? 'selected' : '' }}>
    Crime
</option>

<option value="Psychological Fiction" {{ old('genre') == 'Psychological Fiction' ? 'selected' : '' }}>
    Psychological Fiction
</option>

<option value="Drama" {{ old('genre') == 'Drama' ? 'selected' : '' }}>
    Drama
</option>

<option value="Comedy" {{ old('genre') == 'Comedy' ? 'selected' : '' }}>
    Comedy
</option>

<option value="Satire" {{ old('genre') == 'Satire' ? 'selected' : '' }}>
    Satire
</option>

<option value="Dystopian" {{ old('genre') == 'Dystopian' ? 'selected' : '' }}>
    Dystopian
</option>

<option value="Biography & Memoir" {{ old('genre') == 'Biography & Memoir' ? 'selected' : '' }}>
    Biography & Memoir
</option>

<option value="Young Adult (YA)" {{ old('genre') == 'Young Adult (YA)' ? 'selected' : '' }}>
    Young Adult (YA)
</option>

<option value="Business Administration" {{ old('genre') == 'Business Administration' ? 'selected' : '' }}>
    Business Administration
</option>

<option value="BBA" {{ old('genre') == 'BBA' ? 'selected' : '' }}>
    BBA
</option>

<option value="Commerce" {{ old('genre') == 'Commerce' ? 'selected' : '' }}>
    Commerce
</option>

<option value="Accounting" {{ old('genre') == 'Accounting' ? 'selected' : '' }}>
    Accounting
</option>

<option value="Finance" {{ old('genre') == 'Finance' ? 'selected' : '' }}>
    Finance
</option>

<option value="Banking" {{ old('genre') == 'Banking' ? 'selected' : '' }}>
    Banking
</option>

<option value="Marketing" {{ old('genre') == 'Marketing' ? 'selected' : '' }}>
    Marketing
</option>

<option value="Management" {{ old('genre') == 'Management' ? 'selected' : '' }}>
    Management
</option>

<option value="Economics" {{ old('genre') == 'Economics' ? 'selected' : '' }}>
    Economics
</option>

<option value="Human Resource Management" {{ old('genre') == 'Human Resource Management' ? 'selected' : '' }}>
    Human Resource Management
</option>

<option value="Entrepreneurship" {{ old('genre') == 'Entrepreneurship' ? 'selected' : '' }}>
    Entrepreneurship
</option>

<option value="International Business" {{ old('genre') == 'International Business' ? 'selected' : '' }}>
    International Business
</option>

<option value="Law" {{ old('genre') == 'Law' ? 'selected' : '' }}>
    Law
</option>

<option value="Sociology" {{ old('genre') == 'Sociology' ? 'selected' : '' }}>
    Sociology
</option>

<option value="Psychology" {{ old('genre') == 'Psychology' ? 'selected' : '' }}>
    Psychology
</option>

<option value="Political Science" {{ old('genre') == 'Political Science' ? 'selected' : '' }}>
    Political Science
</option>

<option value="English Literature" {{ old('genre') == 'English Literature' ? 'selected' : '' }}>
    English Literature
</option>

<option value="Communication" {{ old('genre') == 'Communication' ? 'selected' : '' }}>
    Communication
</option>

<option value="Education" {{ old('genre') == 'Education' ? 'selected' : '' }}>
    Education
</option>

<option value="History" {{ old('genre') == 'History' ? 'selected' : '' }}>
    History
</option>

<option value="Geography" {{ old('genre') == 'Geography' ? 'selected' : '' }}>
    Geography
</option>

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">
                            Quantity
                        </label>

                        <input type="number"
                               name="quantity"
                               value="{{ old('quantity') }}"
                               class="form-control"
                               min="1"
                               max="9999"
                               required>
                    </div>

                </div>

                <!-- Book Details -->
<div class="row">

    <!-- Serial No -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Serial No
        </label>

        <input
            type="text"
            name="serial_no"
            value="{{ old('serial_no') }}"
            class="form-control"
            placeholder="Leave blank to auto-generate">
    </div>

    <!-- ISBN -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            ISBN
        </label>

        <input
            type="text"
            name="isbn"
            value="{{ old('isbn') }}"
            class="form-control"
            placeholder="Enter ISBN">
    </div>

</div>

<div class="row">

    <!-- Language -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Language
        </label>

        <input
            type="text"
            name="language"
            value="{{ old('language') }}"
            class="form-control"
            placeholder="Enter Language">
    </div>

</div>


<div class="row">

    <!-- Publisher -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Publisher
        </label>

        <input
            type="text"
            name="publisher"
            value="{{ old('publisher') }}"
            class="form-control"
            placeholder="Enter Publisher">
    </div>

    <!-- Publication Year -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Publication Year
        </label>

        <input
            type="number"
            name="publication_year"
            value="{{ old('publication_year') }}"
            class="form-control"
            min="1000"
            max="9999"
            placeholder="e.g. 2024">
    </div>

</div>


<div class="row">

    <!-- Printing No -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Printing No.
        </label>

        <input
            type="text"
            name="printing_no"
            value="{{ old('printing_no') }}"
            class="form-control"
            placeholder="e.g. 1st Printing">
    </div>

    <!-- Publication Place -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Publication Place
        </label>

        <input
            type="text"
            name="publication_place"
            value="{{ old('publication_place') }}"
            class="form-control"
            placeholder="Enter Publication Place">
    </div>

</div>


<div class="row">

    <!-- Shelf Location -->
    <div class="col-md-6 mb-3">
        <label class="font-weight-bold">
            Shelf Location
        </label>

        <input
            type="text"
            name="shelf_location"
            value="{{ old('shelf_location') }}"
            class="form-control"
            placeholder="e.g. Shelf A-12">
    </div>

</div>

<div class="mb-3">

    <label class="font-weight-bold">
        Book Abstract
    </label>

    <textarea
        name="book_abstract"
        class="form-control"
        rows="5"
        placeholder="Enter book abstract">{{ old('book_abstract') }}</textarea>

</div>

<div class="mb-3">

    <label class="font-weight-bold">
        Table of Contents
    </label>

    <textarea
        name="table_of_contents"
        class="form-control"
        rows="8"
        placeholder="Enter chapters and topics">{{ old('table_of_contents') }}</textarea>

    <small class="text-muted">
        Example: Chapter 1 - Introduction, 1.1 Basic Concepts, 1.2 Applications
    </small>

</div>

<div class="card border-left-primary shadow-sm mb-4">

    <div class="card-header bg-light">

        <h6 class="m-0 font-weight-bold"
            style="color: rgb(32, 92, 232);">

            <i class="fas fa-images mr-2"></i>
            Sample of Book Preview

        </h6>

    </div>


    <div class="card-body">

        <div class="row">

            <!-- Cover Page -->
            <div class="col-md-6 mb-4">

                <label class="font-weight-bold">
                    Cover Page
                </label>

                <input
                    type="file"
                    name="preview_cover"
                    class="form-control"
                    accept="image/*">

            </div>


            <!-- Page 1 -->
            <div class="col-md-6 mb-4">

                <label class="font-weight-bold">
                    Page 1
                </label>

                <input
                    type="file"
                    name="preview_page_1"
                    class="form-control"
                    accept="image/*">

            </div>


            <!-- Page 2 -->
            <div class="col-md-6 mb-4">

                <label class="font-weight-bold">
                    Page 2
                </label>

                <input
                    type="file"
                    name="preview_page_2"
                    class="form-control"
                    accept="image/*">

            </div>


            <!-- Page 3 -->
            <div class="col-md-6 mb-4">

                <label class="font-weight-bold">
                    Page 3
                </label>

                <input
                    type="file"
                    name="preview_page_3"
                    class="form-control"
                    accept="image/*">

            </div>


            <!-- Page 4 -->
            <div class="col-md-6 mb-3">

                <label class="font-weight-bold">
                    Page 4
                </label>

                <input
                    type="file"
                    name="preview_page_4"
                    class="form-control"
                    accept="image/*">

            </div>

        </div>

        <small class="text-muted">
            Upload the cover page and first four pages of the book as images.
        </small>

    </div>

</div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            Past Edition Details
                        </label>

                        <textarea name="past_edition"
                                  class="form-control"
                                  rows="3"></textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            New Edition Details
                        </label>

                        <textarea name="new_edition"
                                  class="form-control"
                                  rows="3"></textarea>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="font-weight-bold">
                        Book Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            Upload Book Cover
                        </label>

                        <input type="file"
       name="photo"
       id="photo"
       class="form-control"
       accept="image/*">

       <div class="mt-3 text-center">

    <img
        id="previewImage"
        src="https://via.placeholder.com/150x200?text=Book+Cover"
        width="150"
        height="200"
        class="shadow rounded"
        style="object-fit:cover;">

</div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="font-weight-bold">
                            Upload Time
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ now() }}"
                               readonly>

                    </div>

                </div>

                <div class="text-right border-top pt-3">

                    <a href="{{ route('admin.dashboard') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-times"></i>
                        Cancel

                    </a>

                    <button type="submit"
                            class="btn btn-success">

                        <i class="fas fa-save"></i>
                        Save Book

                    </button>

    

                </div>

            </form>

        </div>

    </div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<script>
document.getElementById("photo").addEventListener("change", function (e) {

    let reader = new FileReader();

    reader.onload = function () {

        document.getElementById("previewImage").src = reader.result;

    };

    if (e.target.files[0]) {
        reader.readAsDataURL(e.target.files[0]);
    }

});
</script>
</body>
</html>