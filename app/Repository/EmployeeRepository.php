<?php

declare(strict_types=1);

namespace App\Repository;

use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function findActiveByDepartment(Department $department): Collection
    {
        // TODO: 3. Third issue. Need get ACTIVE employees by department a

        // one way is to add relation in Department model and load all employees with status active

        // $department->load(['employees' => function ($query) {
        //     $query->where('status',  EmployeeStatusEnum::ACTIVE->id());
        // }]);
        // return $department->employees;

        // second way is too just filter out employees from employee model
        return Employee::where('department_id', $department->id)
                ->where('status', EmployeeStatusEnum::ACTIVE->id())
                ->get();
    }

    public function blockEmployeesByDepartment(Department $department): void
    {
        Employee::where('department_id', $department->id)
                    ->update(['status' => EmployeeStatusEnum::BLOCKED->id()]);
    }
}
