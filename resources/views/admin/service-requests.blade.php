@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Service Form Submissions</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Requirements</th><th>Services</th><th>Submitted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
                <tr>
                    <td>{{ $req->service_name }}</td>
                    <td>{{ $req->service_email }}</td>
                    <td>{{ $req->service_phone }}</td>
                    <td>{{ $req->service_requirement }}</td>
                    <td>{{ $req->service_check }}</td>
                    <td>{{ $req->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
