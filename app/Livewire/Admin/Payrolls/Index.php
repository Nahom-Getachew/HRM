<?php

namespace App\Livewire\Admin\Payrolls;

use App\Models\Payroll;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $monthYear;

    public function rules(): array
    {
        return [
            'monthYear' => 'required',
        ];
    }

    public function generatePayrolls()
    {
        $this->validate();
        
        // Logic to generate payrolls for the specified month and year
        $date = Carbon::parse($this->monthYear);
        if (Payroll::inCompany()->where('month', $date->format('m'))->where('year', $date->format('Y')))
        {    
            //Payrolls for the selected month and year have already been generated
            //You can choose to update the existing payrolls or throw an error
            //or continue to generate new payrolls and override the existing ones
            throw ValidationException::withMessages(['monthYear' => 'Payrolls for the selected month and year have already been generated.']);    
        } 
        else
        {
            //Payroll generation logic goes here
            //extract data from attendance table calculate salary
            //api for zkteco devices can be used to fetch attendance data
            //include logic for time sheets, leaves, etc.
            $payroll = new Payroll();
            $payroll->month = $date->format('m');
            $payroll->year = $date->format('Y');
            $payroll->company_id = session('company_id');
            $payroll->save();
            //Generate payrolls for all employees
            foreach(Employee::inCompany()->get() as $employee) 
            {
                //Payroll generation logic for each employee
                $contract = $employee->getActiveContract($date->startOfMonth()->toString(),$date->endOfMonth()->toString());
                if($contract) 
                {
                    $payroll->salaries()->create([
                        'employee_id' => $employee->id,
                        'gross_salary' => $contract->getTotalEarnings($date->format('Y-m')),
                    ]);
                }
            }
            session()->flash('success', 'Payrolls generated successfully.');
        }
    }

    public function updatePayroll($id):void
    {
        $payroll = Payroll::inCompany()->find($id);
        $payroll->salaries()->delete();
        //Generate payrolls for all employees
        foreach(Employee::inCompany()->get() as $employee) 
        {
            //Payroll generation logic for each employee
            $contract = $employee->getActiveContract($payroll->year.'-'.$payroll->month.'-1',$payroll->year.'-'.$payroll->month);
            if($contract) 
            {
                $payroll->salaries()->create([
                    'employee_id' => $employee->id,
                    'gross_salary' => $contract->getTotalEarnings($payroll->year.'-'.$payroll->month),
                ]);
            }
        }
        session()->flash('success', 'Payroll updated successfully.');
    }
    
    public function render()
    {
        return view('livewire.admin.payrolls.index', [
            'payrolls' => Payroll::inCompany()->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(10),
        ]);
    }
}
