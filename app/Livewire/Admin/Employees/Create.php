<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use App\Models\Designation;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public $employee;
    public $department_id;

    public function rules(): array
    {
        return [
            'employee.name' => 'required|string|max:255',
            'employee.email' => 'required|email|unique:employees,email',
            'employee.phone' => 'required|string|max:255',
            'employee.address' => 'required|string|max:255',
            'employee.designation_id' => 'required|exists:designations,id',
        ];
    }

    public function mount()
    {
        $this->employee = new Employee();
        
    }

    public function save(): void
    {
        $this->validate();
        $this->employee->save();
        
        session()->flash('success', 'Employee created successfully.');
        $this->redirectIntended('employees.index');
        
    }

    public function render()
    {
        $designations = Designation::inCompany()->where('department_id', $this->department_id)->get();
        return view('livewire.admin.employees.create', [
            'designations' => $designations,
            'departments' => Department::inCompany()->get(),
        ]);
    }
}
