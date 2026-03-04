<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\Livewire\ActionButton;



final class departments extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'departmentsTable';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            //Exportable functionality removed due to undefined class
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            
            PowerGrid::exportable('Departments')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV, striped: true),
                
        ];
    }

    public function datasource(): ?Builder
    {
        return Department::query()->join('companies', 'departments.company_id', '=', 'companies.id')
                                  ->select('departments.id', 'departments.company_id', 'companies.name as company', 
                                  'departments.name', 'departments.created_at', 'departments.updated_at');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('company_id')
            ->add('company')
            ->add('name')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Dep Id', 'id'),
            Column::make('Company id', 'company_id'),
            Column::make('Company Name', 'company')
                ->sortable()
                ->searchable(),
            Column::make('Dep Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at', 'updated_at')
                ->sortable()
                ->searchable(),
            Column::action('Action')->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    

    public function actions($row): array
    {   
        //dd('dumped: '.$row);
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('bg-indigo-500 text-white')
                ->attributes(['wire:confirm' => 'Are you sure you want to edit this department?'])
                ->route('departments.edit', ['id' => $row->id]),
                //->render(fn($row) => "ID: " . $row->id),
            Button::add('delete')
                ->slot('Delete')
                ->class('bg-red-500 text-white')
                ->confirm('Are you sure you want to delete this department?')
                ->route('departments.delete', ['id' => $row->id]),
            ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
