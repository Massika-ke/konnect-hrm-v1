<?php

namespace App\Livewire\Admin\Payrolls;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $monthYear;

    public function rules()
    {
        return [
            'monthYear' => 'required',
        ];
    }

    public function viewPayroll($id)
    {
        $payroll = Payroll::inCompany()->find($id);
        $this->redirectIntended(route('payrolls.show', $payroll), true);
    }

    public function generatePayroll()
    {
        $this->validate(); // validate input
        $date = Carbon::parse($this->monthYear);

        // Duplicate check, if payroll exists
        if (Payroll::inCompany()->where('month', $date->format('m'))
            ->where('year', $date->format('Y'))->exists()) {
            throw ValidationException::withMessages([
                'monthYear' => 'Payroll for the selected month and year already exists.',
            ]);
        }
        // create new payroll with records from the session
         else {
            $payroll = new Payroll();
            $payroll->month = $date->format('m');
            $payroll->year = $date->format('Y');
            $payroll->company_id = session('company_id');
            $payroll->save();

            // loop thru all employees in the company, check for an active contract
            foreach (Employee::inCompany()->get() as $employee) {
                $contract = $employee->getActiveContract(
                    $date->startOfMonth()->toDateString(),
                    $date->endOfMonth()->toDateString());

                    // If an active contract exits, create salary record
                if ($contract) {
                    $payroll->salaries()->create([
                        'employee_id' => $employee->id,
                        'gross_salary' => $contract->getTotalEarnings($date->format('Y-m')),
                    ]);
                }
            }
            session()->flash('success', 'Payroll generated successfully');
        }
    }

    public function updatePayroll($id)
    {
        // find and delete existing salary records
        $payroll = Payroll::inCompany()->find($id);
        $payroll->salaries()->delete();

        foreach (Employee::inCompany()->get() as $employee) {
            $contract = $employee->getActiveContract(
                $payroll->year. '-'.$payroll->month.'-01',
                $payroll->year. '-'.$payroll->month.'-31');

                // recreate salary records
            if ($contract) {
                $payroll->salaries()->create([
                    'employee_id' => $employee->id,
                    'gross_salary' => $contract->getTotalEarnings($payroll->year . '-'.$payroll->month),
                ]);
            }
        }
        session()->flash('success', 'Payroll updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.payrolls.index', [
            'payrolls' => Payroll::inCompany()->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(10),
        ]);
    }

}
