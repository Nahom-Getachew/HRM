<?php

namespace App\Livewire\Admin\Payrolls;

use App\Models\Payroll;
use App\Models\Salary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    public $payroll;

    public function mount($id): void
    {
        $this->payroll = Payroll::inCompany()->find($id);
    }

    public function generatePayslips($id): BinaryFileResponse
    {
        //Logic to generate payslips for the payroll
        $salary = Salary::find($id);
        $pdf = Pdf::loadView('pdf.payslip', [compact('salary')]);
        $pdf->setPaper(array(0,0,400,1500), 'portrait');
        $filepath = storage_path(Str::slug($salary->employee->name).'-pdfslip.pdf');
        $pdf->save($filepath);
        return response()->download($filepath)->deleteFileAfterSend(true);
        //session()->flash('success', 'Payslips generated successfully.');
    }   
    
    public function render()
    {
        return view('livewire.admin.payrolls.show');
    }
}
