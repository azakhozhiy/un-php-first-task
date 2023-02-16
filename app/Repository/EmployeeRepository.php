<?php

declare(strict_types=1);

namespace App\Repository;

use App\Contract\EmployeeRepositoryInterface;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function findActiveByDepartment(Department $department): Collection
    {
        // TODO: 3. Third issue. Need get ACTIVE employees by department a --done

        // return Employee::query();
        return Employee::where('department_id', $department->id)->where('status', 1)->with('user')->get();
    }

    public function blockEmployeeByDepartment(Department $department): string
    {
        $data = ['status'=>3];
        $rs = Employee::where('department_id', $department->id)->update($data);
        if($rs)
            return "Record(s) updated successfully.";
        else 
            return "Unable to update record(s).";
    }
}
