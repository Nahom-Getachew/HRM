<?php

namespace App\Livewire\Admin\Departments;

use Livewire\Component;
use App\Models\Department;
use Livewire\Features\SupportRedirects\HandlesRedirects;

class Create extends Component
{
    public $department;
    
    public function rules(): array
    {
        return [
            'department.name' => 'required|string|max:255',
        ];
    }
    
    public function mount()
    {
        $this->department = new Department();
    }

    public function save(): void
    {
        $this->validate();
        
        $this->department->company_id = session('company_id');
        $this->department->save();
        
        session()->flash('success', 'Department created successfully.');
        $this->redirectIntended(route('departments.index'));
    }   

    public function render()
    {
        return view('livewire.admin.departments.create');
    }
}
