<?php
    $projects = Project::where('status','!=','removed')->get();
?>
@foreach($projects as $project)
    <?php
        $buildings = Building::where('project_id',$project->id)->where('status','!=','removed')->get();
    ?>
<div class="panel panel-crm">
    <div class="panel-heading"><h1>{{ $project->title }} Blokları</h1></div>
    <div class="panel-body">
        <div id="buildings-report-{{ $project->id }}"></div>
        <script type="text/javascript">
            FusionCharts.ready(function(){
                var fusioncharts = new FusionCharts({
                        type: 'mscolumn2d',
                        renderAt: 'buildings-report-{{ $project->id }}',
                        width: '100%',
                        height: '300',
                        dataFormat: 'json',
                        dataSource: {
                            "chart": {
                                "caption": "{{ $project->title }} Durum Grafiği",
                                "xAxisName": "Blok Adı",
                                "yAxisName": "Daire Sayısı",
                                "aligncaptiontocanvas": "0",
                                "showPlotBorder": "1",
                                "plotBorderThickness": "0.25",
                                "placevaluesInside": "1",
                                "decimalSeparator": ",",
                                "thousandSeparator": "."
                            },
                            "categories": [{
                                "category": [
                                        @foreach($buildings as $building)
                                    {
                                        "label": "{{ $building->title }}"
                                    },
                                    @endforeach
                                ]
                            }],
                            "dataset": [{
                                "seriesname": "Müsait",
                                "data": [
                                        @foreach($buildings as $building)
                                    {
                                        "value": "{{ Apartment::where('status','active')->where('building_id',$building->id)->count() }}"
                                    },
                                    @endforeach
                                ]
                            }, {
                                "seriesname": "Satılmış",
                                "data": [
                                        @foreach($buildings as $building)
                                    {
                                        "value": "{{ Apartment::where('status','passive')->where('building_id',$building->id)->count() }}"
                                    },
                                    @endforeach
                                ]
                            }, {
                                "seriesname": "Rezerve",
                                "data": [
                                        @foreach($buildings as $building)
                                    {
                                        "value": "{{ Apartment::where('status','reserved')->where('building_id',$building->id)->count() }}"
                                    },
                                    @endforeach
                                ]
                            }]
                        }
                    }
                );
                fusioncharts.render();
            });
        </script>
    </div>
</div>
@endforeach