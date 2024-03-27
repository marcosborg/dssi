@foreach ($chat->chats as $chat)
<div class="outter-chat-message">
    <div class="{{ $chat->origin == 'client' ? 'client' : 'chat' }}-message">
        <small>{{ $chat->created_at }}</small><br>
        {{ $chat->message }}
    </div>
</div>
@endforeach