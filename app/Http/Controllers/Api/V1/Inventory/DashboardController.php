<?php

declare (strict_types = 1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\Http\Controllers\ApiController;
use App\Services\Inventory\DashboardService;
use Illuminate\Http\JsonResponse;

final class DashboardController extends ApiController
{
    public function __construct(
        private DashboardService $homeService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->homeService->index();
        return $this->sendSuccessResponse($data);
    }
}
