/**
 * Created by Grigory on 03.04.2016.
 */
$(document).ready(function()
{
    //TODO: поменять URL
    var USER_TABLES_URL = "http://localhost/testquery/basic/web/index.php/query/usertables",
        USER_VIEWS_URL = "http://localhost/testquery/basic/web/index.php/query/userviews",
        USER_PROCEDURES_URL = "http://localhost/testquery/basic/web/index.php/query/userprocedures",
        USER_TRIGGERS_URL = "http://localhost/testquery/basic/web/index.php/query/usertriggers";


    /**
     *  Основа для таблиц
     */
    var SimpleDataTable = Backbone.View.extend({
        el: null,
        table: null,
        url: null,
        columns: null,
        initialize: function (settings)
        {
            this.el = settings.el;
            this.url = settings.url;
            this.render(this.url, settings.columns);
        },
        render: function(url, columns)
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": url,
                responsive: true,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "columns":  columns,
                "oLanguage": {
                    "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Подождите...',
                    "sLengthMenu": "_MENU_ записей",
                    "sEmptyTable": "Нет данных",
                    "sInfo": "Показано с _START_ по _END_ из _TOTAL_",
                    "sInfoEmpty": "Показано 0 записей",
                    "sInfoFiltered": "(отфильтровано из _MAX_)",
                    "sLoadingRecords": "Загрузка...",
                    "sSearch": "Поиск",
                    "sZeroRecords": "Подходящих записей не найдено",
                    "oPaginate": {
                        "sPrevious": "<",
                        "sNext": ">",
                        "sFirst": "<<",
                        "sLast": ">>"
                    }
                },
            });

            this.table = table;
        },
    });

    /**
     *  User tables
     */
    var userTables = new SimpleDataTable({ el: '#user-tables-table', url: USER_TABLES_URL,
        columns: [
            { "data": "TABLE_NAME" },
            { "data": "NUM_ROWS" },
            { "data": "AVG_SPACE" },
            { "data": "MAX_TRANS" },
            { "data": "TABLE_LOCK" },
        ]});

    var userViews = new SimpleDataTable({ el: '#user-views-table', url: USER_VIEWS_URL,
        columns: [
            { "data": "VIEW_NAME" },
            { "data": "TEXT" },
            { "data": "TEXT_LENGTH" },
            { "data": "VIEW_TYPE" },
        ]});

    var userProcedures = new SimpleDataTable({ el: '#user-procedures-table', url: USER_PROCEDURES_URL,
        columns: [
            { "data": "OBJECT_NAME" },
        ]});

    var userTriggers = new SimpleDataTable({ el: '#user-triggers-table', url: USER_TRIGGERS_URL,
        columns: [
            { "data": "TRIGGER_NAME" },
            { "data": "TRIGGER_TYPE" },
            { "data": "TRIGGERING_EVENT" },
            { "data": "TABLE_NAME" },
            { "data": "COLUMN_NAME" },
            { "data": "TRIGGER_BODY" },
            { "data": "ACTION_TYPE" },
            { "data": "STATUS" },
        ]});
});
