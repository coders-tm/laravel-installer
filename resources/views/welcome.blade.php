@extends('installer::layouts.master')

@section('template_title')
    {{ trans('installer::messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('installer::messages.welcome.title') }}
@endsection

@section('container')
    <p class="text-center">
        {{ trans('installer::messages.welcome.message') }}
    </p>
    <p class="text-center">
        <a href="{{ route('LaravelInstaller::requirements') }}" class="btn button btn-lg">
            {{ trans('installer::messages.welcome.next') }}
            <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
        </a>
    </p>
@endsection
