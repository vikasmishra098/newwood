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
    

   </div>
