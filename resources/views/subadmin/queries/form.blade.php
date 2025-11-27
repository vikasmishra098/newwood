<div class="mb-3">
    <label>Send To</label>
    <select name="notify_to" class="form-control" required>
    <option value="admin" {{ old('notify_to', $query->notify_to)=='admin'?'selected':'' }}>Admin (9266666624)</option>
    <option value="subadmin" {{ old('notify_to', $query->notify_to)=='subadmin'?'selected':'' }}>Subadmin (9312328996)</option>
</select>

</div>

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="qname" class="form-control" value="{{ old('qname', $query->qname ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="qemail" class="form-control" value="{{ old('qemail', $query->qemail ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="qphone" class="form-control" value="{{ old('qphone', $query->qphone ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="qcar" class="form-control" value="{{ old('qcar', $query->qcar ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Comment</label>
    <textarea name="qcomment" class="form-control">{{ old('qcomment', $query->qcomment ?? '') }}</textarea>
</div>


<div class="mb-3">
    <label>Follow</label>
    <input type="text" name="qfollow" class="form-control" value="{{ old('qfollow', $query->qfollow ?? '') }}">
</div>

<div class="mb-3">
    <label>Target Date</label>
    <input type="date" name="qtarget_date" class="form-control"
           value="{{ old('qtarget_date', $query->qtarget_date ?? '') }}">
</div>


<div class="mb-3">
    <label>Priority</label>
    <select name="qpriority" class="form-control">
        @foreach(['Low', 'Medium', 'High'] as $level)
            <option value="{{ $level }}" {{ old('qpriority', $query->qpriority ?? 'Medium') == $level ? 'selected' : '' }}>{{ $level }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="qstatus" class="form-control">
        @foreach(['Open', 'In Progress', 'Closed'] as $status)
            <option value="{{ $status }}" {{ old('qstatus', $query->qstatus ?? 'Open') == $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </select>
</div>
