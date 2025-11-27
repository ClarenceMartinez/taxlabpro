<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientProfileUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $clientId;
    public ?int $triggered_by_user_id;
    private int $companyId;

    // Ya no necesitamos el objeto Client completo ni el HTML
    public function __construct(int $companyId, int $clientId, ?int $userId)
    {
        $this->companyId = $companyId;
        $this->clientId = $clientId;
        $this->triggered_by_user_id = $userId;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('company.' . $this->companyId . '.clients'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'client.profile.updated';
    }
}