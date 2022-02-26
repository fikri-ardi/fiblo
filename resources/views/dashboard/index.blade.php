@extends('layouts.main', ['title'=>'Fiblo | Dashboard'])

@section('content')
<h1>Hai, {{ auth()->user()->name }}</h1>
@endsection