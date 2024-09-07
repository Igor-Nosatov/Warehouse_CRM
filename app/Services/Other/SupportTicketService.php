<?php

declare(strict_types=1);

namespace App\Services\Other;

use App\DataTransferObjects\Other\SupportTicketDto;
use App\Models\Other\SupportTicket;
use Illuminate\Database\Eloquent\Collection;

class SupportTicketService
{
    public function index(): Collection
    {
        return SupportTicket::all();
    }

    public function show(int $ticketId): ?SupportTicket
    {
        return SupportTicket::find($ticketId);
    }

    public function store(SupportTicketDto $dto): SupportTicket
    {
        return SupportTicket::create($dto->toArray());
    }

    public function update(SupportTicketDto $dto, SupportTicket $supportTicket): SupportTicket
    {
        $supportTicket->update($dto->toArray());
        return $supportTicket;
    }

    public function destroy(SupportTicket $supportTicket): void
    {
        $supportTicket->delete();
    }
}
