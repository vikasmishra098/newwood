@extends('layouts.app')

@section('content')
<div class="container mt-4">

    

    <div class="card shadow-sm rounded p-4 mb-4">
    
    <div class="text-center mb-4">
        
    <img src="https://www.woodedgetooling.com/admin/uploads/logo.png" alt="Company Logo" class="mb-3" style="max-height: 100px;">    
    </div>
    
        
        <div class="row mb-2">
            <div class="col-md-6">
                <h3 class = "text-primary">Employee Details</h3><br>
                <strong>ID:</strong> Wood{{ $user->id }}<br>
                <strong>Name:</strong> {{ $user->name }}<br>
                
            <strong>Email:</strong> {{ $user->email }}
            
            </div>
            <div class="col-md-6">
                <h3 class = "text-primary">Company Details</h3><br>
            <strong>Company:</strong> Wood Edge Tooling<br>
            <strong>Address:</strong> Ground Floor, Breja Sadan, near jkm tyre gali, near JKM Tyre, Badarpur, New Delhi, Delhi 110044<br>
            <strong>Phone:</strong> 9312328996<br>

            </div>
        </div>
        <!--div class="row mb-2">
            <div class="col-md-6"></div>
            
            <div class="col-md-6"><strong>Mobile:</strong> </div>
        </div-->
        
    </div>

    <div class="card shadow-sm rounded p-4">

    <div class = "row">

 <div class = "col-md-6">
        <h4 class="mb-3 text-danger">Company Service</h4>
        <ul class="mb-0">
            <li>Machine maintenance service in New Delhi</li>
            <li>"All wooden machine service, spare parts, plc automation , sale and purchase old and new all wooden machine We have experienced service team ex-Homag and ex-biesse For MC service will be available within max 72hrs"
</li>
            
        </ul>
</div>

        <div class = "col-md-6">
        <h4 class="mb-3 text-danger">Company Terms & Conditions</h4>
        <ul class="mb-0">
            <li>All tools are subject to warranty as per company policy.</li>
            <li>Service is available only on genuine product claims with proof of purchase.</li>
            <li>Any damage due to misuse or third-party repair voids the warranty.</li>
            <li>WoodEdge Tooling reserves the right to revise these terms anytime.</li>
            <li>All disputes are subject to Delhi jurisdiction only.</li>
        </ul>
</div>
</div>

    </div>

</div>
@endsection
