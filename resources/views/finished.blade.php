@extends('installer::layouts.master')

@section('template_title')
    {{ trans('installer::messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer::messages.final.title') }}
@endsection

@section('container')
    @if (session('message')['dbOutputLog'])
        <p><strong><small>{{ trans('installer::messages.final.migration') }}</small></strong></p>
        <pre class="scroll-area"><code>{{ session('message')['dbOutputLog'] }}</code></pre>
    @endif

    <p><strong><small>{{ trans('installer::messages.final.console') }}</small></strong></p>
    <pre><code>{{ $finalMessages }}</code></pre>

    <p><strong><small>{{ trans('installer::messages.final.log') }}</small></strong></p>
    <pre class="p-4"><code>{{ $finalStatusMessage }}</code></pre>

    <p><strong><small>{{ trans('installer::messages.final.env') }}</small></strong></p>
    <pre class="scroll-area p-4"><code>{{ $finalEnvFile }}</code></pre>

    <div class="buttons">
        <a href="{{ url('/') }}" class="btn button btn-lg">{{ trans('installer::messages.final.exit') }}</a>
    </div>
@endsection
