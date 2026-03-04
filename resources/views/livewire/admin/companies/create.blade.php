<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Companies</flux:heading>
        <flux:subheading size="lg" class="mb-6">Create a New Company</flux:subheading>
        <flux:separator/>
    </div>
    <form wire:submit="save" class=" my-6 w-full space-y-6">
        <flux:input label="Company Name" wire:model.live="company.name" :invalid="$errors->has('company.name')" type="text" required/>
        <flux:input label="Company Email Address" wire:model.live="company.email" :invalid="$errors->has('company.email')" type="email" required/>
        <flux:input label="Company Website" wire:model.live="company.website" :invalid="$errors->has('company.website')" type="url" required/>
        
        <flux:input label="Company Logo" wire:model.live="logo" :invalid="$errors->has('logo')" type="file" accept="image/*" />
        <flux:button variant="primary" type="submit">
            Save Changes
        </flux:button>
    </form>
</div>
