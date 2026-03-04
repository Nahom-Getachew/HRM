<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Departments</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Departments for {{getCompany()->name }}</flux:subheading>
        <flux:separator/>
    </div>
    <div class="space-y-6">
        <livewire:departments />
    </div> 
    
</div>
