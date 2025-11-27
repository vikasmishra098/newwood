@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mark Logout Attendance</h2>

    <form id="logoutForm" method="POST" action="{{ route('attendance.logout') }}">
        @csrf
        <input type="hidden" name="photo" id="photo">
        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        <input type="hidden" name="location" id="location">
        <input type="hidden" name="datetime" id="datetime">

        <button type="button" onclick="startCamera()">📷</button>
        <button type="button" onclick="captureAndSubmit()">💾</button>

        <br><br>
        <video id="video" autoplay style="width: 320px; height: 240px; display: none;"></video>
        <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
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

            // Get location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    let lat = position.coords.latitude;
                    let long = position.coords.longitude;
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}`)
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('location').value = data.display_name || (lat + "," + long);
                        });
                });
            }

            document.getElementById('datetime').value = new Date().toISOString();
        }).catch(err => {
            alert("Camera access denied.");
        });
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
        document.getElementById('logoutForm').submit();
    }
</script>
@endsection
