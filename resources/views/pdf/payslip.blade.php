
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payslip</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        sup {
            font-size: 10px;
            font-weight: 600;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .header p {
            color: #6b7280;
            font-size: 14px;
        }

        .employee-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 6px;
        }

        .info-block p:first-child {
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .info-block p:nth-child(2) {
            color: #1f2937;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .earnings-deductions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            padding-bottom: 12px;
            margin-bottom: 20px;
            border-bottom: 3px solid;
        }

        .earnings .section-title {
            border-bottom-color: #3b82f6;
            color: #3b82f6;
        }

        .deductions .section-title {
            border-bottom-color: #ef4444;
            color: #ef4444;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        .item span:last-child {
            font-weight: 600;
            color: #1f2937;
        }

        .total-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            font-size: 15px;
            font-weight: 700;
            border-top: 2px solid #e5e7eb;
            margin-top: 10px;
            padding-top: 15px;
        }

        .earnings .total-item {
            color: #3b82f6;
        }

        .deductions .total-item {
            color: #ef4444;
        }

        .net-salary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            padding: 30px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .net-salary span:first-child {
            font-size: 18px;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }

        .net-salary span:last-child {
            font-size: 28px;
            font-weight: 700;
            color: white;
        }
    </style>
    </head>
    <body>

    <div class="container">
    <!-- Header -->
    <div class="header">
        <h1>PAYSLIP</h1>
        <p>{{ now()->format('F Y') }}</p>
    </div>

    <!-- Employee Info -->
    <div class="employee-info">
        <div class="info-block">
            <p>EMPLOYEE NAME</p>
            <p>{{ $salary->employee->name }}</p>
            <p>EMPLOYEE ID</p>
            <p>{{ sprintf('%04d',$salary->employee_id) }}</p>
        </div>
        <div class="info-block">
            <p>DESIGNATION</p>
            <p>{{ $salary->employee->designation->name }}</p>
        </div>
    </div>

    <!-- Earnings & Deductions -->
    <div class="earnings-deductions">
        <div class="earnings">
            <h3 class="section-title">Earnings</h3>
            <div class="item">
                <span>Gross Salary</span>
                <span><sup>KES</sup>{{ number_format($salary->gross_salary, 2) }}</span>
            </div>
            <div class="total-item">
                <span>Total Earnings</span>
                <span><sup>KES</sup>{{ number_format($salary->gross_salary, 2) }}</span>
            </div>
        </div>

        <div class="deductions">
            <h3 class="section-title">Deductions</h3>
            <div class="item">
                <span>NSSF</span>
                <span><sup>KES</sup>{{ number_format($salary->breakdown->getNssfDeduction(), 2) }}</span>
            </div>
            <div class="item">
                <span>SHIF</span>
                <span><sup>KES</sup>{{ number_format($salary->breakdown->getShifDeduction(), 2) }}</span>
            </div>
            <div class="item">
                <span>Affordable Housing Levy</span>
                <span><sup>KES</sup>{{ number_format($salary->breakdown->getAhlDeduction(), 2) }}</span>
            </div>
            <div class="item">
                <span>PAYE</span>
                <span><sup>KES</sup>{{ number_format($salary->breakdown->getPaye(), 2) }}</span>
            </div>
            <div class="total-item">
                <span>Total Deductions</span>
                <span><sup>KES</sup>{{ number_format($salary->breakdown->getDeductions(), 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Net Salary -->
    <div class="net-salary">
        <span>NET SALARY</span>
        <span><sup>KES</sup>{{ number_format($salary->breakdown->getNetPay(), 2) }}</span>
    </div>
    </div>

    </body>
</html>

