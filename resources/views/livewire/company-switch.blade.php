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

    public function selectCompany($id): mixed
    {
        //$company = auth()->user()->companies()->findOrFail($companyId);
        
        session(key: ['company_id' => $this->company->$id]);
        return $this->redirectIntended(URL::previous(), true);
    }
}; ?>

<div>
    <flux:menu.item wire:click="selectCompany({{ $company->id }})">
        {{ $company->name }}
    </flux:menu.item>
</div>
