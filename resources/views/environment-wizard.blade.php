@extends('installer::layouts.master')

@section('template_title')
    {{ trans('installer::messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    {!! trans('installer::messages.environment.menu.title') !!}
@endsection

@section('container')
    <form onsubmit="installSubmitted()" method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}">
        @csrf
        <input type="hidden" name="app_domain" value="{{ request()->host() }}">
        <div class="form-row row">
            <div class="col-12">
                <h5 class="mb-3">
                    {{ trans('installer::messages.environment.wizard.tabs.general') }}
                </h5>
                <div class="row">

                    <div class="form-group col-md-6 {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                        <label for="app_name">
                            {{ trans('installer::messages.environment.wizard.form.app_name_label') }}
                        </label>
                        <input type="text" name="app_name" id="app_name" value="{{ old('app_name') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_name_placeholder') }}" />
                        @if ($errors->has('app_name'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('app_name') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('app_admin_email') ? ' has-error ' : '' }}">
                        <label for="app_admin_email">
                            {{ trans('installer::messages.environment.wizard.form.app_admin_email_label') }}
                        </label>
                        <input type="text" name="app_admin_email" id="app_admin_email"
                            value="{{ old('app_admin_email') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_admin_email_placeholder') }}" />
                        @if ($errors->has('app_admin_email'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('app_admin_email') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                        <label for="app_url">
                            {{ trans('installer::messages.environment.wizard.form.app_url_label') }}
                        </label>
                        <input type="url" name="app_url" id="app_url" value="{{ request()->schemeAndHttpHost() }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_url_placeholder') }}" />
                        @if ($errors->has('app_url'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('app_url') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('license_key') ? ' has-error ' : '' }}">
                        <label for="license_key">
                            {{ trans('installer::messages.environment.wizard.form.license_key_label') }}
                        </label>
                        <input type="text" name="license_key" id="license_key" value="{{ old('license_key') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.license_key_placeholder') }}" />
                        @if ($errors->has('license_key'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('license_key') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('app_env') ? ' has-error ' : '' }}">
                        <label for="environment">
                            {{ trans('installer::messages.environment.wizard.form.app_env_label') }}
                        </label>
                        <select name="app_env" id="environment">
                            <option value="local">
                                {{ trans('installer::messages.environment.wizard.form.app_env_label_local') }}
                            </option>
                            <option value="development">
                                {{ trans('installer::messages.environment.wizard.form.app_env_label_developement') }}
                            </option>
                            <option value="production" selected>
                                {{ trans('installer::messages.environment.wizard.form.app_env_label_production') }}
                            </option>
                        </select>
                        @if ($errors->has('app_env'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('app_env') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                        <label for="app_debug">
                            {{ trans('installer::messages.environment.wizard.form.app_debug_label') }}
                        </label>
                        <select name="app_debug" id="app_debug">
                            <option value="true">
                                {{ trans('installer::messages.environment.wizard.form.app_debug_label_true') }}
                            </option>
                            <option value="false" selected>
                                {{ trans('installer::messages.environment.wizard.form.app_debug_label_false') }}
                            </option>
                        </select>
                        @if ($errors->has('app_debug'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('app_debug') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('cashier_currency') ? ' has-error ' : '' }}">
                        <label for="cashier_currency">
                            App currency
                        </label>
                        <select name="cashier_currency" id="cashier_currency">
                            @foreach (curriencies() as $key => $name)
                                <option value="{{ $key }}" @selected($key == old('cashier_currency', 'usd'))>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('cashier_currency'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('cashier_currency') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h5 class="mb-3">
                    {{ trans('installer::messages.environment.wizard.tabs.database') }}
                </h5>
                <div class="row">

                    <div class="form-group col-md-4 {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                        <label for="database_connection">
                            {{ trans('installer::messages.environment.wizard.form.db_connection_label') }}
                        </label>
                        <select name="database_connection" id="database_connection">
                            <option value="mysql" selected>
                                {{ trans('installer::messages.environment.wizard.form.db_connection_label_mysql') }}
                            </option>
                            <option value="sqlite">
                                {{ trans('installer::messages.environment.wizard.form.db_connection_label_sqlite') }}
                            </option>
                            <option value="pgsql">
                                {{ trans('installer::messages.environment.wizard.form.db_connection_label_pgsql') }}
                            </option>
                            <option value="sqlsrv">
                                {{ trans('installer::messages.environment.wizard.form.db_connection_label_sqlsrv') }}
                            </option>
                        </select>
                        @if ($errors->has('database_connection'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_connection') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                        <label for="database_hostname">
                            {{ trans('installer::messages.environment.wizard.form.db_host_label') }}
                        </label>
                        <input type="text" name="database_hostname" id="database_hostname"
                            value="{{ old('database_hostname', '127.0.0.1') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.db_host_placeholder') }}" />
                        @if ($errors->has('database_hostname'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_hostname') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                        <label for="database_port">
                            {{ trans('installer::messages.environment.wizard.form.db_port_label') }}
                        </label>
                        <input type="number" name="database_port" id="database_port" value="3306"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.db_port_placeholder') }}" />
                        @if ($errors->has('database_port'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_port') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                        <label for="database_name">
                            {{ trans('installer::messages.environment.wizard.form.db_name_label') }}
                        </label>
                        <input type="text" name="database_name" id="database_name"
                            value="{{ old('database_name') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.db_name_placeholder') }}" />
                        @if ($errors->has('database_name'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_name') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                        <label for="database_username">
                            {{ trans('installer::messages.environment.wizard.form.db_username_label') }}
                        </label>
                        <input type="text" name="database_username" id="database_username"
                            value="{{ old('database_username') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.db_username_placeholder') }}" />
                        @if ($errors->has('database_username'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_username') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                        <label for="database_password">
                            {{ trans('installer::messages.environment.wizard.form.db_password_label') }}
                        </label>
                        <input type="password" name="database_password" id="database_password"
                            value="{{ old('database_password') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.db_password_placeholder') }}" />
                        @if ($errors->has('database_password'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('database_password') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h5 class="mb-3">
                    {{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_label') }}
                    <a href="https://dashboard.stripe.com/test/apikeys" target="_blank"
                        title="{{ trans('installer::messages.environment.wizard.form.app_tabs.more_info') }}">
                        <i class="small fa fa-info-circle fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {{ trans('installer::messages.environment.wizard.form.app_tabs.more_info') }}
                        </span>
                    </a>
                </h5>
                <div class="row">
                    <div class="form-group col-md-4 {{ $errors->has('stripe_key') ? ' has-error ' : '' }}">
                        <label for="stripe_key">
                            {{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_key_label') }}
                        </label>
                        <input type="text" name="stripe_key" id="stripe_key" value="{{ old('stripe_key') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_key_palceholder') }}" />
                        @if ($errors->has('stripe_key'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('stripe_key') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('stripe_secret') ? ' has-error ' : '' }}">
                        <label
                            for="stripe_secret">{{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_secret_label') }}</label>
                        <input type="text" name="stripe_secret" id="stripe_secret"
                            value="{{ old('stripe_secret') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_secret_palceholder') }}" />
                        @if ($errors->has('stripe_secret'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('stripe_secret') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('stripe_webhook_secret') ? ' has-error ' : '' }}">
                        <label
                            for="stripe_webhook_secret">{{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_webhook_secret_label') }}</label>
                        <input type="text" name="stripe_webhook_secret" id="stripe_webhook_secret"
                            value="{{ old('stripe_webhook_secret') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_tabs.stripe_webhook_secret_palceholder') }}" />
                        @if ($errors->has('stripe_webhook_secret'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('stripe_webhook_secret') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h5 class="mb-3">
                    {{ trans('installer::messages.environment.wizard.form.app_tabs.recaptcha_label') }}
                    <a href="https://www.google.com/recaptcha/about/" target="_blank"
                        title="{{ trans('installer::messages.environment.wizard.form.app_tabs.more_info') }}">
                        <i class="small fa fa-info-circle fa-fw" aria-hidden="true"></i>
                        <span
                            class="sr-only">{{ trans('installer::messages.environment.wizard.form.app_tabs.more_info') }}</span>
                    </a>
                </h5>
                <div class="row">
                    <div class="form-group col-md-6 {{ $errors->has('recaptcha_site_key') ? ' has-error ' : '' }}">
                        <label for="recaptcha_site_key">
                            {{ trans('installer::messages.environment.wizard.form.app_tabs.recaptcha_site_key_label') }}
                        </label>
                        <input type="text" name="recaptcha_site_key" id="recaptcha_site_key"
                            value="{{ old('recaptcha_site_key') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_tabs.recaptcha_site_key_palceholder') }}" />
                        @if ($errors->has('recaptcha_site_key'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('recaptcha_site_key') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('recaptcha_secret_key') ? ' has-error ' : '' }}">
                        <label
                            for="recaptcha_secret_key">{{ trans('installer::messages.environment.wizard.form.app_tabs.recaptcha_secret_key_label') }}</label>
                        <input type="text" name="recaptcha_secret_key" id="recaptcha_secret_key"
                            value="{{ old('recaptcha_secret_key') }}"
                            placeholder="{{ trans('installer::messages.environment.wizard.form.app_tabs.recaptcha_secret_key_palceholder') }}" />
                        @if ($errors->has('recaptcha_secret_key'))
                            <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('recaptcha_secret_key') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3 text-center">
            <button id="install" class="btn button btn-lg" type="submit">
                {{ trans('installer::messages.environment.wizard.form.buttons.install') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
            <button style="display: none" id="installing" class="btn button btn-lg" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Installing...
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        function installSubmitted() {
            $("#install").hide();
            $("#installing").show();
        }
    </script>
@endsection
