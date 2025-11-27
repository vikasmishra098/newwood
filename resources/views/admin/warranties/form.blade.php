@php
    $w = isset($warranty) ? $warranty : null;
@endphp

<div class="row">
    <div class="col-md-6">
        <label>Company Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $w->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label>Machine Name</label>
        <input type="text" name="email" class="form-control" value="{{ old('email', $w->email ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label>Date</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $w->address ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Machine Serial Number</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $w->city ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Required Parts</label>
        <input type="text" name="state" class="form-control" value="{{ old('state', $w->state ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Receive parts</label>
        <input type="text" name="pin" class="form-control" value="{{ old('pin', $w->pin ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Start Time</label>
        <input type="text" name="dealer_name" class="form-control" value="{{ old('dealer_name', $w->dealer_name ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>End Time</label>
        <input type="text" name="dealer_email" class="form-control" value="{{ old('dealer_email', $w->dealer_email ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Message</label>
        <input type="text" name="dealer_phone" class="form-control" value="{{ old('dealer_phone', $w->dealer_phone ?? '') }}">
    </div>
    <!--div class="col-md-6">
        <label>Dealer Address</label>
        <input type="text" name="dealer_address" class="form-control" value="{{ old('dealer_address', $w->dealer_address ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Dealer City</label>
        <input type="text" name="dealer_city" class="form-control" value="{{ old('dealer_city', $w->dealer_city ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Dealer State</label>
        <input type="text" name="dealer_state" class="form-control" value="{{ old('dealer_state', $w->dealer_state ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>PPF Category</label>
        <input type="text" name="ppf_category" class="form-control" value="{{ old('ppf_category', $w->ppf_category ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Chassis No</label>
        <input type="text" name="chassis_no" class="form-control" value="{{ old('chassis_no', $w->chassis_no ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', $w->model ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Year</label>
        <input type="text" name="year" class="form-control" value="{{ old('year', $w->year ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Vehicle Number</label>
        <input type="text" name="vehicle_number" class="form-control" value="{{ old('vehicle_number', $w->vehicle_number ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Package</label>
        <input type="text" name="package" class="form-control" value="{{ old('package', $w->package ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Warranty</label>
        <input type="text" name="warranty" class="form-control" value="{{ old('warranty', $w->warranty ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Replacement Warranty</label>
        <input type="text" name="replacement_warranty" class="form-control" value="{{ old('replacement_warranty', $w->replacement_warranty ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Validity</label>
        <input type="text" name="validity" class="form-control" value="{{ old('validity', $w->validity ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Date</label>
        <input type="date" name="date" class="form-control" value="{{ old('date', $w->date ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Mobile Number</label>
        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $w->mobile_number ?? '') }}">
    </div-->
</div>
