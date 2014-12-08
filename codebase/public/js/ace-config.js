function configureEditor(editorId, language){
    var editor = ace.edit(editorId);
    editor.setTheme('ace/theme/github');
    editor.getSession().setMode('ace/mode/' + language);
    return editor;
}

var editor = configureEditor('editor', 'javascript');