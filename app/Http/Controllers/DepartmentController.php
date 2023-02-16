<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    /**
     * TODO: 1. First issue. You need to bind a concrete instance of EmployeeRepositoryInterface --done
     */
    public function getActiveEmployees(EmployeeRepositoryInterface $employeeRepository, int $departmentId): JsonResponse
    {
        /**
         * TODO: 2. Second issue. Need find concrete department by $departmentId --done
         *
         * @var Department $department
         */
        // $department = Department::query()->first();
        $department = Department::findOrFail($departmentId);

        $employees = $employeeRepository->findActiveByDepartment($department);

        return response()->json($employees);
    }

    public function blockEmployees(EmployeeRepositoryInterface $employeeRepository, int $departmentId): JsonResponse{

        /**
         * TODO: 4. Second issue. You need to find a specific department by $departmentId -- done
         *
         * @var Department $department
         */
        // $department = Department::query()->first();
        $department = Department::findOrFail($departmentId);

        /**
         * TODO: 5. Five issue. We need to block all employees of the department -- done
         * @see EmployeeStatusEnum
         */
        $response = $employeeRepository->blockEmployeeByDepartment($department);

        return response()->json($response);
    }
}
