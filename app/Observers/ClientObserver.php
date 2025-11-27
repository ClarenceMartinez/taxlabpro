<?php

namespace App\Observers;

use App\Models\Client;
use App\Events\ClientListUpdated;
use App\Events\ClientProfileUpdated;
use Illuminate\Support\Facades\Auth;

class ClientObserver
{
    public function created(Client $client): void
    {
        $this->broadcastUpdates($client, 'created');
    }

    public function updated(Client $client): void
    {
        $this->broadcastUpdates($client, 'updated');
    }

    public function deleted(Client $client): void
    {
        $this->broadcastUpdates($client, 'deleted');
    }

    /**
     * Centraliza el despacho de eventos para evitar código duplicado.
     *
     * @param Client $client
     * @param string $action 'created', 'updated', or 'deleted'
     */
    private function broadcastUpdates(Client $client, string $action): void
    {
        $userId = Auth::id();
        $companyId = $client->company_id;

        // --- Evento para la lista de clientes ---
        // Se dispara para todos los demás usuarios cuando se crea, actualiza o elimina un cliente.
        $clientCount = Client::where('company_id', $companyId)->count();
        broadcast(new ClientListUpdated($companyId, $userId, $clientCount))->toOthers();

        // --- Evento para el perfil del cliente ---
        // Solo se dispara en 'updated' para refrescar la vista.
        // Se envía a TODOS (incluido el originador) para unificar la lógica de actualización.
        if ($action === 'updated') {
            broadcast(new ClientProfileUpdated($companyId, $client->id, $userId));
        }
    }
}