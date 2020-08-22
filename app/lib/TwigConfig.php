<?php
namespace App\Config;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class TwigConfig{

    public function loader()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../public/views');
        $twig = new Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);

        return $twig;
    }
}