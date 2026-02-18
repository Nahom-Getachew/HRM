<?php

namespace App\Livewire\Admin\Contracts;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Contract;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    
    public function delete($id)
    {
        $contract = Contract::find($id);
        if ($contract) {
            $contract->delete();
            session()->flash('success', 'Contract deleted successfully.');
        } else {
            session()->flash('error', 'Contract not found.');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.contracts.index', [
            'contracts' => Contract::inCompany()
                ->searchByEmployee(name: $this->search)
                ->paginate(10),
        ]);
    }
}