# Elao MceMedia Bundle : Description

#### This bundle handles the integration of File Manager and  Image Manager plugins inside TinyMCE

We added as an _extra feature_ an **input of type asset** that is linked to the Image Manager.
What's that ?

It adds next to the text input, an extra button to upload any image to the Image Manager. Once the upload is done, a preview of the image is shown.

Once the form is saved, it stores the image path.


# How to use the asset field ?

First, you must include the js file `/bundles/elaomcemedia/js/input_asset.js`, the TinyMCE script, and the file `tiny_mce/plugins/imagemanager/`

Then you just need to transform your text input into an asset input:

    <script type="text/javascript">
        $('myInput').inputAsset();
    </script>

Different configurations are available for the field:

- `delete_image`: The delete icon
- `delete_label`: The delete label that appears when hovering the delete_image
- `pick_up_image`: The icon to open the Image Manager plugin
- `pick_up_label`: The label that is shown when hovering the pick_up_image
- `image_size`: The size of the preview image


# Authenticator for Image Manager & File Manager

We need to modify the file `/tinymce/plugins/imagemanger/config.php` or/and `/tinymce/plugins/filemanger/config.php `

    'authenticator' = ExternalAuthenticator
    'ExternalAuthenticator.external_auth_url' = /_tinymce/login
    'ExternalAuthenticator.secret_key' = someSecretKey

Configuration under Symfony

    [yml]
    # config.yml
    elao_mce_media:
        is_login: false # Default nobody has access to the manager, but if true, the role is ignored
        role: ROLE_ADMIN # The role that the user must have in order to access to the manager
        secret_key: someSecretKey
        configs:
            my.key: value

    [yml]
    # routing.yml
    elao_mce_media:
        resource: @ElaoMceMediaBundle/Resources/config/routing.yml

Things to configure with the application
- configs: an array of config keys for the plugins ([http://www.tinymce.com/wiki.php/MCImageManager:Configuration](http://www.tinymce.com/wiki.php/MCImageManager:Configuration)).
