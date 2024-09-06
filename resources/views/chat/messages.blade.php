<div class="messages-chat">
    @if (count($messages) > 0)
        @forelse($messages as $message)
            @if ($message->sender_id == auth()->id())
                @include('chat.sent', ['message' => $message])
            @else
                @include('chat.received', ['message' => $message])
            @endif
        @empty
            @include('chat.empty')
        @endforelse
    @endif
</div>
