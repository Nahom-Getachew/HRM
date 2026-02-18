<?php

use Livewire\Volt\Component;

new class extends Component {
    public $company;

    public function mount($company): mixed
    {
        $this->company = $company;
        return $this->redirectIntended(URL::previous());
    }

    public function selectCompany($companyId): void
    {
        //$company = auth()->user()->companies()->findOrFail($companyId);
        
        session(['company_id' => $this->company->id]);
        $this->redirectIntended(URL::previous());
    }
}; ?>

<div>
    <flux:menu.item wire:click="selectCompany({{ $company->id }})" class="flex items-center space-x-2 rtl:space-x-reverse">
        <x-company-logo :company="$company" class="h-5 w-5 rounded-full object-cover" />
        <span>{{ $company->name }}</span>
    </flux:menu.item>
</div>
