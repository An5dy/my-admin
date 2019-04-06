<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Foundation\Console\ResourceMakeCommand as BaseCommand;

class ResourceMakeCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增 api 资源类';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($rootNamespace === Str::replaceLast('\\', '', $this->laravel->getNamespace())) {

            return parent::getDefaultNamespace($rootNamespace);
        }

        return $rootNamespace . '\Resources';
    }
}