<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

interface ButtonSize
{
    const DEFAULT = 'small';
    const WIDE = 'wide';
}

interface ButtonVariant
{
    const DEFAULT = 'light';
    const DANGER = 'plain-red';
    const CONFIRM = 'plain-green';
}

#[AsTwigComponent]
class Button
{
    public string $type = ButtonSize::DEFAULT;
    public string $variant = ButtonVariant::DEFAULT;
    public string $text = "";
    // to pass an href as prop, use {{ path('app_index') }} in a template
    public string $href;
}
