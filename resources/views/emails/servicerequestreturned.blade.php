<h2>Service Request Returned</h2>

<p>Your vehicle service request has been returned by the Transport Officer.</p>

<p><strong>Vehicle:</strong> {{ $servicerequest->reg_no }}</p>

<p><strong>Inspection Comments:</strong></p>
<p>{{ $servicerequest->inspection_findings }}</p>

<p>
    Please edit your request using the link below:
</p>

<a href="{{ route('servicerequests.edit',$servicerequest->id) }}">
    Edit Service Request
</a>

<p>Thank you.</p>