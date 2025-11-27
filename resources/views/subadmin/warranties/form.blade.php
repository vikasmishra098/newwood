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
</div>
