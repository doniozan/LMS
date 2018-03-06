@extends('layouts.app')

@section('stylesheet')
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Staff</title>

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
    <<style type="text/css">
        .select-style {
    border: 1px solid #ccc;
    width: 120px;
    border-radius: 3px;
    overflow: hidden;
    background: #fafafa url("img/icon-select.png") no-repeat 90% 50%;
}

.select-style select {
    padding: 5px 8px;
    width: 130%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
    outline: none;
}
    </style>
@endsection

@section('content')
	<div class="page-content">
        <div class="container-fluid">
            <section class="card card-blue-fill">            
                <header class="card-header">
                    Data Staff
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Department</th>
                                <th>Active</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Staff as $data)
								<tr>
									<td>
                                        <a onclick="ubah({{ $data->id_staff }});">
                                            <img width="50" height="50" src="img/staff/{{ $data->foto }}" alt="">  {{ $data->nama }}
                                        </a>
                                    </td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->roles }}</td>
                                    <td>{{ $data->nama_department }} - {{ $data->kota }}</td>
                                    <td><input type="checkbox" {{ $data->status }}> 
                                        </td>
									<td>
                                        <span class="red with-sub">
                                                <a onclick="ubah({{ $data->id_staff }});">
                                                    <i class="font-icon font-icon-pencil"></i>
                                                </a>
                                                <a onclick="hapus({{ $data->id_staff }});">
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
                    <h4 class="modal-title" id="myModalLabel">Input Data Staff</h4>
                </div>
                <div class="modal-body">
                    <form action="/setupstaff/add" method="post" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Staff Name</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Staff Name" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>No Telp</label>
                                    <input type="text" class="form-control" name="no_telp" placeholder="No Telp" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Password</label>
                                    <input type="password" class="form-control" value="password" name="password" placeholder="Password" required/>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Roles</label>
                                    <select class="select2 select-style" name="roles" required>
                                        @foreach($Roles as $data)
                                            <option value="{{ $data->id_roles }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Department</label>
                                    <select class="select2 select-style" name="id_department" required>
                                        @foreach($Department as $data)
                                            <option value="{{ $data->id_department }}">{{ $data->nama }} - {{ $data->kota }}</option>
                                        @endforeach
                                    </select>
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Staff</h4>
                </div>
                <div class="modal-body">
                    <form action="/setupstaff/edit" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_staff" id="id_staff_edit">
                        <input type="hidden" name="foto_lama" id="foto_lama">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Foto</label>
                                    <img src="" alt="" width="150" height="150" id="foto_edit">
                                    <input type="file" class="form-control" name="foto">
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Staff Name</label>
                                    <input type="text" class="form-control" name="nama" id="nama_edit" placeholder="Staff Name" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Email</label>
                                    <input type="email" class="form-control" name="email" id="email_edit" placeholder="Email" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>No Telp</label>
                                    <input type="text" class="form-control" name="no_telp" id="no_telp_edit" placeholder="No Telp" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat" id="alamat_edit" placeholder="Alamat" required></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Roles</label>
                                    <select class="select2 select-style" name="roles" id="roles_edit" required>
                                        <option>--Roles--</option>
                                        @foreach($Roles as $data)
                                            <option value="{{ $data->id_roles }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold"><span style="color:red;">*</span>Department</label>
                                    <select class="select2 select-style" name="id_department" id="id_department_edit" required>
                                        <option>--Department--</option>
                                        @foreach($Department as $data)
                                            <option value="{{ $data->id_department }}">{{ $data->nama }} - {{ $data->kota }}</option>
                                        @endforeach
                                    </select>
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

        function hapus(id_staff,foto){
            if(confirm('Yakin Akan Menghapus Data ?'))
            {
                $.ajax({
                    url: '/setupstaff/delete/'+id_staff,
                    type: "get",
                    success: function(response)
                    {
                        location.href= "/setupstaff";
                        alert('Delete Success');
                    }
                });
            }
        }

        function ubah(id_staff){
            $.ajax({
                url: '/setupstaff/search/'+id_staff,
                type: "get",
                success: function(response)
                {
                    respon = JSON.parse(response);
                    $('#nama_edit').val(respon[0].nama);
                    $('#email_edit').val(respon[0].email);
                    $('#alamat_edit').val(respon[0].alamat);
                    $('#no_telp_edit').val(respon[0].no_telp);
                    $('#roles_edit').val(respon[0].roles);
                    $('#foto_edit').attr('src', 'img/staff/'+respon[0].foto);
                    $('#id_department_edit').val(respon[0].id_department);
                    $('#id_staff_edit').val(respon[0].id_staff);
                    $('#foto_lama').val(respon[0].foto);
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