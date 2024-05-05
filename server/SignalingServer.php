<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\server;

use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . './vendor/autoload.php';

class  SignalingServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Broadcast received message to all other clients
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }

    public function onPrivateMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true); // Assuming message is in JSON format

        if (isset($data['recipientId'])) {
            $recipientId = $data['recipientId'];

            // Find the recipient client by their unique identifier
            foreach ($this->clients as $client) {
                if ($client->resourceId == $recipientId) {
                    $client->send($data['message']); // Send the message to the recipient
                    break; // Stop iterating once the recipient is found
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$signalingServer = new SignalingServer();

// Start the WebSocket server
$server = IoServer::factory(
    new HttpServer(
        new WsServer($signalingServer)
    ),
    8080
);

echo "Signaling server started\n";

// Handle WebSocket connections and messages
$server->run();

?>
