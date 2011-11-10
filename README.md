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

Pour commencer, on doit modifier le fichier /tinymce/plugins/imagemanger/config.php

On doit modifier la ligne qui contient `$mcFileManagerConfig['authenticator']` ou `$mcImageManagerConfig['authenticator']` et indiquer que l'on veut utiliser le SessionAuthenticator

Ensuite il faut modifier la configuration de cet authenticator avec les valeurs suivantes:

- SessionAuthenticator.logged_in_key
- SessionAuthenticator.user_key
- SessionAuthenticator.path_key
- SessionAuthenticator.rootpath_key
- SessionAuthenticator.config_prefix