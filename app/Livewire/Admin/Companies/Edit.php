<?php

namespace App\Livewire\Admin\Companies;

use Livewire\Component;
use App\Models\Company;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 1MB Max
        ];
    }

    public function mount($id): void
    {
        $this->company = Company::find($id);
    }

    public function update(): mixed
    {
        $this->validate();

        if ($this->logo) {
            if($this->company->logo)
                Storage::disk('public')->delete($this->company->logo);
            $logoPath = $this->logo->store('logos', 'public');
            $this->company->logo = $logoPath;
        }

        $this->company->save();

        session()->flash('success', 'Company updated successfully.');
        
        return $this->redirectIntended(route('companies.index'), true);
    }
    
    public function render()
    {
        return view('livewire.admin.companies.edit');
    }
}
