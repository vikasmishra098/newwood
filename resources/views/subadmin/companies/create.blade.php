@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Company</h2>

    <form action="{{ route('subadmin.companies.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

            <input type="hidden" name="comservicehidden" id="comservicehidden" value="1">

        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Customer Phone</label>
            <input type="text" name="customer_phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Machine Name</label>
            <input type="text" name="cosmachinename" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="cos_address" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Machine Detail</label>
            <input type="text" name="cosmachinedetail" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Spare Parts</label>
            <input type="text" name="cosspareparts" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Spare Parts Required</label>
            <input type="text" name="cossparepartsrequired" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="cosstatus" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="Pending">Pending</option>
                <option value="Process">Process</option>
                <option value="Done">Done</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
