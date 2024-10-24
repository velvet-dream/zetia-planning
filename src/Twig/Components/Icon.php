<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

interface IconImage
{
    const SETTINGS = 'settings';
    const ZETIA = 'zetia';
    const CROSS = 'close';
    const DASHBOARD = 'dashboard';
    const TRASH = 'delete';
    const VALID = 'done';
    const PENCIL = 'edit';
    const EYE = 'eye';
    const LOGOUT = 'logout';
    const SEARCH = 'search';
    const TEAM = 'team';
    const USER = 'user';
    const FOLDER = 'folder';
}

interface IconVariant
{
    const ROUND = 'round';
    const DEFAULT = 'default';
}

#[AsTwigComponent]
class Icon
{
    public int $size = 30;
    public string $icon;
    // to pass an href as prop, use {{ path('app_index') }} in a template
    public ?string $href;
    public string $variant = IconVariant::DEFAULT;
    public string $alt = "";
    public string $color = 'light';

    #[PostMount]
    public function postMount(): void
    {
        // Add default alt texts to icons
        if (!is_null($this->icon) && $this->alt === "") {
            switch ($this->icon) {
                case IconImage::SETTINGS:
                    $this->alt = 'Réglages';
                    break;
                case IconImage::ZETIA:
                    $this->alt = 'Le logo de Zetia Planning';
                    break;
                case IconImage::CROSS:
                    $this->alt = 'Fermer';
                    break;
                case IconImage::DASHBOARD:
                    $this->alt = 'Tableau de bord';
                    break;
                case IconImage::TRASH:
                    $this->alt = 'Supprimer';
                    break;
                case IconImage::VALID:
                    $this->alt = 'Valider';
                    break;
                case IconImage::PENCIL:
                    $this->alt = 'Éditer';
                    break;
                case IconImage::EYE:
                    $this->alt = 'Consulter';
                    break;
                case IconImage::LOGOUT:
                    $this->alt = 'Se déconnecter';
                    break;
                case IconImage::SEARCH:
                    $this->alt = 'Rechercher';
                    break;
                case IconImage::TEAM:
                    $this->alt = "L'équipe";
                    break;
                case IconImage::USER:
                    $this->alt = "Profil";
                    break;
                case IconImage::FOLDER:
                    $this->alt = "Projet ouvert";
                    break;
            }
        }
    }
}
