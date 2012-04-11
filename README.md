# Elao TinyMce Bundle

Intégration du image manager et du file manager de tinymce avec symfony2

Ajout d'un input de type asset qui est lié a l'image manager


# Utilisation du champ asset

vous devez inclure le fichier js `/bundles/elaotinymce/js/input_asset.js`, le script de tinymce et le fichier `tiny_mce/plugins/imagemanager/`

Ensuite il suffit d'executer le code js suivant:

    <script type="text/javascript">
        $('monInput').inputAsset();
    </script>

Configuration disponible au niveau du champ:

- `delete_image`: l'image pour supprimer le fichier selectionné
- `delete_label`: la label qui apparait lorsque l'on est sur l'image delete
- `pick_up_image`: l'image pour ouvrir l'image manager
- `pick_up_label`: le label qui apparait lorsque la souris est sur l'image pickup
- `image_size`: la taille de la miniature


# Authenticator pour imagemanager et filemanager

Pour commencer, on doit modifier le fichier /tinymce/plugins/imagemanger/config.php ou /tinymce/plugins/filemanger/config.php

    'authenticator' = ExternalAuthenticator
    'ExternalAuthenticator.external_auth_url' = /app_dev.php/_tinymce/login
    'ExternalAuthenticator.secret_key' = someSecretKey

Configuration au niveau de symfony

    [yml]
    # config.yml
    elao_tiny_mce:
        is_login: false # par défaut personne n'a accès au manager, si true le role est ignoré
        role: ROLE_ADMIN #le role que doit avoir l'utilisateur pour accedez au media manager
        secret_key: someSecretKey
        configs:
            my.key: value

    [yml]
    # routing.yml
    elao_tiny_mce:
        resource: @ElaoTinyMceBundle/Resources/config/routing.yml

Element a configurer par l'application
- configs: un tableau de configuration pour le plugin voir ([http://www.tinymce.com/wiki.php/MCImageManager:Configuration](http://www.tinymce.com/wiki.php/MCImageManager:Configuration)).