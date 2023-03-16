<?php

declare(strict_types=1);

namespace App\Contract;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function findActiveByDepartment(Department $department): Collection;
    public function blockEmployeesByDepartment(Department $department): void;
    
}
