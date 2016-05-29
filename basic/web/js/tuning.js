/**
 * Created by Grigory on 02.03.2016.
 */

$(document).ready(function()
{
    var LONG_RUNNING_QUERYIES_URL = 'http://localhost/testquery/basic/web/index.php/site/long';
    var QUERY_PLAN = "http://localhost/testquery/basic/web/index.php/query/plantablejson?q=";
    /**
     *  Основа для таблиц
     */
    var SqlTable = Backbone.View.extend({
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
        events:
        {
            'click tr' : 'rowClick',
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
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    // обрезаем длинный текст
                    var $sqlFullText = $(nRow).children().eq(1);
                    if($sqlFullText.text().length > 50)
                    {
                        $sqlFullText.text($sqlFullText.text().slice(0,50) + '...');
                    }
                },

            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body .content').text(curRow.SQL_FULLTEXT);

            new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var longRunningQueriesTable = new SqlTable({el: '#long-running-queries', url: LONG_RUNNING_QUERYIES_URL,
        columns: [
            { "data": "SQL_ID" },
            { "data": "SQL_FULLTEXT" },
            { "data": "ELAPSED_TIME" },
            { "data": "CHILD_NUMBER" },
            { "data": "DISK_READS" },
            { "data": "EXECUTIONS" },
            { "data": "FIRST_LOAD_TIME" },
            { "data": "LAST_LOAD_TIME" },
            { "data": "CPU_TIME"},
    ]});


    var PlanTable = Backbone.View.extend({
        el: null,
        table: null,
        query: null,
        initialize: function(settings)
        {
            this.el = settings.el;
            this.render(settings.query);
        },
        render: function(query)
        {
            var $el = this.$el;
            $.ajax({
                url: QUERY_PLAN + query,
                success: function (data)
                {
                    $el.DataTable({
                        data: JSON.parse(data)
                    });
                },
                error: function()
                {
                    $el.after('<div id="planTableAlert" class="alert alert-danger" role="alert">Невозможно получить план выполнения для данного запроса</div>');
                    $('#planTableAlert').slideUp(1800);
                }
            });
        }
    });


    $('#getQueryPlan').click(function()
    {
        if($('#query-input').val() != " ")
        {
            var query = $('#query-input').val();
            console.debug('sdf');
            var sqlPlanTable = new PlanTable({el: '#plan_table', query: query});


            /*$.ajax({
                url: "http://localhost/testquery/basic/web/index.php/query/plantablejson?q=" + query,
                success: function (data)
                {
                    planTable.destroy();

                    planTable = $('#plan_table').DataTable({
                        data: JSON.parse(data)
                    });

                    planTable
                        .rows(1)
                        .nodes()
                        .to$()      // Convert to a jQuery object
                        .addClass( 'warning' );
                }
            });*/


        }
    });
} );
