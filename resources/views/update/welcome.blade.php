@extends('installer::layouts.master-update')

@section('title', trans('installer::messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">
        {{ trans('installer::messages.updater.welcome.message') }}
    </p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::overview') }}"
            class="btn button btn-lg">{{ trans('installer::messages.next') }}</a>
    </div>
@stop
