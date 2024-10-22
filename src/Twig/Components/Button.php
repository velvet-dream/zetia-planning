<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

interface ButtonSize
{
    const DEFAULT = 'default';
    const WIDE = 'wide';
}

interface ButtonVariant
{
    const DEFAULT = 'light';
    const DANGER = 'danger';
    const CONFIRM = 'confirm';
}

#[AsTwigComponent]
class Button
{
    public string $size = ButtonSize::DEFAULT;
    public string $variant = ButtonVariant::DEFAULT;
    public string $text = "";
    // to pass an href as prop, use {{ path('app_index') }} in a template
    public string $href;
}
