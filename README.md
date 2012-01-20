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

    'authenticator.login_page' = /_tinymce/login
    'authenticator` = 'SessionAuthenticator'
    'SessionAuthenticator.logged_in_key' = 'tiny_isLogin'
    'SessionAuthenticator.user_key' = 'tiny_userKey'
    'SessionAuthenticator.path_key' = 'tiny_pathKey'
    'SessionAuthenticator.rootpath_key' = 'tiny_rootpathKey'
    'SessionAuthenticator.config_prefix' = 'tiny_config'

Configuration au niveau de symfony

    [yml]
    # config.yml
    elao_tiny_mce:
        is_login: false # par défaut personne n'a accès au manager, si true le role est ignoré
        role: ROLE_ADMIN #le role que doit avoir l'utilisateur pour accedez au media manager
        path:  %kernel.root_dir%/../web/medias
        rootpath: %kernel.root_dir%/../web/medias
        configs:
            key: value

    [yml]
    # routing.yml
    elao_tiny_mce:
        resource: @ElaoTinyMceBundle/Resources/config/routing.yml

Il faut surement un service pour pour la configuration du service (pour être plus sous au niveau des parametres du manager (qui y a accès, a quel dossier et a quels actions))

Element a configurer par l'application

- path: chemin de départ au lancement du media manager (le même que rootpath la plupart du temps)
- rootpath: chemin absolue vers webdir
- userKey: contient une clé pour identifié l'utilisateur (utile dans le cas où path contient ${user} car sera remplacer par la clé du user)
- isLogin: indique si l'utilisateur a accès au media manager
- configs: un tableau de configuration pour le plugin voir ([http://www.tinymce.com/wiki.php/MCImageManager:Configuration](http://www.tinymce.com/wiki.php/MCImageManager:Configuration)).

Si vous souhaitez configurer encore plus finement le média manager, vous pouvez redéfinir le service `elao.tiny_mce.configuration`