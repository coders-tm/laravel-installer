<?php

namespace Coderstm\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Coderstm\LaravelInstaller\Events\LaravelInstallerFinished;
use Coderstm\LaravelInstaller\Helpers\EnvironmentManager;
use Coderstm\LaravelInstaller\Helpers\FinalInstallManager;
use Coderstm\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \Coderstm\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \Coderstm\LaravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \Coderstm\LaravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('installer::finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
