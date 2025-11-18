<?php

namespace App\Livewire\Admin\Contracts;

use App\Models\Contract;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    public function delete($id)
    {
        Contract::find($id)->delete();
        session()->flash('success', 'Contract deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.departments.index', [
            'departments' => $departments,
            'contracts' => Contract::inCompany()->paginate(10)
        ]);
    }
}
