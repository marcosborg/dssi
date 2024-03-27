@extends('layouts.admin')
@section('content')
@section('styles')
<style>
    .client-message {
        text-align: right;
    }

    .outter-chat-message {
        border: solid 1px #cccccc;
        margin: 10px 0;
        padding: 10px;
    }
</style>
@endsection
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ trans('cruds.chat.title_singular') }} {{ trans('global.list') }}
            </div>
            <div class="card-body">
                <table class="table table-default">
                    <thead>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Data e hora</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->chats[0]->created_at }}</td>
                        <td><a class="btn btn-{{ $chat && $chat->id == $user->id ? 'success' : 'default' }} btn-sm"
                                href="/admin/chats/last/{{ $user->id }}">Chat</a></td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if ($chat)
        <div class="card">
            <div class="card-header">
                {{ $chat->name }}
            </div>
            <div class="card-body" style="height: 40vh" id="inner-chat"></div>
            <div class="card-footer">
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea class="form-control" id="message"></textarea>
                </div>
                <button class="btn btn-success btn-lg btn-block" sendMessage()>Enviar</button>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
@parent
@if ($chat)
<script>
    $(() => {
        getChatMessages();
        setInterval(() => {
            getChatMessages();
        }, 5000);
    });
    getChatMessages = () => {
        $.get('/admin/chats/ajax/{{ $chat->id }}').then((resp) => {
            $('#inner-chat').html(resp);
        });
    }
    sendMessage = () => {
        let message = $('#message').val();
        if(message.length > 0) {
                let data = {
                user_id: {{ $chat->id }},
                message: message
            }
            $.post({
                url: '/admin/chats/send-message',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
            });
        }
    }
</script>
@endif
@endsection