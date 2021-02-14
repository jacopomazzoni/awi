/* (function() {
    tinymce.PluginManager.add( 'swpbtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('swpbtn', {
            title: '[AWIFY]',
            cmd: 'swpbtn',
            image: url + '/dashicon.png',
        });

        editor.addCommand('awify', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
           
            var open_column = '<span class="awi_brace">' + selected_text + '</span>';
            var close_column = '';
            var return_text = '';
            return_text = open_column + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})(); */

(function() {
    
    tinymce.PluginManager.add( 'swpbtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('swpbtn', {
            title: '[AWIFY]',
            cmd: 'swpbtn',
/*             image: url + '/dashicon.png',
 */           icon: 'notice'
        });
        

        editor.addCommand('swpbtn', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
           
            var open_column = '<span class="awi_brace">';
            var close_column = '</span>';
            var return_text = '';
            return_text = open_column + selected_text + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();