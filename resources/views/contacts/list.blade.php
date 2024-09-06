<div class="discussion select-contact-name" data-contact-name="{{ $contact->name }}" data-contact-id="{{ $contact->id }}">
    <div class="photo"
        style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
        <div class="{{ $contact->lastSeen() === 'Online' ? 'onlines' : 'offlines' }}"></div>
    </div>
    <div class="desc-contact">
        <p class="name">{{ $contact->name }}</p>
        <p class="message">{{ $contact->latest_message() ?? 'Click to Open' }}</p>
    </div>
    @if ($contact->unread_messages_count() > 0)
        <div class="message-count">{{ $contact->unread_messages_count() }}</div>
    @endif
    <div class="timer {{ $contact->lastSeen() === 'Online' ? 'online' : 'offline' }}">
        {{ $contact->lastSeen() ?? '2Yr' }}</div>
</div>
