@extends('layouts.app')
@section('content')
    <dl>
        @foreach ($booking->getAttributes() as $name=>$value);
            <dd>{{ $name }}</dd>
            <dd>{{ $booking->$name }}</dd>
        @endforeach
    </dl>
    @endsection

