<?php

namespace App\Livewire\Admin\Departments;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Department;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function delete($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            session()->flash('success', 'Department deleted successfully.');
        } else {
            session()->flash('error', 'Department not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.departments.index', [
            'departments' => Department::inCompany()->paginate(10),
        ]);
    }
}
