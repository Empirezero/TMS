<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Service Request - {{ $servicerequest->reference_no }}</title>
    <style>
        @page {
            margin: 1.2cm 1.5cm;
        }

        body {
            font-family: 'Tw Cen MT', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #007a37;
            padding-bottom: 12px;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            height: 55px;
        }

        .title {
            font-size: 19px;
            font-weight: bold;
            color: #007a37;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-badge {
            position: absolute;
            right: 0;
            top: 5px;
            padding: 5px 12px;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            font-size: 11px;
        }

        .bg-approved {
            background-color: #007a37;
        }

        .bg-rejected {
            background-color: #b30000;
        }

        .bg-pending {
            background-color: #f1c40f;
            color: #000;
        }

        .section-title {
            background: #f0f9f4;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: bold;
            border-left: 5px solid #007a37;
            margin: 18px 0 10px;
            color: #004d23;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            table-layout: fixed;
        }

        td {
            padding: 10px;
            border: 1px solid #e1e1e1;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            color: #666;
            font-size: 10px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        .value {
            font-size: 12px;
            font-weight: bold;
            color: #111;
        }

        .box {
            border: 1px solid #e1e1e1;
            padding: 12px;
            background: #fafafa;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .signature-img {
            display: block;
            max-height: 60px;
            width: auto;
            margin: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .page-break {
            page-break-before: always;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <!-- PAGE 1: REQUEST DETAILS -->
    <div class="header">
        <img src="./imgs/logo.png" class="logo">
        <div class="title">MOTOR VEHICLE SERVICE & REPAIR REQUISITION FORM</div>
        <div class="status-badge bg-{{ $servicerequest->status }}">{{ $servicerequest->status }}</div>
    </div>

    <table>
        <tr>
            <td><span class="label">Reference Number</span><span class="value">{{ $servicerequest->reference_no }}</span></td>
            <td><span class="label">Submission Date</span><span class="value">{{ $servicerequest->request_date }}</span></td>
        </tr>
    </table>

    <div class="section-title">I. Vehicle Identification</div>
    <table>
        <tr>
            <td><span class="label">Registration No</span><span class="value">{{ $servicerequest->reg_no }}</span></td>
            <td><span class="label">Make & Model</span><span class="value">{{ $servicerequest->make }} {{ $servicerequest->model }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Previous Service Odometer</span><span class="value">{{ number_format($servicerequest->previous_km) }} KM</span></td>
            <td><span class="label">Current Odometer</span><span class="value">{{ number_format($servicerequest->current_km) }} KM</span></td>

        </tr>
        <tr>
            <td><span class="label">Current Driver</span><span class="value">{{ $servicerequest->assigned_driver }}</span></td>
            <td><span class="label">Service Station</span><span class="value">{{ $servicerequest->service_station }}</span></td>
        </tr>
    </table>

    <div class="section-title">II. Service Classification</div>
    <div class="box">
        <span class="label">Service Type</span>
        <span class="value">
            {{ ucfirst($servicerequest->service_type ?? 'N/A') }}
        </span>
        -
        <span class="value">
            {{ $servicerequest->service_type_other ?: 'Not specified' }}
        </span>
    </div>
    <div class="section-title">III. Detailed Description of Service</div>
    <div class="box" style="min-height: 140px;">
        <div style="font-size: 13px; line-height: 1.6;">{{ $servicerequest->description }}</div>
    </div>

    <div class="section-title">IV. Driver Declaration & Signature</div>
    <div style="padding: 5px 12px;">
        <span class="label">Driver Name</span>
        <span class="value">{{ $servicerequest->driver_name }}</span>
        @if($servicerequest->driver_signature)
        <img src="{{ $servicerequest->driver_signature }}" class="signature-img">
        @endif
        <div style="font-size: 10px; color: #777; margin-top: 5px;">Signed on: {{ $servicerequest->driver_date }}</div>
    </div>

    <div class="footer">Konza Technopolis | Corporate Services | Transport Division | Printed: {{ now()->format('d/m/Y H:i') }}</div>

</body>

</html>