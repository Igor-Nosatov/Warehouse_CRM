<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Other;

use App\Http\Requests\Api\V1\Other\SupportTicketRequest;

class SupportTicketDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $status,
        public readonly string $priority,
        public readonly ?string $category,
        public readonly int $user_id,
        public readonly ?\DateTime $closed_at
    ) {}

    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'category' => $this->category,
            'user_id' => $this->user_id,
            'closed_at' => $this->closed_at?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Create a DTO instance from a SupportTicketRequest.
     *
     * @param SupportTicketRequest $request
     * @return SupportTicketDto
     */
    public static function fromSupportTicketRequest(SupportTicketRequest $request): SupportTicketDto
    {
        $validatedData = $request->validated();
        return new self(
            $validatedData['title'],
            $validatedData['description'],
            $validatedData['status'],
            $validatedData['priority'],
            $validatedData['category'] ?? null,
            $validatedData['user_id'],
            isset($validatedData['closed_at']) ? new \DateTime($validatedData['closed_at']) : null
        );
    }
}
