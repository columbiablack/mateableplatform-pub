<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\middlewares\AuthMiddleware;
use mateable\core\models\MessageModel;
use mateable\core\models\user\account\UserModel;
use mateable\core\Platform;
use mateable\core\routes\Routes;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function chat(): string
    {
        $this->setLayout('auth');
        return $this->renderView('profile/messages/chat', [
            'conversations' => $this->getConversations(),
        ]);
    }

    public function sendMessage(Request $request): string
    {
        if (!$request->isPost()) {
            http_response_code(405);
            return json_encode(['error' => 'Method not allowed']);
        }

        header('Content-Type: application/json');

        $body = $request->getBody();
        $receiverId = (int) ($body['receiver_id'] ?? 0);
        $messageBody = trim((string) ($body['message'] ?? ''));

        if ($receiverId <= 0) {
            http_response_code(400);
            return json_encode(['error' => 'Receiver ID is required']);
        }

        if (empty($messageBody)) {
            http_response_code(400);
            return json_encode(['error' => 'Message cannot be empty']);
        }

        if (strlen($messageBody) > 5000) {
            http_response_code(400);
            return json_encode(['error' => 'Message exceeds maximum length']);
        }

        // Verify receiver exists
        $receiver = UserModel::findOne(['id' => $receiverId]);
        if (!$receiver) {
            http_response_code(404);
            return json_encode(['error' => 'Receiver not found']);
        }

        $message = new MessageModel();
        $message->sender_id = (int) Platform::$app->user->id;
        $message->receiver_id = $receiverId;
        $message->body = htmlspecialchars($messageBody, ENT_QUOTES, 'UTF-8');
        $message->is_read = 0;
        $message->created_at = date('Y-m-d H:i:s');

        if ($message->save()) {
            Platform::$app->activity::log(Platform::$app->user->id, 'sent_message', "You sent a message to {$receiver->displayName()}");
            
            return json_encode([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'sender_id' => $message->sender_id,
                    'body' => $message->body,
                    'created_at' => $message->created_at,
                ]
            ]);
        }

        http_response_code(500);
        return json_encode(['error' => 'Failed to send message']);
    }

    public function deleteConversation(Request $request): string
    {
        if (!$request->isPost()) {
            http_response_code(405);
            return json_encode(['error' => 'Method not allowed']);
        }

        header('Content-Type: application/json');

        $body = $request->getBody();
        $userId = (int) ($body['user_id'] ?? 0);
        if ($userId <= 0) {
            http_response_code(400);
            return json_encode(['error' => 'User ID is required']);
        }

        $currentUserId = Platform::$app->user->id;
        $deleteSql = "DELETE FROM messages WHERE (sender_id = :current AND receiver_id = :target) OR (sender_id = :target AND receiver_id = :current)";
        $stmt = MessageModel::prepare($deleteSql);
        $stmt->bindValue(':current', $currentUserId, \PDO::PARAM_INT);
        $stmt->bindValue(':target', $userId, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            return json_encode(['success' => true]);
        }

        http_response_code(500);
        return json_encode(['error' => 'Failed to delete conversation']);
    }

    public function getMessages(Request $request): string
    {
        header('Content-Type: application/json');

        $userId = (int) ($_GET['user_id'] ?? 0);
        if ($userId <= 0) {
            http_response_code(400);
            return json_encode(['error' => 'User ID is required']);
        }

        // Get conversation between current user and specified user
        $currentUserId = Platform::$app->user->id;
        $sql = "SELECT * FROM messages WHERE "
            . "(sender_id = :user1 AND receiver_id = :user2) "
            . "OR (sender_id = :user2 AND receiver_id = :user1) "
            . "ORDER BY created_at ASC LIMIT 50";

        $stmt = MessageModel::prepare($sql);
        $stmt->bindValue(':user1', $currentUserId, \PDO::PARAM_INT);
        $stmt->bindValue(':user2', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(\PDO::FETCH_CLASS, MessageModel::class);

        // Mark as read
        $readStmt = MessageModel::prepare(
            "UPDATE messages SET is_read = 1 WHERE receiver_id = :receiver_id AND sender_id = :sender_id"
        );
        $readStmt->bindValue(':receiver_id', $currentUserId, \PDO::PARAM_INT);
        $readStmt->bindValue(':sender_id', $userId, \PDO::PARAM_INT);
        $readStmt->execute();

        return json_encode([
            'success' => true,
            'messages' => array_map(fn($m) => [
                'id' => $m->id,
                'sender_id' => $m->sender_id,
                'receiver_id' => $m->receiver_id,
                'body' => $m->body,
                'is_read' => $m->is_read,
                'created_at' => $m->created_at,
            ], $messages)
        ]);
    }

    private function getConversations(): array
    {
        $currentUserId = Platform::$app->user->id;
        
        // Get unique conversations (latest message with each user)
        $sql = "SELECT DISTINCT 
                    CASE WHEN sender_id = :user_id THEN receiver_id ELSE sender_id END as other_user_id,
                    MAX(created_at) as last_message_time
                FROM messages
                WHERE sender_id = :user_id OR receiver_id = :user_id
                GROUP BY other_user_id
                ORDER BY last_message_time DESC
                LIMIT 20";

        $stmt = MessageModel::prepare($sql);
        $stmt->bindValue(':user_id', $currentUserId, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $conversations = [];
        foreach ($results as $row) {
            $otherUser = UserModel::findOne(['id' => $row['other_user_id']]);
            if ($otherUser) {
                $conversations[] = [
                    'user' => $otherUser,
                    'last_message_time' => $row['last_message_time'],
                ];
            }
        }

        return $conversations;
    }
}
