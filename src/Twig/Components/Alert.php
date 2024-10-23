<?php
// Class component example: https://symfony.com/bundles/ux-twig-component/current/index.html
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

interface AlertVariant
{
    const SUCCESS = 'success';
    const ERROR = 'error';
    const INFO = 'info';
}

#[AsTwigComponent]
class Alert
{
    public string $variant = AlertVariant::INFO;
    public string $title;
    public string $message;
    // time in seconds before alert is gone. If undefined, the alert stays until user switches page / closes the alert
    public float $timeout;
}
