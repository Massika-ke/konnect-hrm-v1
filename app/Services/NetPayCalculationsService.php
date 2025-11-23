<?php

namespace App\Services;

class NetPayCalculationsService
{
    /**
     * Create a new class instance.
     */
    public $gross_salary;
    public function __construct($gross_salary)
    {
        $this->gross_salary = $gross_salary;
    }

    public function getNssfDeduction()
    {
        // NSSF Kenya deduction max = 4320. Usually 6% of the salary
        $max = 4320;
        return min($this->gross_salary, $max);
    }
    public function getShifDeduction()
    {
        // SHIF is 2.75% of the salary (KENYA). Min value 300/
        return max($this->gross_salary * 0.0275, 300);
    }
    public function getAhlDeduction()
    {
        // Affordable Housing Levy is 1.5% of the gross salary
        return $this->gross_salary * 0.015;
    }
    public function getDeductions()
    {
        return $this->getNssfDeduction()+$this->getShifDeduction()+$this->getAhlDeduction() + $this->getPaye();
    }
    public function getTaxableIncome()
    {
        return $this->gross_salary - ($this->getNssfDeduction()+$this->getShifDeduction()+$this->getAhlDeduction());
    }
    public function getPaye()
    {
        // five levels of payment tax bracket..,
        $level1 = [288000 / 12, 0.1]; // 0-24000 (monthly)
        $level2 = [388000 / 12, 0.25]; // between 288000 and the next 100000
        $level3 = [6000000 / 12, 0.3]; // between 388000 and 6000000
        $level4 = [9600000 / 12, 0.325];
        $level5 = [INF, 0.35];

        $taxableIncome = $this->getTaxableIncome();
        $paye = 0;

        if ($taxableIncome <= $level1[0]) {
            $paye = $taxableIncome * $level1[1];
        }elseif ($taxableIncome <= $level2[0]) {
            $paye = ($level1[0] * $level1[1]) + (($taxableIncome - $level1[0]) * $level2[1]);
        }elseif ($taxableIncome <= $level3[0]) {
            $paye = ($level1[0] * $level1[1]) + (($level2[0] -$level1[0]) * $level2[1]) + (($taxableIncome - $level2[0]) * $level3[1]);
        }elseif ($taxableIncome <= $level4[0]) {
            $paye = ($level1[0] * $level1[1]) + (($level2[0] -$level1[0]) * $level2[1]) + (($level3[0] -$level2[0]) * $level3[1]) + (($taxableIncome - $level3[0]) * $level4[1]);
        }else {
            $paye = ($level1[0] * $level1[1]) + (($level2[0] -$level1[0]) * $level2[1]) + (($level3[0] -$level2[0]) * $level3[1])+ (($level4[0] -$level3[0]) * $level4[1]) + (($taxableIncome - $level4[0]) * $level5[1]);
        }

        $relief = 2400;
        // insurance relief is 15% of any insurance covers taken like SHIF
        // $insuranceRelief = 0.15 * $this->getShifDeduction();
        $paye -= $relief;
        $paye = max($paye, 0);

        return $paye;
    }

    public function getNetPay()
    {
        $this->gross_salary - $this->getDeductions();
    }

}
