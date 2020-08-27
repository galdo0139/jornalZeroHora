<?php
namespace App\Config;

use App\User;
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

    public function renderTemplate(string $pageName, string $content, array $cssFiles = [])
    {
        $db = new Database();
        $user = new User($db);
        $userComponent = ($user->isLogged())?$this->render('userComponent.html'):"";
        
        $cssString = "";
        foreach ($cssFiles as $value) {
            $cssString .= "<link rel='stylesheet' href='$value'>";
        }
       


        return $this->render('template.html', [
            'title' => $pageName,
            'content' => $content,
            'style' => $cssString,
            'home' =>  '../',
            'userComponent' => $userComponent
        ]);

    }
}