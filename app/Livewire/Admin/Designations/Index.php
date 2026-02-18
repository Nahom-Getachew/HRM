<?php

namespace App\Livewire\Admin\Designations;

use App\Models\Designation;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $designations;

    public function delete($id): void
    {
        $designation = Designation::find($id);
        if ($designation) {
            $designation->delete();
            session()->flash('success', 'Designation deleted successfully.');
        } else {
            session()->flash('error', 'Designation not found.');
        }
    }

    public function mount()
    {
        $this->designations = new Designation();
    }
    
    public function render()
    {
        return view('livewire.admin.designations.index');
    }
}
