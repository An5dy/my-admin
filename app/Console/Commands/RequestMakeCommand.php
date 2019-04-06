<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Foundation\Console\RequestMakeCommand as BaseCommand;

class RequestMakeCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新建表单验证类';

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

        return $rootNamespace . '\Requests';
    }
}