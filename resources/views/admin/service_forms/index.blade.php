@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Service Requests</h2>

    @if($serviceForms->count())
 <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Requirement</th>
                    <th>Selected Services</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serviceForms as $index => $form)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $form->service_name }}</td>
                        <td>{{ $form->service_email }}</td>
                        <td>{{ $form->service_phone }}</td>
                        <td>{{ $form->service_requirement }}</td>
                        <td>{{ $form->service_check }}</td>
                        <td>{{ $form->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>
        {{ $serviceForms->links() }}
    @else
        <p>No service requests found.</p>
    @endif
</div>
@endsection
