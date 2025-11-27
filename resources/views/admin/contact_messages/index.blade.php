@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contact Form Submissions</h2>
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $index => $msg)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->phone_client }}</td>
                <td>{{ $msg->message }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

     <!-- Pagination -->
    <nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>

    {{ $messages->links() }}
</div>
@endsection
