<div>
    <div class="row">
        @foreach ($employees as $employee)
            <div class="col-xl-4 col-sm-6">
                @livewire('employee.employee-item', ['employee' => $employee], key($employee->id))
            </div>
        @endforeach

        <div class="col-12">
            {{ $employees->links() }}
        </div>
    </div>
</div>
