<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Other;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

final class DocumentController extends ApiController
{
    // public function __construct(
    //     private ProfileService $profileService
    // ) {}
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(): JsonResponse
    // {
    //     $data = $this->profileService->index();
    //     return $this->sendSuccessResponse(ProfileResource::collection($data));
    // }

    // public function store(ProfileRequest $request): JsonResponse
    // {
    //     $data = $this->profileService->store(
    //         ProfileDto::fromProfileRequest($request),
    //     );
    //     return $this->sendSuccessResponse($data);
    // }

    // public function update(ProfileRequest $request, Profile $profile): JsonResponse
    // {
    //     $data = $this->profileService->update(
    //         ProfileDto::fromProfileRequest($request),
    //         $profile,
    //     );
    //     return $this->sendSuccessResponse($data);
    // }

    // public function destroy(Profile $profile): JsonResponse
    // {
    //     $this->profileService->destroy($profile);
    //     return $this->sendSuccessResponse(null,'Data deleted successfully');
    // }
}
