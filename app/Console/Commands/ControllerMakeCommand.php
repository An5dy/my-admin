<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Routing\Console\ControllerMakeCommand as BaseCommand;

class ControllerMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增控制器';

    /**
     * @use      [新增控制器]
     * @Author   ze
     * @date     2019/3/17 11:05 PM
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($rootNamespace === Str::replaceLast('\\', '', $this->laravel->getNamespace())) {

            return parent::getDefaultNamespace($rootNamespace);
        }

        return $rootNamespace . '\Controllers';
    }
}
