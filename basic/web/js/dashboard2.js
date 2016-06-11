/**
 * Created by Grigory on 03.04.2016.
 */
$(document).ready(function()
{
    //TODO: поменять URL
    var USER_TABLES_URL = "http://localhost/testquery/basic/web/index.php/query/usertables";

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
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "columns":  columns,
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
});
