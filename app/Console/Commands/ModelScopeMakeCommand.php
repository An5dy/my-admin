<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModelScopeMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:scope';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增模型本地作用域';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Scope';

    /**
     * @use      [模版文件]
     * @Author   ze
     * @date     2019/3/17 9:35 PM
     * @return string
     */
    protected function getStub()
    {
        $stub = __DIR__ . '/stubs/model-scope.stub';

        if ($this->option('active')) {
            $stub = __DIR__ . '/stubs/model-scope-active.stub';
        }

        return $stub;
    }

    /**
     * @use      [替换类名]
     * @Author   ze
     * @date     2019/3/17 10:51 PM
     * @param string $stub
     * @param string $name
     * @return mixed
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace('DummyClass', $this->getClassName($class), $stub);
    }

    /**
     * @use      [设置方法名]
     * @Author   ze
     * @date     2019/3/17 10:03 PM
     * @param string $name
     * @return mixed
     */
    protected function buildClass($name)
    {
        $replace = [
            'DummyScope' => lcfirst(class_basename($name)),
        ];

        if ($this->option('active')) {
            $replace['DummyVariable'] = lcfirst(Str::replaceFirst('scope', '', $replace['DummyScope']));
        }

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name));
    }

    /**
     * @use      [设置文件保存路径]
     * @Author   ze
     * @date     2019/3/17 10:57 PM
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $this->getClassName($name)) . '.php';
    }

    /**
     * @use      [设置类名]
     * @Author   ze
     * @date     2019/3/17 10:56 PM
     * @param $name
     * @return string
     */
    protected function getClassName($name)
    {
        return $name . 'Trait';
    }

    /**
     * @use      [设置创建选项]
     * @Author   ze
     * @date     2019/3/17 10:35 PM
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['active', null, InputOption::VALUE_NONE, '新增动态作用域'],
        ];
    }
}
