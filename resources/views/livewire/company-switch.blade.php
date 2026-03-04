<?php
use Illuminate\Support\Facades\URL;
use Livewire\Volt\Component;

new class extends Component {
    public $company;

    public function mount($company): void
    {
        $this->company = $company;
        //return $this->redirectIntended(URL::previous());
    }

    public function selectCompany($id): void
    {
        //$company = auth()->user()->companies()->findOrFail($companyId);
        
        session(['company_id' => $id]);
        $this->redirectIntended(URL::previous(), true);
    }
}; ?>

<div>
    <flux:menu.item wire:click="selectCompany({{ $company->id }})">
        {{ $company->name }}
    </flux:menu.item>
</div>
