<?php
namespace App\Library;

use App\Models\User;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class TwigConfig{
    private $twigEnviroment;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../public/views');
        $twig = new Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);

        $this->twigEnviroment = $twig; 
    }
    public function loader()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../public/views');
        $twig = new Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);

        return $twig;
    }

    public function render(string $name, array $context = [])
    {
        return $this->twigEnviroment->render($name, $context);
    }

    public function renderTemplate(string $pageName, string $content, array $cssFiles = [], $lvl = 1)
    {
        $pathLevel = "";
        for ($i=0; $i < $lvl ; $i++) { 
            $pathLevel .= '../';
        }


        $db = new Database();
        $user = new User($db);
        $userComponent = ($user->isLogged())?$this->render('userComponent.html', ['home' =>  $pathLevel]):"";
        


        $cssString = "";
        foreach ($cssFiles as $value) {
            $cssString .= "<link rel='stylesheet' href='{$pathLevel}css/{$value}'>";
        }
        
        return $this->render('template.html', [
            'title' => $pageName,
            'content' => $content,
            'style' => $cssString,
            'home' =>  $pathLevel,
            'maincss' => $pathLevel."css/main.css",
            'userComponent' => $userComponent
        ]);

    }
}