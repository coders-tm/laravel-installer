<?php

namespace Coderstm\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * @var string
     */
    private $envInstallerPath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
        $this->envInstallerPath = base_path('.env.installer');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath()
    {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath()
    {
        return $this->envExamplePath;
    }

    /**
     * Get the the .env.installer file path.
     *
     * @return string
     */
    public function getEnvInstallerPath()
    {
        return $this->envInstallerPath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
    {
        $message = trans('installer::messages.environment.success');

        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        } catch (Exception $e) {
            $message = trans('installer::messages.environment.errors');
        }

        return $message;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = trans('installer::messages.environment.success');

        try {
            $request->merge([
                'app_key' => 'base64:' . base64_encode(Str::random(32)),
                'db_connection' => $request->database_connection,
                'db_host' => $request->database_hostname,
                'db_port' => $request->database_port,
                'db_database' => $request->database_name,
                'db_username' => $request->database_username,
                'db_password' => $request->database_password,
            ]);

            $values = collect($request->input())->mapWithKeys(function ($value, $key) {
                return [strtoupper($key) => $value];
            })->all();

            $this->replaceEnvFromValues($values);
        } catch (Exception $e) {
            $results = trans('installer::messages.environment.errors');
        }

        return $results;
    }

    /**
     * Replace a env with values.
     *
     * @param array $values
     * @return void
     */
    function replaceEnvFromValues(array $values = [])
    {
        $lines = explode(PHP_EOL, $this->getEnvContent());

        foreach ($lines as &$line) {
            $keyValue = explode('=', $line, 2);
            $key = trim($keyValue[0]);

            if (isset($values[$key])) {
                $value = $values[$key];
                if (isMultiWord($value)) {
                    $value = '"' . $value . '"';
                }

                $line = "{$key}={$value}";
            }
        }

        $updatedContent = implode(PHP_EOL, $lines);

        file_put_contents($this->envPath, $updatedContent);
    }
}
