<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    private $repo;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->repo = $employeeRepository;
    }

    /**
     * TODO: 1. First issue. You need to bind a concrete instance of EmployeeRepositoryInterface
     */
    public function getActiveEmployees(Department $department): JsonResponse
    {
        /**
         * TODO: 2. Second issue. Need find concrete department by $departmentId
         *
         * @var Department $department
         */

        //  For achieveing this, I need to change the route parameter and rename it to department like /{department}, It won't work with /{id} -> Route Model Binding

        $employees = $this->repo->findActiveByDepartment($department);

        return response()->json($employees);
    }

    public function blockEmployees(int $departmentId): JsonResponse{

        /**
         * TODO: 4. Second issue. You need to find a specific department by $departmentId
         *
         * @var Department $department
         */

        // Not using route model binding here but it is good to use it
        $department = Department::FindOrFail($departmentId);

        // We can even use EmployeeRepositoryInterface for this, I had created an extra method there

        // $this->repo->blockEmployeesByDepartment($department);

        /**
         * TODO: 5. Five issue. We need to block all employees of the department
         * @see EmployeeStatusEnum
         */

        // one option is that we can achieve this by using relationship updation

        // $department->employees()->update(['status' => EmployeeStatusEnum::BLOCKED->id()]);

        // another option is to just update employee model from here
        Employee::where('department_id', $department->id)
                ->update(['status' => EmployeeStatusEnum::BLOCKED->id()]);
        
        return response()->json(['success' => true]);
    }
}
