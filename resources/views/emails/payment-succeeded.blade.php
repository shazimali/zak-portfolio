<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: 'Outfit', 'Inter', sans-serif, Arial;
            background-color: #f7f9fc;
            color: #1e293b;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }
        h1 {
            color: #0f172a;
            font-size: 28px;
            font-weight: 700;
            margin-top: 0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #475569;
        }
        .subscription-details {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            border: 1px dashed #cbd5e1;
        }
        .subscription-details h3 {
            margin-top: 0;
            font-size: 18px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .detail-row {
            margin-bottom: 10px;
            display: flex;
            align-items: baseline;
        }
        .detail-row span.label {
            font-weight: 600;
            width: 100px;
            display: inline-block;
            color: #64748b;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }
        .button-cancel {
            display: inline-block;
            background-color: transparent;
            color: #ef4444 !important;
            text-decoration: underline;
            padding: 10px 0;
            font-weight: 500;
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p>Hi there,</p>
        <p>Thank you for subscribing to Designjoy. We are thrilled to have you on board! Your payment has been successfully processed, and your subscription is now active.</p>
        
        <div class="subscription-details">
            <h3>Subscription Details</h3>
            <div class="detail-row">
                <span class="label">Plan:</span> {{ $title }}
            </div>
            <div class="detail-row">
                <span class="label">Features:</span> {{ $description }}
            </div>
            <div class="detail-row">
                <span class="label">Price:</span> {{ $price }}
            </div>
        </div>

        <p>If you have any questions, feel free to reply to this email.</p>

        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ $cancelUrl }}" class="button">Manage Subscription</a>
            <br>
            <a href="{{ $cancelUrl }}" class="button-cancel">Cancel Subscription</a>
        </div>
    </div>
    <div class="footer">
        © {{ date('Y') }} Designjoy. All rights reserved.
    </div>
</body>
</html>
