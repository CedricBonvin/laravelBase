@extends('emails.layouts.base')

@section('name')
    {{ $name }}
@endsection

@section('content')
        Merci pour votre inscription sur jeu-alcool.fr, afin de vous connecter, vous devez activer votre compte.
@endsection

@section('button')
    Activer votre compte
@endsection

@section('link')
    {{ $url }}
@endsection

