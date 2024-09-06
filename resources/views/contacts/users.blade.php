<div class="discussion select-users-list" data-user-name="{{ $user->name }}" data-user-id="{{ $user->id }}">
    <div class="photo"
        style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
        <div class="{{ $user->lastSeen() === 'Online' ? 'onlines' : 'offlines' }}"></div>
    </div>
    <div class="desc-user">
        <p class="name">{{ $user->name }}</p>
        <p class="message">{{ $user->latest_message() ?? 'Click to Open' }}</p>
    </div>
    @if ($user->unread_messages_count() > 0)
        <div class="message-count">{{ $user->unread_messages_count() }}</div>
    @endif
    <div class="timer {{ $user->lastSeen() === 'Online' ? 'online' : 'offline' }}">{{ $user->lastSeen() ?? '2Yr' }}
    </div>
</div>
