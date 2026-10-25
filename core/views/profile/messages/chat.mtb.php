<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/**
 * @var array $conversations
 */

use mateable\core\Platform;

?>
<section id="messaging" class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Messages</h1>
                <p class="text-muted">Connect and chat with other members.</p>
            </div>
        </div>

        <div class="row g-3 h-100" style="min-height: 70vh;">

            <!-- Conversations Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="mb-0">Conversations</h5>
                    </div>
                    <div class="card-body p-0" id="conversations-list">
                        <?php if (empty($conversations)): ?>
                            <p class="text-muted p-3 mb-0">No conversations yet. Start chatting with someone!</p>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($conversations as $convo): ?>
                                    <div class="list-group-item conversation-item border-0 text-start d-flex justify-content-between align-items-center gap-2" 
                                            data-user-id="<?php echo $convo['user']->id; ?>"
                                            data-user-name="<?php echo htmlspecialchars($convo['user']->displayName(), ENT_QUOTES); ?>">
                                        <button class="btn btn-link p-0 text-start flex-grow-1 conversation-select" type="button">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong><?php echo htmlspecialchars($convo['user']->displayName(), ENT_QUOTES); ?></strong>
                                                <small class="text-muted"><?php echo date('M d', strtotime($convo['last_message_time'])); ?></small>
                                            </div>
                                            <small class="text-muted">Last message...</small>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-conversation" type="button" data-user-id="<?php echo $convo['user']->id; ?>" aria-label="Delete conversation">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Chat Window -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm h-100 d-flex flex-column" id="chat-window" style="display: none;">
                    <!-- Chat Header -->
                    <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" id="chat-user-name">Select a conversation</h5>
                        <button class="btn btn-sm btn-outline-secondary" id="close-chat" type="button" aria-label="Close chat">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <!-- Messages Area -->
                    <div class="card-body flex-grow-1 d-flex flex-column" style="overflow-y: auto;" id="messages-container">
                        <div class="text-center text-muted py-5">
                            <p>Select a conversation to start messaging.</p>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="card-footer bg-light border-top">
                        <form id="message-form" class="d-flex gap-2">
                            <input type="hidden" id="receiver-id" value="">
                            <textarea id="message-input" 
                                    class="form-control" 
                                    placeholder="Type a message..." 
                                    rows="2"
                                    maxlength="5000"
                                    style="resize: none;"></textarea>
                            <button type="submit" class="btn btn-primary" id="send-btn">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- No Conversation Selected -->
                <div class="card border-0 shadow-sm h-100 d-flex align-items-center justify-content-center" id="no-conversation">
                    <div class="text-center text-muted">
                        <i class="fa fa-comments fa-3x mb-3" style="color: var(--mateable-accent);"></i>
                        <p class="mb-0">Select a conversation to start messaging.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentUserId = <?php echo Platform::$app->user->id; ?>;
    let selectedUserId = null;
    let messageRefreshInterval = null;

    const chatWindow = document.getElementById('chat-window');
    const noConversation = document.getElementById('no-conversation');
    const receiverInput = document.getElementById('receiver-id');
    const chatUserName = document.getElementById('chat-user-name');
    const messageForm = document.getElementById('message-form');

    function showNoConversationState() {
        selectedUserId = null;
        if (receiverInput) receiverInput.value = '';
        if (chatUserName) chatUserName.textContent = 'Select a conversation';
        if (chatWindow) chatWindow.style.display = 'none';
        if (noConversation) noConversation.style.display = 'flex';
        if (messageRefreshInterval) clearInterval(messageRefreshInterval);
        messageRefreshInterval = null;
    }

    function selectConversation(item) {
        const userId = parseInt(item.dataset.userId, 10);
        const userName = item.dataset.userName;

        if (!userId) return;

        selectedUserId = userId;
        document.querySelectorAll('.conversation-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        if (receiverInput) receiverInput.value = userId;
        if (chatUserName) chatUserName.textContent = userName;
        if (chatWindow) chatWindow.style.display = 'flex';
        if (noConversation) noConversation.style.display = 'none';

        loadMessages();

        if (messageRefreshInterval) clearInterval(messageRefreshInterval);
        messageRefreshInterval = setInterval(loadMessages, 2000);
    }

    document.querySelectorAll('.conversation-select').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.conversation-item');
            if (item) selectConversation(item);
        });
    });

    document.querySelectorAll('.delete-conversation').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const userId = parseInt(this.dataset.userId, 10);
            if (!userId) return;

            fetch('/api/messages/delete-conversation', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = this.closest('.conversation-item');
                    if (item) item.remove();
                    if (selectedUserId === userId) {
                        showNoConversationState();
                    }
                    if (!document.querySelector('.conversation-item')) {
                        const container = document.getElementById('conversations-list');
                        if (container) {
                            container.innerHTML = '<p class="text-muted p-3 mb-0">No conversations yet. Start chatting with someone!</p>';
                        }
                    }
                } else {
                    alert(data.error || 'Failed to delete conversation');
                }
            })
            .catch(() => alert('Failed to delete conversation'));
        });
    });

    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();
            
            if (!message || !selectedUserId) {
                return;
            }
            
            fetch('/api/messages/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'receiver_id': selectedUserId,
                    'message': message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    messageInput.focus();
                    loadMessages();
                } else {
                    alert('Error: ' + (data.error || 'Failed to send message'));
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Failed to send message');
            });
        });
    }

    // Load messages
    function loadMessages() {
        if (!selectedUserId) return;
        
        fetch('/api/messages?user_id=' + selectedUserId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayMessages(data.messages);
                }
            })
            .catch(err => console.error('Error loading messages:', err));
    }

    // Display messages
    function displayMessages(messages) {
        const container = document.getElementById('messages-container');
        container.innerHTML = '';
        
        if (messages.length === 0) {
            container.innerHTML = '<div class="text-center text-muted py-5"><p>No messages yet. Start the conversation!</p></div>';
            return;
        }
        
        messages.forEach(msg => {
            const isOwn = msg.sender_id === currentUserId;
            const messageEl = document.createElement('div');
            messageEl.className = 'd-flex mb-3 ' + (isOwn ? 'justify-content-end' : 'justify-content-start');
            
            messageEl.innerHTML = `
                <div class="alert ${isOwn ? 'alert-primary' : 'alert-secondary'} mb-0 p-2" style="max-width: 70%; word-wrap: break-word;">
                    <p class="mb-1">${escapeHtml(msg.body)}</p>
                    <small class="text-muted">${formatTime(msg.created_at)}</small>
                </div>
            `;
            
            container.appendChild(messageEl);
        });
        
        // Auto-scroll to bottom
        container.scrollTop = container.scrollHeight;
    }

    // Helper: Escape HTML
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Helper: Format time
    function formatTime(dateStr) {
        const date = new Date(dateStr);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        
        if (diffMins < 1) return 'just now';
        if (diffMins < 60) return diffMins + ' min ago';
        if (diffMins < 1440) return Math.floor(diffMins / 60) + ' hours ago';
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    }

    // Close chat on mobile
    document.getElementById('close-chat').addEventListener('click', function() {
        showNoConversationState();
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        if (messageRefreshInterval) clearInterval(messageRefreshInterval);
    });
});
</script>

<style>
#messages-container {
    background-color: #f8f9fa;
}

#no-conversation {
    min-height: 260px;
    display: flex;
}

.conversation-item {
    cursor: pointer;
    border-bottom: 1px solid #e9ecef !important;
    transition: background-color 0.2s;
}

.conversation-select {
    color: inherit;
    text-decoration: none;
}

.conversation-select:hover,
.conversation-select:focus {
    color: inherit;
    text-decoration: none;
}

.conversation-item.active {
    background-color: rgba(108, 92, 231, 0.08);
}

.conversation-item:hover {
    background-color: #f8f9fa;
}

.delete-conversation {
    flex-shrink: 0;
    border-radius: 0.5rem;
}


.conversation-item.active {
    background-color: #e7f3ff;
    border-left: 4px solid var(--mateable-accent);
}

.alert-primary {
    background-color: var(--mateable-accent) !important;
    color: white;
    border: none;
    border-radius: 1rem;
}

.alert-secondary {
    background-color: #e9ecef;
    color: #333;
    border: none;
    border-radius: 1rem;
}
</style>
