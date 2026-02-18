<?php

namespace App\Livewire\Admin\Departments;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Edit extends Component
{
    public $department;
    
    public function rules(): array
    {
        return [
            'department.name' => 'required|string|max:255',
        ];
    }
    
    public function mount($id)
    {
        $this->department = Department::find($id);
    }

    public function save(): null|RedirectResponse
    {
        $this->validate();
        
        //$this->department->company_id = session('company_id');
        $this->department->save();
        
        session()->flash('success', 'Department updated successfully.');
        return $this->redirectIntended(route('departments.index'));
    }

    public function render()
    {
        return view('livewire.admin.departments.edit');
    }
}
