<div class="panel panel-crm">
    <div class="panel-heading"><h1>Tüm Görüşmeler</h1></div>
    <div class="panel-body">
        <div id="meetings-report"></div>
    </div>
</div>
<script type="text/javascript">
    FusionCharts.ready(function(){
        var fusioncharts = new FusionCharts({
                type: 'doughnut2d',
                renderAt: 'meetings-report',
                width: '100%',
                height: '300',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Tüm Görüşmeler",
                        "defaultcenterlabel": "Toplam Görüşme: {{ Meeting::where('status', '!=', 'removed')->count() }}"
                    },
                    "data": [
                        {
                            "label": "Başlamış",
                            "value": "{{ Meeting::where('status', 'started')->count() }}"
                        },
                        {
                            "label": "Güncel",
                            "value": "{{ Meeting::where('status', 'updated')->count() }}"
                        },
                        {
                            "label": "Tamamlanmış",
                            "value": "{{ Meeting::where('status', 'finished')->count() }}"
                        }
                    ]
                }
            }
        );
        fusioncharts.render();
    });
</script>