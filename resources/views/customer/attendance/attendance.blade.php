@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">In Service Attendance</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="attendanceForm" method="POST" action="{{ route('attendance.store') }}">
        @csrf
        
<div class="mb-3">
    <label for="employee_id" class="form-label">Employee Work Report</label>
    <select name="employee_id" id="employee_id" class="form-select" required onchange="checkStatus(this)">
        <option value="">-- Select Report --</option>

        

        <!-- ✅ Dynamic options from employees -->
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}"
                data-date="{{ $employee->date }}"
                data-time="{{ $employee->time }}">
                Company Name - {{ $employee->company->name ?? 'N/A' }} / Date - {{ $employee->date }} {{ $employee->time }}
            </option>
        @endforeach
    </select>
</div>










        <input type="hidden" name="photo" id="photo">
        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        <input type="hidden" name="location" id="location" value="">
    
        <input type="hidden" name="datetime" id="datetime">

        <div class="text-center mb-3">
            <video id="video" autoplay class="rounded shadow" style="width: 100%; max-width: 300px; display: none;"></video>
            <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
        </div>

        <div class="d-flex justify-content-center gap-3 mb-4">
            <button type="button" onclick="startCamera()" class="btn btn-primary rounded-pill">
                ðŸ“· Start Camera
            </button>
            <button type="button" onclick="captureAndSubmit()" class="btn btn-success rounded-pill">
                ðŸ’¾ Capture & Submit
            </button>
        </div>
    </form>
</div>

<script>
    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');
    let streamRef = null;

    function startCamera() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                streamRef = stream;
                video.style.display = "block";
                video.srcObject = stream;

                // Set location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        let lat = position.coords.latitude;
                        let long = position.coords.longitude;
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}`)
                            .then(res => res.json())
                            .then(data => {
                                document.getElementById('location').value = data.display_name || `${lat},${long}`;
                            });
                    });
                }

                // Set datetime in local IST format
                setLocalDateTime();
            }).catch(err => {
                alert("Camera access denied.");
            });
    }

    function setLocalDateTime() {
        let now = new Date();
        let localDatetime = now.getFullYear() + "-" +
            String(now.getMonth() + 1).padStart(2, '0') + "-" +
            String(now.getDate()).padStart(2, '0') + " " +
            String(now.getHours()).padStart(2, '0') + ":" +
            String(now.getMinutes()).padStart(2, '0') + ":" +
            String(now.getSeconds()).padStart(2, '0');

        document.getElementById('datetime').value = localDatetime;
    }

    function captureAndSubmit() {
        if (!video.srcObject) {
            alert("Please start the camera first.");
            return;
        }

        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        let imageData = canvas.toDataURL('image/png');
        document.getElementById('photo').value = imageData;

        if (streamRef) {
            streamRef.getTracks().forEach(track => track.stop());
        }
        video.style.display = "none";

        document.getElementById('attendanceForm').submit();
    }
</script>
@endsection
