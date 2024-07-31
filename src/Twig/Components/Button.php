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
    public string $text;
    public string $href;
}
