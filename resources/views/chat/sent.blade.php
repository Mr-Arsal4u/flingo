<div class="message text-only">
    <div class="response">
        <p class="text">
            {{ $message->message }}
            <span>{{ $message->created_at->format('g:i A') }}
                @if ($message->status == 'sent')
                    <i class="fa fa-check"></i>
                @elseif($message->status == 'delivered')
                    <i class="fa fa-check"></i>
                    <i class="fa fa-check"></i>
                @elseif($message->status == 'seen')
                    <i class="fa fa-check" style="color: rgb(63, 63, 242);"></i>
                    <i class="fa fa-check" style="color: rgb(63, 63, 242);"></i>
                @endif
            </span>
        </p>
    </div>
</div>
{{-- <p class="response-time time"></p> --}}

{{-- <div class="message text-only">
    <div class="response">
        <p class="text"> </p>
    </div>
</div>
<p class="response-time time"> </p> --}}
