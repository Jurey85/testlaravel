@extends('layouts.app')

@section('content')

<div class="col-4 offset-4">
    <h1>Chatroom</h1>
        <chat-log :messages="messages"></chat-log>
        <chat-composer v-on:messagesent="addMessage"></chat-composer> 
</div>


@endsection