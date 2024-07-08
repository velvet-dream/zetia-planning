# HTML et les templates

## naming

On nomme les fichiers en snake case : "blog_post.html.twig", "default_theme.html.twig", "header.html.twig", etc.

Pour un composant, on 

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

Il y a également un répertoire `templates/app/` qui contient des bouts de template destiné à être réemployés par `base.html.twig`. 

## Les composants

Il ne faut pas hésiter à subdiviser les templates quand cela permet de refactoriser du code et d'éviter les répétitions. On peut pour cela créer des "composants", comme dans React, dans le sous-dossier "/components" qui sont des bouts de HTML faciles à réemployer, du style un bouton etc.

Voir : https://symfony.com/bundles/ux-twig-component/current/index.html