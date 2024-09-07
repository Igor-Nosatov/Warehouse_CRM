<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\DataTransferObjects\Auth\PermissionDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\Permission\PermissionRequest;
use App\Http\Resources\Api\V1\Auth\PermissionResource;
use App\Models\Api\V1\Auth\Permission;
use App\Services\Auth\PermissionService;
use Illuminate\Http\JsonResponse;

final class PermissionController extends Controller
{
    public function __construct(
        private PermissionService $permissionService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $data = $this->permissionService->index();
        return $this->sendSuccessResponse(PermissionResource::collection($data));
    }

    public function store(PermissionRequest $request): JsonResponse
    {
        $data = $this->permissionService->store(
            PermissionDto::fromPermissionRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        $data = $this->permissionService->update(
            PermissionDto::fromPermissionRequest($request),
            $permission,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $this->permissionService->destroy($permission);
        return $this->sendSuccessResponse(null,'Data deleted successfully');
    }
}
