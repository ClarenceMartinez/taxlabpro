<?php

namespace App\Events;
 
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientListUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ?int $triggered_by_user_id;
    
    public int $clientCount;

    private int $companyId;

    public function __construct(int $companyId, ?int $userId, int $clientCount)
    {
        $this->companyId = $companyId;
        $this->triggered_by_user_id = $userId;
        $this->clientCount = $clientCount; 
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('company.' . $this->companyId . '.clients'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'client.list.updated';
    }
}