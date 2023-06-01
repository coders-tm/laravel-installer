@extends('installer::layouts.master-update')

@section('title', trans('installer::messages.updater.final.title'))
@section('container')
    <p class="paragraph text-center">{{ session('message')['message'] }}</p>
    <div class="buttons">
        <a href="{{ url('/') }}" class="btn button btn-lg">{{ trans('installer::messages.updater.final.exit') }}</a>
    </div>
@stop
