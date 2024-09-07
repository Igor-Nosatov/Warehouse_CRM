<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\RoleResource;
use App\Models\Auth\Role;
use App\Services\Auth\RoleService;
use Illuminate\Http\JsonResponse;

final class RoleController extends Controller
{
    public function __construct(
        private RoleService $roleService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->roleService->index();
        return $this->sendSuccessResponse(RoleResource::collection($data));
    }



    public function destroy(Role $role): JsonResponse
    {
        $this->roleService->destroy($role);
        return $this->sendSuccessResponse(null, 'Data deleted successfully');
    }
}
