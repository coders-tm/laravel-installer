@extends('installer::layouts.master-update')

@section('title', trans('installer::messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">
        {{ trans_choice('installer::messages.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending]) }}
    </p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::database') }}"
            class="btn button btn-lg">{{ trans('installer::messages.updater.overview.install_updates') }}</a>
    </div>
@stop
