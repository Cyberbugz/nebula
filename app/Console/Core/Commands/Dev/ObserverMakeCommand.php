<?php

namespace App\Console\Core\Commands\Dev;

use App\Console\Core\Concerns\ModelQualifier;
use App\Console\Core\Concerns\OptionsExtender;
use Illuminate\Foundation\Console\ObserverMakeCommand as BaseObserverMakeCommand;

class ObserverMakeCommand extends BaseObserverMakeCommand
{
    use OptionsExtender, ModelQualifier;

    protected function getDefaultNamespace($rootNamespace): string
    {
        if (! is_null($module = $this->option('module'))) {
            return get_module_namespace($rootNamespace, $module,
                [
                    'Domain',
                    'Observers',
                ]
            );
        }

        return parent::getDefaultNamespace($rootNamespace);
    }
}
