<?php

namespace App\Livewire\Admin\Contracts;

use Livewire\Component;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;

class Create extends Component
{
    public $contract;
    public $search = '';
    public $department_id;

    
    public function rules(): array
    {
        return [
            'contract.designation_id' => 'required|string|max:255',
            'contract.employee_id' => 'required|exists:employees,id',
            'contract.start_date' => 'required|date',
            'contract.end_date' => 'required|date|after:contract.start_date',
            'contract.rate_type' => 'required',
            'contract.rate' => 'required|numeric',
        ];
    }
    

    public function mount(): void
    {
        $this->contract = new Contract();
    }

    public function selectEmployee($id): void
    {
        $this->contract->employee_id = $id;
        $this->search = $this->contract->employee->name;
    }

    public function save(): void
    {
        $this->validate();
        
        $this->contract->save();
        
        session()->flash('success', 'Contract created successfully.');
        $this->redirectIntended(route('contracts.index'));
    }
    
    public function render()
    {
        $employees = Employee::inCompany()->searchByName($this->search)->get();
        $departments = Department::inCompany()->get();
        $designations = $this->department_id ? Department::find($this->department_id)->designations()->get() : collect();
        return view('livewire.admin.contracts.create', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ]);
    }
}
