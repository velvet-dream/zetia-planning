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
    public string $altText = "";
    public string $color = 'light';

    #[PostMount]
    public function postMount(): void
    {
        // Add default alt texts to icons
        if (!is_null($this->icon) && $this->altText === "") {
            switch ($this->icon) {
                case IconImage::SETTINGS:
                    $this->altText = 'Réglages';
                    break;
                case IconImage::ZETIA:
                    $this->altText = 'Le logo de Zetia Planning';
                    break;
                case IconImage::CROSS:
                    $this->altText = 'Fermer';
                    break;
                case IconImage::DASHBOARD:
                    $this->altText = 'Tableau de bord';
                    break;
                case IconImage::TRASH:
                    $this->altText = 'Supprimer';
                    break;
                case IconImage::VALID:
                    $this->altText = 'Valider';
                    break;
                case IconImage::PENCIL:
                    $this->altText = 'Éditer';
                    break;
                case IconImage::EYE:
                    $this->altText = 'Consulter';
                    break;
                case IconImage::LOGOUT:
                    $this->altText = 'Se déconnecter';
                    break;
                case IconImage::SEARCH:
                    $this->altText = 'Rechercher';
                    break;
                case IconImage::TEAM:
                    $this->altText = "L'équipe";
                    break;
                case IconImage::USER:
                    $this->altText = "Profil";
                    break;
                case IconImage::FOLDER:
                    $this->altText = "Projet ouvert";
                    break;
            }
        }
    }
}
