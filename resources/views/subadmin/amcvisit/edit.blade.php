@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Amc</h2>

    <form action="{{ route('subadmin.amcvisit.update', $company->id) }}" method="POST">
         @csrf
    @method('PUT')

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" name="customer_name" value="{{ $company->customer_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Customer Phone</label>
            <input type="text" name="customer_phone" value="{{ $company->customer_phone }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Machine Name</label>
            <input type="text" name="cosmachinename" value="{{ $company->cosmachinename }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="cos_address" value="{{ $company->cos_address }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Machine Detail</label>
            <input type="text" name="cosmachinedetail" value="{{ $company->cosmachinedetail }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Spare Parts</label>
            <input type="text" name="cosspareparts" value="{{ $company->cosspareparts }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Spare Parts Required</label>
            <input type="text" name="cossparepartsrequired" value="{{ $company->cossparepartsrequired }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="cosstatus" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="Pending" {{ $company->cosstatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Process" {{ $company->cosstatus == 'Process' ? 'selected' : '' }}>Process</option>
                <option value="Done" {{ $company->cosstatus == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
