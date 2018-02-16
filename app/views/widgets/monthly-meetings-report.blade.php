<div class="panel panel-crm">
    <div class="panel-heading"><h1>Ay Bazında Görüşmeler</h1></div>
    <div class="panel-body">
        <div id="monthly-meetings-report"></div>
    </div>
</div>
<script type="text/javascript">
    FusionCharts.ready(function(){
        var fusioncharts = new FusionCharts({
                type: 'column2d',
                renderAt: 'monthly-meetings-report',
                width: '100%',
                height: '300',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Ay Bazında Görüşmeler",
                        "xAxisName": "Ay",
                        "yAxisName": "Görüşme Sayısı",
                    },

                    "data": [
                    @for($a=0;$a<=5;$a++)
                        {
                            "label": "{{ Carbon::now()->subMonth($a)->format('M \'y') }}",
                            "value": "{{ Meeting::where('created_At', '>', Carbon::now()->subMonth($a)->startOfMonth())->where('created_At', '<', Carbon::now()->subMonth($a)->endOfMonth())->count() }}"
                        }
                        @if($a!==6)
                            ,
                        @endif
                    @endfor
                    ]
                }
            }
        );
        fusioncharts.render();
    });
</script>