<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Companies</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Companies</flux:subheading>
        <flux:separator/>
    </div>
    <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full table">
                            <thead class="bg-nos-200 dark:bg-nos-950">
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Company Name
                                    </th>
                                    <th>
                                        Number of Emplyees
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr class="text-center bg-nos-100 hover:bg-nos-50 dark:bg-nos-800 dark:hover:bg-nos-700">
                                        <td>
                                            {{ $company->id }}
                                        </td>
                                        <td class="text-zinc-900 dark:text-white flex justify-left items-center">
                                            <img src="{{ $company->logo_url }}" alt="" class="w-10 h-10 rounded-full mr-4">
                                            <span>{{ $company->name }}</span>
                                        </td>
                                        <td>
                                            {{ $company->departments->flatMap(fn($department) => $department->designations)->flatMap(fn($designation) => $designation->employees)->count() }}
                                        </td>
                                        <td>
                                            <flux:button variant="filled" icon="pencil" :href="route('companies.edit', $company->id)">
                                                
                                            </flux:button>
                                            <flux:button variant="danger" icon="trash" wire:click="delete({{ $company->id }})">
                                                
                                            </flux:button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
    </div>    
</div>

