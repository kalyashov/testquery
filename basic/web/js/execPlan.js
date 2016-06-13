/**
 * Created by Grigory on 13.06.2016.
 */

$(document).ready(function()
{
    // TODO
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


    // TODO изменить URL
    var EXECUTION_PLAN_URL = "http://localhost/testquery/basic/web/index.php/query/execution-plan?sql=";

    var PlanTable = Backbone.View.extend({
        el: null,
        table: null,
        query: null,
        initialize: function(settings)
        {
            this.el = settings.el;
            this.url = settings.url;

            if(settings.query)
            {
                this.render(settings.query);
            }
        },
        render: function(criteria)
        {
            var $el = this.$el;
            var planTable = this;

            $.ajax({
                url: this.url + criteria,
                success: function (data)
                {
                    planData = JSON.parse(data);
                    $('#planInfo').text('Получен с помощью ' + planData.src).addClass('info');

                    var $maxCostRow = null,
                        counter = 0,
                        maxCost = 0;

                    planTable.table = $el.DataTable({
                        data: planData.data,
                        columns: [
                            { "data": "ID" },
                            { "data": "OPERATION" },
                            { "data": "OBJECT_NAME" },
                            { "data": "OPTIONS" },
                            { "data": "CARDINALITY" },
                            { "data": "COST" },
                        ],
                        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                        {
                            var $cost = $(nRow).children().eq(5);

                            if(counter && parseInt($cost.text()) > maxCost)
                            {
                                maxCost = $cost.text();
                                $maxCostRow = $(nRow);
                            }

                            counter++;
                        },
                        "oLanguage": {
                            "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Подождите...',
                            "sLengthMenu": "_MENU_ записей",
                            "sEmptyTable" : "Нет данных",
                            "sInfo" : "Показано с _START_ по _END_ из _TOTAL_",
                            "sInfoEmpty" : "Показано 0 записей",
                            "sInfoFiltered" : "(отфильтровано из _MAX_)",
                            "sLoadingRecords":"Загрузка...",
                            "sSearch":"Поиск",
                            "sZeroRecords":"Подходящих записей не найдено",
                            "oPaginate": {
                                "sPrevious": "Предыдущая",
                                "sNext": "Следующая",
                                "sFirst": "Первая",
                                "sLast": "Последняя"
                            }
                        },
                    });

                    $maxCostRow.addClass('danger');
                },
                error: function()
                {
                    // TODO use flash to show error info
                    $el.after('<div id="planTableAlert" class="alert alert-danger" role="alert">Невозможно получить план выполнения для данного запроса</div>');
                    $('#planTableAlert').slideUp(1800);
                }
            });
        },
        // criteria - query or sql_id
        reload: function(criteria)
        {
            if(this.table) {
                this.table.destroy();
            }

            this.render(criteria);
        }
    });

    var sqlPlanTable = new PlanTable({el: "#planTable", url: EXECUTION_PLAN_URL});

    $('#getPlanBtn').click(function()
    {
        var query = sqlEditor.getValue();
        if(query != " ")
        {
            sqlPlanTable.reload(query);
        }
    });
});
