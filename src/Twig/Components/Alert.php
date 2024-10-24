<?php
// Class component example: https://symfony.com/bundles/ux-twig-component/current/index.html
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

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
    public string $message;
    // time in seconds before alert is gone. If null, the alert stays until user switches page / closes the alert
    public ?float $timeout = null;
    public string $title = "";

    /**
     * function called once after the component is mounted (we need its props to be defined)
     */
    #[PostMount]
    public function postMount(): void
    {
        if ($this->title === "") {
            switch ($this->variant) {
                case AlertVariant::SUCCESS:
                    $this->title = 'Opération réussie';
                    break;
                case AlertVariant::ERROR:
                    $this->title = 'Erreur';
                    break;
                default:
                    $this->title = 'Information';
            }
        }

        if (is_null($this->timeout) && $this->variant !== AlertVariant::ERROR) {
            $this->timeout = 5;
        }
    }
}
