/**
 * Created by Grigory on 03.04.2016.
 */
$(document).ready(function()
{
    //TODO: поменять URL
    var USER_TABLES_URL = "http://localhost/testquery/basic/web/index.php/query/usertables";

    var doughnutData = [
        {
            value: 300,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        },
        {
            value: 40,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "Grey"
        },
        {
            value: 120,
            color: "#4D5360",
            highlight: "#616774",
            label: "Dark Grey"
        }
    ];

    // Get context with jQuery - using jQuery's .get() method.
    var ctx = $("#dbSize").get(0).getContext("2d");

    var dbSizeDiagram =  new Chart(ctx).Doughnut(doughnutData, {responsive : true});


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
