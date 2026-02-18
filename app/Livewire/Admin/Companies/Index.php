<?php

namespace App\Livewire\Admin\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\View\View;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public function delete($id): void
    {
        $company = Company::find($id);
        if($company->logo)
        {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        session()->flash('message', 'Company deleted successfully.');
    }   
    
    public function render(): View
    {
        return view('livewire.admin.companies.index', [
            'companies' => Company::latest()->paginate(10),
        ]);
    }
}
