/**
 * Created by Grigory on 12.06.2016.
 */
$(document).ready(function()
{
    // TODO: поменять URL
    var SQL_BY_ELAPSED_TIME_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByElapsedTime/',
        SQL_BY_CPU_TIME_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByCpuTime/',
        SQL_BY_BUFFER_GETS_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByBufferGets/',
        SQL_BY_DISK_READS_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByDiskReads/',
        SQL_BY_EXECUTIONS_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByExecutions/',
        SQL_BY_PARSE_CALLS_URL = 'http://localhost/testquery/basic/web/index.php/sql-stats/sqlByParseCalls/';

    var SqlByElapsedTime = Backbone.View.extend({
        el: '#sqlByElapsedTime',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_ELAPSED_TIME_URL,
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "columns": [
                    { "data": "ELAPSED_TIME" },
                    { "data": "EXECUTIONS" },
                    { "data": "CPU_TIME"},
                    { "data": "DISK_READS" },
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $elapsedTimeCell = $(nRow).children().eq(0),
                            elapsedTime = $elapsedTimeCell.text(),
                            $cpuTimeCell = $(nRow).children().eq(2),
                            cpuTime = $cpuTimeCell.text(),
                            $sqlFullText = $(nRow).children().eq(6);

                        $elapsedTimeCell.addClass('danger');
                        $elapsedTimeCell.text(parseFloat(elapsedTime / microSec).toFixed(2));
                        $cpuTimeCell.text(parseFloat(cpuTime / microSec).toFixed(2));

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

             $('#queryInfoModal').modal('show');
             $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

             //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var SqlByCpuTime = Backbone.View.extend({
        el: '#sqlByCpuTime',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_CPU_TIME_URL,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columns": [
                    { "data": "CPU_TIME"},
                    { "data": "EXECUTIONS" },
                    { "data": "ELAPSED_TIME" },
                    { "data": "DISK_READS" },
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $elapsedTimeCell = $(nRow).children().eq(2),
                            elapsedTime = $elapsedTimeCell.text(),
                            $cpuTimeCell = $(nRow).children().eq(0),
                            cpuTime = $cpuTimeCell.text(),
                            $sqlFullText = $(nRow).children().eq(6);

                        $cpuTimeCell.addClass('danger');
                        $elapsedTimeCell.text(parseFloat(elapsedTime / microSec).toFixed(2));
                        $cpuTimeCell.text(parseFloat(cpuTime / microSec).toFixed(2));

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

            //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var SqlByBufferGets = Backbone.View.extend({
        el: '#sqlByBufferGets',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_BUFFER_GETS_URL,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columns": [
                    { "data": "BUFFER_GETS"},
                    { "data": "CPU_TIME"},
                    { "data": "EXECUTIONS" },
                    { "data": "ELAPSED_TIME" },
                    { "data": "DISK_READS" },
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $bufferGetsCell = $(nRow).children().eq(0),
                            $elapsedTimeCell = $(nRow).children().eq(3),
                            elapsedTime = $elapsedTimeCell.text(),
                            $cpuTimeCell = $(nRow).children().eq(1),
                            cpuTime = $cpuTimeCell.text(),
                            $sqlFullText = $(nRow).children().eq(7);

                        $bufferGetsCell.addClass('danger');
                        $elapsedTimeCell.text(parseFloat(elapsedTime / microSec).toFixed(2));
                        $cpuTimeCell.text(parseFloat(cpuTime / microSec).toFixed(2));

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

            //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var SqlByDiskReads = Backbone.View.extend({
        el: '#sqlByDiskReads',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_DISK_READS_URL,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columns": [
                    { "data": "DISK_READS"},
                    { "data": "CPU_TIME"},
                    { "data": "EXECUTIONS" },
                    { "data": "ELAPSED_TIME" },
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $diskReadsCell = $(nRow).children().eq(0),
                            $elapsedTimeCell = $(nRow).children().eq(3),
                            elapsedTime = $elapsedTimeCell.text(),
                            $cpuTimeCell = $(nRow).children().eq(1),
                            cpuTime = $cpuTimeCell.text(),
                            $sqlFullText = $(nRow).children().eq(6);

                        $diskReadsCell.addClass('danger');
                        $elapsedTimeCell.text(parseFloat(elapsedTime / microSec).toFixed(2));
                        $cpuTimeCell.text(parseFloat(cpuTime / microSec).toFixed(2));

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

            //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var SqlByExecutions = Backbone.View.extend({
        el: '#sqlByExecutions',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_EXECUTIONS_URL,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columns": [
                    { "data": "EXECUTIONS" },
                    { "data": "ROWS_PROCESSED" },
                    { "data": "CPU_TIME"},
                    { "data": "ELAPSED_TIME" },
                    { "data": "DISK_READS"},
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $executionsCell = $(nRow).children().eq(0),
                            $elapsedTimeCell = $(nRow).children().eq(2),
                            elapsedTime = $elapsedTimeCell.text(),
                            $cpuTimeCell = $(nRow).children().eq(3),
                            cpuTime = $cpuTimeCell.text(),
                            $sqlFullText = $(nRow).children().eq(7);

                        $executionsCell.addClass('danger');
                        $elapsedTimeCell.text(parseFloat(elapsedTime / microSec).toFixed(2));
                        $cpuTimeCell.text(parseFloat(cpuTime / microSec).toFixed(2));

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

            //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    var SqlByParseCalls = Backbone.View.extend({
        el: '#sqlByParseCalls',
        isInit: false,
        initialize: function ()
        {
            this.render();
        },
        events:
        {
            'click tbody tr' : 'rowClick',
        },
        render: function()
        {
            var sqlTable = this;

            var table = this.$el.DataTable( {
                "ajax": SQL_BY_PARSE_CALLS_URL,
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ],
                "aoColumnDefs": [
                    { 'bSortable': false }
                ],
                "order": [[ 0, "desc" ]],
                'iDisplayLength': 10,
                'bLengthChange': false,
                "bPaginate": false,
                "columns": [
                    { "data": "PARSE_CALLS"},
                    { "data": "EXECUTIONS" },
                    { "data": "SQL_ID" },
                    { "data": "MODULE" },
                    { "data": "SQL_FULLTEXT" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull )
                {
                    if(!sqlTable.isInit)
                    {
                        var microSec = 1000000;

                        var $parseCallsCell = $(nRow).children().eq(0),
                            $sqlFullText = $(nRow).children().eq(4);

                        $parseCallsCell.addClass('danger');

                        // обрезаем длинный текст
                        if ($sqlFullText.text().length > 50) {
                            $sqlFullText.text($sqlFullText.text().slice(0, 50) + '...');
                        }
                    }
                },
                "initComplete": function()
                {
                    sqlTable.isInit = true;
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
                    "sZeroRecords":"Подходящих записей не найдено"
                },
            });

            this.table = table;
        },
        rowClick: function(e)
        {
            var curRow = this.table.row(e.currentTarget).data();

            $('#queryInfoModal').modal('show');
            $('#queryInfoModal .modal-body #sqlText .sql').text(curRow.SQL_FULLTEXT);

            //new PlanTable({el: '#sqlPlanTable', query: curRow.SQL_FULLTEXT});
        }
    });

    new SqlByElapsedTime();
    new SqlByCpuTime();
    new SqlByBufferGets();
    new SqlByDiskReads();
    new SqlByExecutions();
    new SqlByParseCalls();
});
