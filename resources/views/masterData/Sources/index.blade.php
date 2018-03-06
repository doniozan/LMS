@extends('layouts.app')

@section('stylesheet')
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sources</title>

    <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.png" rel="icon" type="image/png">
    <link href="img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="css/lib/lobipanel/lobipanel.min.css">
    <link rel="stylesheet" href="css/separate/vendor/lobipanel.min.css">
    <link rel="stylesheet" href="css/lib/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="css/separate/pages/widgets.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
	<div class="page-content">
        <div class="container-fluid">
            <section class="card card-blue-fill">            
                <header class="card-header">
                    Data Sources
                    <button type="button" class="modal-close">
                        <a href="javascript:history.go(-1)"><i style='color: white;' class="font-icon font-icon-arrow-left"> Back</i></a>
                    </button>
                </header>
                <div class="card-block">                   
                    <button class="btn-square-icon"
                        data-toggle="modal"
                        data-target=".MdlAddNew">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </button>
                    <button type="button" class="btn-square-icon" data-toggle="modal" data-target="#UploadModal">
                        <i class="fa fa-upload"></i>
                        Export
                    </button>
                </div>
            </section>
            <section class="card">
                <div class="card-block">
                    <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Source Name</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Sources as $data)
								<tr>
									<td><a onclick="ubah({{ $data->id_sources }});">{{ $data->nama_sources }}</a></td>
									<td>
                                        <span class="red with-sub">
                                                <a onclick="ubah({{ $data->id_sources }});">
                                                    <i class="font-icon font-icon-pencil"></i>
                                                </a>
                                                <a onclick="hapus({{ $data->id_sources }});">
                                                    <i class="font-icon font-icon-del"></i>
                                                </a>
                                        </span>                           
                                    </td>
								</tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade MdlAddNew"
                     tabindex="-1"
                     role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Input Data Sources</h4>
                </div>
                <div class="modal-body">
                    <form action="/setupsources/add" method="post">
                    	{{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="Nama Tim"><span style="color:red;">*</span>Sources Name</label>
                                    <input type="text" class="form-control" name="nama_sources" placeholder="Name Sources" required>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <button type="submit" class="btn">Simpan</button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade MdlEdit"
                     tabindex="-1"
                     role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Data Sources</h4>
                </div>
                <div class="modal-body">
                    <form action="/setupsources/edit" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_sources" id="id_sources_edit">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="Sources Name"><span style="color:red;">*</span>Sources Name</label>
                                    <input type="text" class="form-control" name="nama_sources" id="nama_sources_edit" placeholder="Sources Name" required>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <button type="submit" class="btn">Simpan</button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
	<script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/tether/tether.min.js"></script>
    <script src="js/lib/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>

    <script type="text/javascript" src="js/lib/jqueryui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/lib/lobipanel/lobipanel.min.js"></script>
    <script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>

        function hapus(id_sources){
            if(confirm('Yakin Akan Menghapus Data ?'))
            {
                $.ajax({
                    url: '/setupsources/delete/'+id_sources,
                    type: "get",
                    success: function(response)
                    {
                        location.href= "/setupsources";
                        alert('Delete Success');
                    }
                });
            }
        }

        function ubah(id_sources){
            $.ajax({
                url: '/setupsources/search/'+id_sources,
                type: "get",
                success: function(response)
                {
                    respon = JSON.parse(response);
                    $('#nama_sources_edit').val(respon[0].nama_sources);
                    $('#id_sources_edit').val(respon[0].id_sources);
                    $('.MdlEdit').modal();
                }
            });
        }
    	
        $(document).ready(function() {
        	$('#datatable').DataTable();
            $('.panel').lobiPanel({
                sortable: true
            });
            $('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
                $('.dahsboard-column').matchHeight();
            });

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Day');
                dataTable.addColumn('number', 'Values');
                // A column for custom tooltip content
                dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
                dataTable.addRows([
                    ['MON',  130, ' '],
                    ['TUE',  130, '130'],
                    ['WED',  180, '180'],
                    ['THU',  175, '175'],
                    ['FRI',  200, '200'],
                    ['SAT',  170, '170'],
                    ['SUN',  250, '250'],
                    ['MON',  220, '220'],
                    ['TUE',  220, ' ']
                ]);

                var options = {
                    height: 314,
                    legend: 'none',
                    areaOpacity: 0.18,
                    axisTitlesPosition: 'out',
                    hAxis: {
                        title: '',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        textPosition: 'out'
                    },
                    vAxis: {
                        minValue: 0,
                        textPosition: 'out',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        baselineColor: '#16b4fc',
                        ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
                        gridlines: {
                            color: '#1ba0fc',
                            count: 15
                        },
                    },
                    lineWidth: 2,
                    colors: ['#fff'],
                    curveType: 'function',
                    pointSize: 5,
                    pointShapeType: 'circle',
                    pointFillColor: '#f00',
                    backgroundColor: {
                        fill: '#008ffb',
                        strokeWidth: 0,
                    },
                    chartArea:{
                        left:0,
                        top:0,
                        width:'100%',
                        height:'100%'
                    },
                    fontSize: 11,
                    fontName: 'Proxima Nova',
                    tooltip: {
                        trigger: 'selection',
                        isHtml: true
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(dataTable, options);
            }
            $(window).resize(function(){
                drawChart();
                setTimeout(function(){
                }, 1000);
            });
        });
    </script>

<script src="js/app.js"></script>
@endsection