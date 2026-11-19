<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            background-image: url("{{ asset('images/Background.jpg') }}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .return-container {
            max-width: 950px;
            margin: 40px auto;
        }

        .return-header {
            background: rgb(32, 92, 232);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 22px 25px;
        }

        .return-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .return-option {
            border: 2px solid #e3e6f0;
            border-radius: 12px;
            padding: 22px;
            text-align: center;
            cursor: pointer;
            height: 100%;
            transition: all 0.2s ease-in-out;
            background: white;
        }

        .return-option:hover {
            border-color: rgb(32, 92, 232);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .return-option.active {
            border-color: rgb(32, 92, 232);
            box-shadow: 0 5px 18px rgba(32, 92, 232, 0.2);
            background-color: #f8faff;
        }

        .return-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 25px;
        }

        .normal-icon {
            background: #e8f5e9;
            color: #28a745;
        }

        .overdue-icon {
            background: #fff3cd;
            color: #f0ad00;
        }

        .damaged-icon {
            background: #f8d7da;
            color: #dc3545;
        }

        .return-option h5 {
            font-weight: 700;
            margin-bottom: 7px;
        }

        .return-option p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        .form-section {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e3e6f0;
        }

        .late-info {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            padding: 15px;
        }

        .damage-info {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
        }

        .total-box {
            background: #e9f2ff;
            border: 1px solid rgb(32, 92, 232);
            border-radius: 8px;
            padding: 15px;
        }

        .total-box h5 {
            color: rgb(32, 92, 232);
            font-weight: 700;
            margin: 0;
        }

        .hidden-section {
            display: none;
        }
    </style>
</head>

<body>

<div class="container return-container">
    <div class="card shadow">
        
        <!-- Header -->
        <div class="return-header">
            <h4>
                <i class="fas fa-undo mr-2"></i> Return Book
            </h4>
        </div>

        <div class="card-body p-4">

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- RETURN TYPE OPTIONS -->
            <div class="row">
                <!-- Normal -->
                <div class="col-md-4 mb-3">
                    <div class="return-option" id="normalOption" onclick="selectReturnType('normal', true)">
                        <div class="return-icon normal-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <h5>Normal Return</h5>
                        <p>Return book normally without late fee.</p>
                    </div>
                </div>

                <!-- Overdue -->
                <div class="col-md-4 mb-3">
                    <div class="return-option" id="overdueOption" onclick="selectReturnType('overdue', true)">
                        <div class="return-icon overdue-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Overdue Return</h5>
                        <p>Late return with ৳5/day late fee.</p>
                    </div>
                </div>

                <!-- Damaged -->
                <div class="col-md-4 mb-3">
                    <div class="return-option" id="damagedOption" onclick="selectReturnType('damaged', true)">
                        <div class="return-icon damaged-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h5>Damaged Return</h5>
                        <p>Book price + late fee if applicable.</p>
                    </div>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('return.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="return_type" id="return_type" value="normal">

                <div class="form-section">

                    <!-- Issued Book -->
                    <div class="mb-3">
                        <label class="font-weight-bold">Issued Book</label>
                        <select name="issue_id" id="issue_id" class="form-control" required>
                            <option value="">Select Issued Book</option>
                            @foreach($issues as $issue)
                                <option value="{{ $issue->id }}"
                                        data-deadline="{{ $issue->return_deadline }}"
                                        data-price="{{ $issue->book->price ?? 0 }}">
                                    {{ $issue->user->name }} - {{ $issue->book->title }} - Edition: {{ $issue->book->edition ?? 'N/A' }} - ISBN: {{ $issue->book->isbn ?? 'N/A' }} - Issue ID: {{ $issue->id }} - Book ID: {{ $issue->book_id }} - Due: {{ $issue->return_deadline }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Return Date -->
                    <div class="mb-3">
                        <label class="font-weight-bold">Actual Return Date</label>
                        <input type="date" name="actual_return_date" id="actual_return_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- OVERDUE SECTION -->
                    <div id="overdueSection" class="hidden-section">
                        <div class="late-info mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Return Deadline: </strong>
                                    <span id="deadlineText">-</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Late Days: </strong>
                                    <span id="lateDays">0</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Late Fee: </strong>
                                    <span>৳<span id="lateFeeText">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="fine" id="fine" value="0">

                    <!-- DAMAGED SECTION -->
                    <div id="damagedSection" class="hidden-section">
                        <div class="damage-info mb-3">
                            <h6 class="font-weight-bold text-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Damaged Book Information
                            </h6>
                            <p class="mb-0">Damaged books will be removed from the library quantity.</p>
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Book Price (Tk)</label>
                            <input type="number" name="book_price" id="book_price" class="form-control" min="0" step="0.01" value="0">
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Damaged Book Photo</label>
                            <input type="file" name="damage_photo" class="form-control" accept="image/*">
                            <small class="text-muted">Upload a clear photo of the damaged book.</small>
                        </div>

                        <div class="total-box mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <small>Book Price</small>
                                    <h6>৳<span id="bookPriceText">0</span></h6>
                                </div>
                                <div class="col-md-4">
                                    <small>Late Fee</small>
                                    <h6>৳<span id="damageLateFeeText">0</span></h6>
                                </div>
                                <div class="col-md-4">
                                    <small>Total Payable</small>
                                    <h5>৳<span id="totalPayable">0</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fine Status -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Fine Status</label>
                        <select name="fine_paid" class="form-control" required>
                            <option value="0">Not Paid</option>
                            <option value="1">Paid</option>
                        </select>
                    </div>

                    <!-- Notice -->
                    <div class="mb-3">
                        <label class="font-weight-bold">Notice</label>
                        <textarea name="notice" class="form-control" rows="3" placeholder="Write any notice..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="text-right border-top pt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-undo mr-1"></i> Return Book
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<script>
    const LATE_FEE_PER_DAY = 5;
    let userManuallySelectedType = false;

    function selectReturnType(type, isManual = false) {
        if (isManual) {
            userManuallySelectedType = true;
        }

        document.getElementById('return_type').value = type;

        document.querySelectorAll('.return-option').forEach(el => el.classList.remove('active'));
        document.getElementById(type + 'Option').classList.add('active');

        document.getElementById('overdueSection').classList.add('hidden-section');
        document.getElementById('damagedSection').classList.add('hidden-section');

        const lateFee = calculateLateFee();

        if (type === 'normal') {
            document.getElementById('fine').value = 0;
        } else if (type === 'overdue') {
            document.getElementById('overdueSection').classList.remove('hidden-section');
            document.getElementById('fine').value = lateFee;
        } else if (type === 'damaged') {
            document.getElementById('damagedSection').classList.remove('hidden-section');
            document.getElementById('fine').value = lateFee;
            calculateTotal();
        }
    }

    function calculateLateFee() {
        const selected = document.getElementById('issue_id').selectedOptions[0];

        if (!selected || !selected.dataset.deadline) {
            resetFeeDisplay();
            return 0;
        }

        const deadlineDateStr = selected.dataset.deadline;
        const actualDateStr = document.getElementById('actual_return_date').value;

        if (!actualDateStr) {
            resetFeeDisplay();
            return 0;
        }

        // Normalize dates to midnight to prevent time difference issues
        const deadline = new Date(deadlineDateStr);
        deadline.setHours(0, 0, 0, 0);

        const actualDate = new Date(actualDateStr);
        actualDate.setHours(0, 0, 0, 0);

        const difference = actualDate.getTime() - deadline.getTime();
        let lateDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
        if (lateDays < 0) lateDays = 0;

        const lateFee = lateDays * LATE_FEE_PER_DAY;

        document.getElementById('deadlineText').innerText = deadlineDateStr;
        document.getElementById('lateDays').innerText = lateDays;
        document.getElementById('lateFeeText').innerText = lateFee;
        document.getElementById('damageLateFeeText').innerText = lateFee;

        // Auto-switch return type if not manually set by user
        if (!userManuallySelectedType) {
            const currentType = document.getElementById('return_type').value;
            if (currentType !== 'damaged') {
                if (lateDays > 0) {
                    selectReturnType('overdue', false);
                } else {
                    selectReturnType('normal', false);
                }
            }
        }

        return lateFee;
    }

    function calculateTotal() {
        const bookPrice = parseFloat(document.getElementById('book_price').value) || 0;
        const lateFee = parseFloat(document.getElementById('damageLateFeeText').innerText) || 0;
        const total = bookPrice + lateFee;

        document.getElementById('bookPriceText').innerText = bookPrice.toFixed(2);
        document.getElementById('totalPayable').innerText = total.toFixed(2);
    }

    function resetFeeDisplay() {
        document.getElementById('lateDays').innerText = 0;
        document.getElementById('lateFeeText').innerText = 0;
        document.getElementById('damageLateFeeText').innerText = 0;
        document.getElementById('fine').value = 0;
    }

    // Event Listeners
    document.getElementById('issue_id').addEventListener('change', function() {
        userManuallySelectedType = false; // Reset manual override on new book select
        const selected = this.selectedOptions[0];
        
        if (selected && selected.dataset.price) {
            document.getElementById('book_price').value = selected.dataset.price;
        } else {
            document.getElementById('book_price').value = 0;
        }

        calculateLateFee();
        calculateTotal();
    });

    document.getElementById('actual_return_date').addEventListener('change', function() {
        calculateLateFee();
        calculateTotal();
    });

    document.getElementById('book_price').addEventListener('input', function() {
        calculateTotal();
    });

    // Initialize Page State
    selectReturnType('normal');
</script>

</body>
</html>