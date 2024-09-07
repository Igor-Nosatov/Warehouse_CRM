<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Other;

use App\DataTransferObjects\Other\SupportTicketDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Other\SupportTicketRequest;
use App\Models\Other\SupportTicket;
use App\Services\Other\SupportTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SupportTicketController extends ApiController
{
    private SupportTicketService $supportTicketService;

    public function __construct(SupportTicketService $supportTicketService)
    {
        $this->supportTicketService = $supportTicketService;
    }

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', SupportTicket::class);
        $data = $this->supportTicketService->index();
        return $this->sendSuccessResponse($data);
    }

    public function show(int $ticketId): JsonResponse
    {
        $this->authorize('view', SupportTicket::class);
        $data = $this->supportTicketService->show($ticketId);
        return $this->sendSuccessResponse($data);
    }

    public function store(SupportTicketRequest $request): JsonResponse
    {
        $this->authorize('create', SupportTicket::class);
        $data = $this->supportTicketService->store(
            SupportTicketDto::fromSupportTicketRequest($request)
        );
        return $this->sendSuccessResponse($data, 'Support ticket created successfully.');
    }

    public function update(SupportTicketRequest $request, SupportTicket $supportTicket): JsonResponse
    {
        $this->authorize('update', $supportTicket);
        $data = $this->supportTicketService->update(
            SupportTicketDto::fromSupportTicketRequest($request),
            $supportTicket
        );
        return $this->sendSuccessResponse($data, 'Support ticket updated successfully.');
    }

    public function destroy(SupportTicket $supportTicket): JsonResponse
    {
        $this->authorize('delete', $supportTicket);
        $this->supportTicketService->destroy($supportTicket);
        return $this->sendDeleteResponse('Support ticket deleted successfully.');
    }
}
