<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

interface IconImage
{
    const SETTINGS = 'settings';
    const ZETIA = 'zetia-logo';
}

interface IconVariant
{
    const ROUND = 'round';
    const DEFAULT = 'default';
}

#[AsTwigComponent]
class Icon
{
    public string $icon;
    // to pass an href as prop, use {{ path('app_index') }} in a template
    public string $href;
    public string $variant = IconVariant::DEFAULT;
    public string $altText;

    #[PostMount]
    public function postMount(): void
    {
        if (!is_null($this->icon) && is_null($this->altText)) {
            switch ($this->icon) {
                case IconImage::SETTINGS:
                    $this->altText = 'Réglages';
                    break;
                case IconImage::ZETIA:
                    $this->altText = 'Le logo de Zetia Planning';
                    break;
            }
        }
    }
}
