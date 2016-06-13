/**
 * Created by Grigory on 13.06.2016.
 */
$(document).ready(function()
{
    /**
     * Редактор SQl-кода
     */
    var sqlEditor = CodeMirror.fromTextArea(document.getElementById('sqlCode'), {
        mode: 'text/x-plsql',
        indentWithTabs: true,
        smartIndent: true,
        lineNumbers: true,
        matchBrackets : true,
        autofocus: true,
        extraKeys: {"Ctrl-Space": "autocomplete"},
        hintOptions: {tables: {
            users: {name: null, score: null, birthDate: null},
            countries: {name: null, population: null, size: null}
        }}
    });
});