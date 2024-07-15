# HTML et les templates

## Naming

On nomme les fichiers en snake case : "blog_post.html.twig", "default_theme.html.twig", "header.html.twig", etc.

Pour un composant, c'est différent. Consulter la partie [Les composants](#les-composants)

## Architecture

On conserve le rangement par défaut de Symfony : les templates sont rangés dans un sous-dossier correspondant au controller qui les utilise.

À la racine de "templates", on a le fichier `base.html.twig` qui est le wrapper de toutes les pages de l'application. Il faut systématiquement l'étendre pour écrire le template d'une nouvelle page.

Il y a un block main dans `base.html.twig` qui est destiné à être rempli.

Exemple pour écrire un template pour une nouvelle page :
```twig
{# task/index.html.Twig #}
{% extends 'base.html.twig' %}

{% block title %}Vos tâches{% endblock %}

{% block main %}
    <h1>Tâches</h1>
    <!-- (du html...) -->
{% endblock %}
```

Il y a également un répertoire `templates/app/` qui contient des bouts de template destiné à être réemployés par `base.html.twig` (du genre le footer ou le header.)

## Les composants

Il ne faut pas hésiter à subdiviser les templates quand cela permet de refactoriser du code et d'éviter les répétitions. On peut pour cela créer des "composants", à la manière de React, qui sont des bouts de HTML faciles à réemployer, du style un bouton etc.

Voir : https://symfony.com/bundles/ux-twig-component/current/index.html

Pour créer un composant, il faut deux fichiers :
1. une classe PHP qui ira dans src/Twig/Components/NomDuComposant.php
2. son template Twig qui ira dans le sous-dossier "src/templates/components" 

Dans les deux cas, le nom du fichier s'écrit en PascalCase, contrairement aux autres fichiers twig, pour la simple raison que le template doit avoir exactement le même nom (extension exclue bien sûr) que sa classe PHP.

Ensuite, il suffit de les appeler de cette manière :

```twig
{{ component('Alert', { message: 'Hello Twig Components!' }) }}

<twig:Alert message="Or use the fun HTML syntax!" />
```