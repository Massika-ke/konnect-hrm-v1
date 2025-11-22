<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">
            Contracts
        </flux:heading>
        <flux:subheading size="lg" class="mb-6">
            Create new Contract
        </flux:subheading>
        <flux:separator />
    </div>

    <form wire:submit="save" class="my-6 w-full space-y-6">
        <flux:input type="search" name="search" wire:model.live="search" placeholder="Search for an Employee" :invalid="$errors->has('contract.employee_id')"/>
        @if($search != '' && $employees->count()> 0)
            <div class="bg-white dark:bg-zinc-900 w-full border border-zinc-200 dark:border-zinc-800 rounded-md shadow-md -mt-4">
                <ul class="w-full">
                    @foreach ($employees as $employee)
                    <li class="p-2 hover:bg-zinc-200 dark:hover:bg-zinc-500 dark:hover:text-zinc-900 cursor-pointer" wire:click="selectEmployee({{ $employee->id }})">
                        {{ $employee->name }}
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:select name="department" label="Department" wire:model.live="department_id">
                    <option selected>Select Department</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                <flux:select name="designation" label="Designation" wire:model.live="contract.designation_id" :invalid="$errors->has('contract.designation_id')">
                    <option selected>Select Designation</option>
                    @foreach ($designations as $designation)
                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                    @endforeach
                </flux:select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:input type="date" name="start_date" label="Start Date" wire:model.live="contract.start_date" :invalid="$errors->has('contract.start_date')"/>
            </div>
            <div>
                <flux:input type="date" name="end_date" label="End Date" wire:model.live="contract.end_date" :invalid="$errors->has('contract.end_date')"/>
            </div>
        </div>
         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:input type="number" name="rate" label="Rate" wire:model.live="contract.rate" :invalid="$errors->has('contract.rate')"/>
            </div>
            <div>
                <flux:select name="rate_type" label="Rate Type" wire:model.live="contract.rate_type" :invalid="$errors->has('contract.rate_type')">
                    <option selected>Select Rate Type</option>
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                </flux:select>
            </div>
         </div>
         <div class="flex justify-start">
            <flux:button variant="primary" type="submit">Save</flux:button>
         </div>
    </form>
</div>
