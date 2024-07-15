<?php

// Exemple de classe pour créer un composant. Copié depuis : https://symfony.com/bundles/ux-twig-component/current/index.html
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Alert
{
    public string $type = 'success';
    public string $message;
}