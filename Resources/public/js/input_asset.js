(function($) {
    $.fn.inputAsset = function(options){
        var defaults = {
            delete_image: '/bundles/elaomcemedia/images/input_asset/delete.png',
            delete_label: 'Delete',
            pick_up_image: '/bundles/elaomcemedia/images/input_asset/pick_up.png',
            pick_up_label: 'Pick Up',
            image_size: 150
        };

        var opts = $.extend(defaults, options);

        function showInput(id) {
            $('#' + id + '_preview').attr('src', '');
            $('#' + id + '_divPreview').hide();
            $('#' + id + '_divInput').show();
            $('#' + id).val('');
        }

        function showPreview(id, data) {
            var url = data.focusedFile.url;

            $('#' + id + '_preview').attr('src',url);
            $('#' + id).val(url);
            $('#' + id + '_divInput').hide();
            $('#' + id + '_divPreview').show();
        }

        return this.each(function() {
            var id = $(this).attr('id');
            var value = $(this).val();
            var name = $(this).attr('name');

            var html = '<div id="'+id+'_asset">'
                        + '<div id="'+id+'_divPreview">'
                            + '<img src="'+value+'" id="'+id+'_preview"/>'
                            + '<a href="#" class="asset_btn_delete" title="'+opts.delete_label+'">'
                                + '<img src="'+opts.delete_image+'" alt="'+opts.delete_label+'"/>'
                            + '</a>'
                        + '</div>'
                        + '<div id="'+id+'_divInput">'
                            + '<input type="text" name="'+name+'" value="'+value+'" id="'+id+'"/>'
                            + '<a href="#" class="asset_btn_add" title="'+opts.pick_up_label+'">'
                                +' <img src="'+opts.pick_up_image+'" alt="'+opts.pick_up_label+'"/>'
                            + '</a>'
                        + '</div>'
                    + '</div>';

            $(this).replaceWith(html);

            if (value != '') {
                $('#'+id+'_divPreview').show();
                $('#'+id+'_divInput').hide();
            } else {
                $('#'+id+'_divPreview').hide();
                $('#'+id+'_divInput').show();
            }

            $('#'+id+'_asset .asset_btn_delete').click(function(){
                showInput(id);
                return false;
            });

            $('#'+id+'_asset .asset_btn_add').click(function(){
                mcImageManager.browse({
                    oninsert : function(data) {
                        showPreview(id, data);
                    }
                });
                return false;
            });

            $('#' + id + '_preview').load(function(){
                var height = $(this).height();
                var width = $(this).width();
                if(height > width) {
                    if(height > opts.image_size) {
                        $(this).height(opts.image_size);
                    }
                } else {
                    if(width > opts.image_size) {
                        $(this).width(opts.image_size);
                    }
                }
            });
        });
    }
})(jQuery);