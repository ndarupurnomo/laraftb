<!-- ckeditor -->
<script type="text/javascript" src="/bower_components/ckeditor/ckeditor.js"></script>
<!-- initialize ckeditor -->
<script data-sample='1'>
    // Replace the <textarea id="editor1"> with an CKEditor
    // instance, using the "bbcode" plugin, customizing some of the
    // editor configuration options to fit BBCode environment.
    CKEDITOR.replace( '{{ $control_field }}', {
        height: 280,
        // Add plugins providing functionality popular in BBCode environment.
        extraPlugins: 'bbcode,smiley,font,colorbutton',
        // Remove unused plugins.
        removePlugins: 'filebrowser,format,horizontalrule,pastetext,pastefromword,scayt,showborders,stylescombo,table,tabletools,wsc',
        // Remove unused buttons.
        removeButtons: 'Anchor,BGColor,Font,Strike,Subscript,Superscript',
        // Width and height are not supported in the BBCode format, so object resizing is disabled.
        disableObjectResizing: true,
        // Define font sizes in percent values.
        fontSize_sizes: "30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%",
        // Strip CKEditor smileys to those commonly used in BBCode.
        smiley_images: [
            'regular_smile.png', 'sad_smile.png', 'wink_smile.png', 'teeth_smile.png', 'tongue_smile.png',
            'embarrassed_smile.png', 'omg_smile.png', 'whatchutalkingabout_smile.png', 'angel_smile.png',
            'shades_smile.png', 'cry_smile.png', 'kiss.png'
        ],
        smiley_descriptions: [
            'smiley', 'sad', 'wink', 'laugh', 'cheeky', 'blush', 'surprise',
            'indecision', 'angel', 'cool', 'crying', 'kiss'
        ]
    });
</script>
