<?php

namespace App\Livewire\Admin\Companies;

use Livewire\Component;
use App\Models\Company;
use Livewire\WithFileUploads;



class Create extends Component
{
    use WithFileUploads;

    public $company;
    public $logo;

    public function rules(): array
    {
        return [
            'company.name' => 'required|string|max:255',
            'company.email' => 'required|email|max:255',
            'company.website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB Max
        ];
    }

    public function mount(): void
    {
        $this->company = new Company();
    }

    public function save(): mixed
    {
        $this->validate();
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
            $this->company->logo = $logoPath;
        }

        $this->company->save();
        session()->flash('success', 'Company created successfully.');
        return $this->redirectIntended(route('companies.index'), true);
        
    }
    
    public function render()
    {
        return view('livewire.admin.companies.create');
    }
}
