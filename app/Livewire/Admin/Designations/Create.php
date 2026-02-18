<?php

namespace App\Livewire\Admin\Designations;

use Livewire\Component;
use App\Models\Designation;
use Livewire\Features\SupportRedirects\HandlesRedirects;
//use Illuminate\Http\RedirectResponse;

class Create extends Component
{
    public $designation;

    public function rules(): array
    {
        return [
            'designation.name' => 'required|string|max:255',
            'designation.department_id' => 'required|exists:departments,id',
        ];
    }

    public function mount()
    {
        $this->designation = new Designation();
    }

    public function save(): void
    {
        $this->validate();

        $this->designation->save();

        session()->flash('success', 'Designation created successfully.');
        $this->redirectIntended('designations.index');
    }
    
    public function render()
    {
        return view('livewire.admin.designations.create');
    }
}
