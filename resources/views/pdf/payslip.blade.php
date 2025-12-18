<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    @import url('https://cdn.tailwindcss.com');
    sup{
        font-size: 7px;
    }
    
</style>

<div class="max-w-2xl mx-auto p-8 bg-white">
    <!-- Header -->
    <div class="border-b-2 border-gray-300 pb-6 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">PAYSLIP</h1>
        <p class="text-gray-600 text-sm mt-1">{{ now()->format('F Y') }}</p>
    </div>

    <!-- Employee Info -->
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <p class="text-gray-600 text-sm font-semibold">EMPLOYEE NAME</p>
            <p class="text-gray-800 font-bold">{{ $salary->employee->name }}</p>
            <p class="text-gray-600 text-sm font-semibold mt-3">EMPLOYEE ID</p>
            <p class="text-gray-800">{{ sprintf('%04d',$salary->employee_id) }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm font-semibold">DESIGNATION</p>
            <p class="text-gray-800">{{ $salary->employee->designation->name }}</p>
            {{-- <p class="text-gray-600 text-sm font-semibold mt-3">DEPARTMENT</p>
            <p class="text-gray-800">{{ $salary->employee->department }}</p> --}}
        </div>
    </div>

    <!-- Earnings & Deductions -->
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3 pb-2 border-b-2 border-blue-500">Earnings</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span>Gross Salary</span><span class="font-semibold"><sup>KES</sup>{{ number_format($salary->gross_salary, 2 )}}</span></div>
                {{-- <div class="flex justify-between"><span>Allowances</span><span class="font-semibold">{{ $payslip->allowances ?? '0' }}</span></div> --}}
                {{-- <div class="flex justify-between text-blue-600 font-bold pt-2 border-t"><span>Total Earnings</span><span>{{ $payslip->total_earnings ?? '0' }}</span></div> --}}
            </div>
        </div>
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3 pb-2 border-b-2 border-red-500">Deductions</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span>NSSF</span><span class="font-semibold"><sup>KES</sup>{{ number_format($salary->breakdown->getNssfDeduction(), 2) }}</span></div>
                <div class="flex justify-between"><span>SHIF</span><span class="font-semibold"><sup>KES</sup>{{ number_format($salary->breakdown->getShifDeduction(), 2) }}</span></div>
                <div class="flex justify-between"><span>Afordable Housing Levy</span><span class="font-semibold"><sup>KES</sup>{{ number_format($salary->breakdown->getAhlDeduction(), 2) }}</span></div>
                <div class="flex justify-between"><span>PAYE</span><span class="font-semibold"><sup>KES</sup>{{ number_format($salary->breakdown->getPaye(), 2) }}</span></div>
                <div class="flex justify-between text-red-600 font-bold pt-2 border-t"><span>Total Deductions</span><span><sup>KES</sup>{{ number_format($salary->breakdown->getDeductions(), 2) }}</span></div>
            </div>
        </div>
    </div>

    <!-- Net Salary -->
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <span class="text-gray-800 font-bold text-lg">NET SALARY</span>
            <span class="text-2xl font-bold text-blue-600"><span><sup>KES</sup>{{ number_format($salary->breakdown->getNetPay(), 2) }}</span>
        </div>
    </div>
</div>
</body>
</html>
