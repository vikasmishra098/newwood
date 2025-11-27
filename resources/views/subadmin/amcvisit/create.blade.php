@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New AMC</h2>

    <form action="{{ route('subadmin.amcvisit.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        
        <input type="hidden" name="comservicehidden" id="comservicehidden" value="2">

        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="customer_phone">Customer Phone</label>
            <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cosmachinename">Machine Name</label>
            <input type="text" name="cosmachinename" id="cosmachinename" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cos_address">Address</label>
            <input type="text" name="cos_address" id="cos_address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cosmachinedetail">Machine Detail</label>
            <input type="text" name="cosmachinedetail" id="cosmachinedetail" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cosspareparts">Spare Parts</label>
            <input type="text" name="cosspareparts" id="cosspareparts" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cossparepartsrequired">Spare Parts Required</label>
            <input type="text" name="cossparepartsrequired" id="cossparepartsrequired" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cosstatus">Status</label>
            <select name="cosstatus" id="cosstatus" class="form-control" required>
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
