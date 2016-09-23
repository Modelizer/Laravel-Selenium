<?php

namespace Modelizer\Selenium\Traits;

trait Helper
{
    /**
     * List of operating system.
     *
     * @var array
     */
    protected $os = [
        'darwin'  => 'mac',
        'winnt'   => 'win',
        'win32'   => 'win',
        'windows' => 'win',
        'linux'   => 'linux',
    ];

    /**
     * Get the real path with package path prepended.
     *
     * @param string $suffix suffix the file needed
     * @param bool   $assume Possible directory can be created.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public static function prependPackagePath($suffix, $assume = false)
    {
        $path = __DIR__."/../../$suffix";

        if (!$assume and !$path) {
            throw new \Exception("$path path does not exists.");
        }

        return $assume ? $path : realpath($path);
    }
}
