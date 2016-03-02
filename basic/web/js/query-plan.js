/**
 * Created by Grigory on 02.03.2016.
 */

$(document).ready(function()
{
    var planTable = $('#plan_table').DataTable({
        data: plan
    });

    $('#getQueryPlan').click(function()
    {
        if($('#query-input').val() != " ")
        {
            var query = $('#query-input').val();

            $.ajax({
                url: "http://localhost/testquery/basic/web/index.php/query/plantablejson?q=" + query,
                success: function (data)
                {
                    planTable.destroy();

                    planTable = $('#plan_table').DataTable({
                        data: JSON.parse(data)
                    });
                }
            });
        }
    });
} );
