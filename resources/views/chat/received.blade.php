<div class="message send-message">
    <div class="photo" 
         style="background-image: url('{{ $message->sender->profile_photo_url ?? 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80'}}');">
        <div class="{{ $message->sender->lastSeen() === 'Online' ? 'onlines' : 'offlines' }}"></div>
    </div>
    <p class="text">{{ $message->message }} <span>{{ $message->created_at->format('g:i A')  }}</span></p>
</div>


{{-- <p class="time">{{ $message->created_at->diffForHumans() }}</p> --}}

{{-- <div class="message">
    <div class="photo"
        style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
        <div class="online"></div>
    </div>
    <p class="text"> </p>
</div>
<p class="time"></p>  --}}
