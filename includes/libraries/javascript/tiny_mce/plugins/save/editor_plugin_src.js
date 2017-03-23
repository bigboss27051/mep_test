/**
 * $Id: editor_plugin_src.js 6572 2009-02-25 02:46:35Z Garbin $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
    tinymce.create('tinymce.plugins.Save', {
        init : function(ed, url) {
            var t = this;

            t.editor = ed;

            // Register commands
            ed.addCommand('mceSave', t._save, t);
            ed.addCommand('mceCancel', t._cancel, t);

            // Register buttons
            ed.addButton('save', {title : 'save.save_desc', cmd : 'mceSave'});
            ed.addButton('cancel', {title : 'save.cancel_desc', cmd : 'mceCancel'});

            ed.onNodeChange.add(t._nodeChange, t);
            ed.addShortcut('ctrl+s', ed.getLang('save.save_desc'), 'mceSave');
        },

        getInfo : function() {
            return {
                longname : 'Save',
                author : 'Moxiecode Systems AB',
                authorurl : 'http://tinymce.moxiecode.com',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/save',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        },

        // Private methods

        _nodeChange : function(ed, cm, n) {
            var ed = this.editor;

            if (ed.getParam('save_enablewhendirty')) {
                cm.setDisabled('save', !ed.isDirty());
           