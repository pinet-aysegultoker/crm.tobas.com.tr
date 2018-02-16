<div class="panel panel-crm">
    <div class="panel-heading"><h1>Tüm Müşteriler</h1></div>
    <div class="panel-body">
        <div id="customers-report"></div>
    </div>
</div>
<script type="text/javascript">
    FusionCharts.ready(function(){
        var fusioncharts = new FusionCharts({
                type: 'pie2d',
                renderAt: 'customers-report',
                width: '100%',
                height: '300',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Tüm Müşteriler",
                        "useDataPlotColorForLabels": "1",
                    },
                    "data": [{
                        "label": "Aktif",
                        "value": "{{ Customer::where('status', 'active')->count() }}"
                    }, {
                        "label": "Pasif",
                        "value": "{{ Customer::where('status', 'passive')->count() }}"
                    }, {
                        "label": "Silinmiş",
                        "value": "{{ Customer::where('status', 'removed')->count() }}"
                    }]
                }
            }
        );
        fusioncharts.render();
    });
</script>