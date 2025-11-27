@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Employee</h2>

    <form action="{{ route('admin.employee.store') }}" method="POST">
        @csrf

        <input type="hidden" name="customer_id" value="{{ $customer_id }}">

        <!-- Company -->
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control" required>
                <option value="">-- Select Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select User -->
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" data-phone="{{ $user->user_phone_number }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Auto-fill Phone -->
        <div class="form-group">
            <label>User Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" readonly>
        </div>

        <!-- Employee Name -->
        <div class="form-group">
            <label>Employee Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <!-- Designation -->
        <div class="form-group">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control">
        </div>

        <!-- Address -->
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <!-- Date -->
        <div class="form-group" id="dateContainer">
            <label>Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

        <!-- Toggle Button -->
        <button type="button" id="toggleDateBtn" class="btn btn-secondary mt-2">Hide Date</button>

        <!-- Time -->
        <div class="form-group mt-3">
            <label>Time</label>
            <input type="time" name="time" class="form-control" value="{{ date('H:i') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Employee & Send WhatsApp</button>
    </form>
</div>

<script>
    // Auto-fill phone when user is selected
    document.getElementById('user_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const phone = selectedOption.getAttribute('data-phone') || '';
        document.getElementById('phone').value = phone;
    });

    // Toggle Date visibility + value
    const toggleBtn = document.getElementById('toggleDateBtn');
    const dateContainer = document.getElementById('dateContainer');
    const dateInput = document.getElementById('date');
    let savedDate = dateInput.value; // store initial date

    toggleBtn.addEventListener('click', function() {
        if (dateContainer.style.display === 'none') {
            // Show date field
            dateContainer.style.display = 'block';
            dateInput.value = savedDate; // restore previous date
            this.textContent = 'Hide Date';
        } else {
            // Hide date field
            savedDate = dateInput.value; // remember current date
            dateInput.value = ''; // send null value
            dateContainer.style.display = 'none';
            this.textContent = 'Show Date';
        }
    });
</script>
@endsection
