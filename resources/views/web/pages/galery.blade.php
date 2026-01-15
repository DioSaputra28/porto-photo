@extends('web.layouts.app')

@section('content')
@livewire('galery', ['category' => request()->query('category')])
@endsection