@extends('layouts.app')
@section('content')  

    <div class="col-md-12 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!--/.row-->
       
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Dashboard</h2>
            </div>
        </div><!--/.row-->
         @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-orange panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-2 col-lg-3 widget-left">
                        <i class="fas fa-notes-medical fa-3x"></i>
                        </div>
                        <div class="col-sm-10 col-lg-9 widget-right">
                            <div class="large">{{$pending['appointment']}}</div>
                            <div class="text-muted">Pending Appointment</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-blue panel-widget ">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">{{$patients->count()}}</div>
                            <div class="text-muted">Total Patient</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-teal panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fas fa-vial fa-3x"></i>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">{{$total_test}}</div>
                            <div class="text-muted">Total Test</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-red panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fas fa-user-md fa-3x"></i>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">{{$total_doctor}}</div>
                            <div class="text-muted">Total Doctor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Pending Appointments</div>
                    <div class="panel-body">
                        <canvas id="pendingAppointmentsChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <!-- All Appointments -->
             <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">All Appointments</div>
                    <div class="panel-body">
                         <table id="table1" class="display table table-bordered table-condensed table-hover" cellspacing="0" width="100%">
                            <thead>
                               <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @isset($all_appointments)
                                    @foreach($all_appointments as $appointment)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$appointment->name}}</td>
                                        <td>{{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</td>
                                        <td>{{$appointment->doctor->employee->first_name}} {{$appointment->doctor->employee->middle_name}} {{$appointment->doctor->employee->last_name}}</td>
                                        <td>{{$appointment->description}}</td>
                                        <td>{{$appointment->time}}</td>
                                        <td>
                                        @if($appointment->status)
                                        <a class="btn-sm btn-success" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-ok"></span> Complete</a>    
                                        @else
                                        <a class="btn-sm btn-warning" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-refresh"> </span> Pending</a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>                 
                        </table>
                    </div>
                </div>
            </div>
            <!-- Appointmet table ends -->
        </div><!--/.row-->
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->

        <script>
            var ctx = document.getElementById('pendingAppointmentsChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pending', 'Completed'],
                    datasets: [{
                        label: 'Appointment Status',
                        data: [{{$pending['appointment']}}, {{isset($all_appointments) ? $all_appointments->count() - $pending['appointment'] : 0}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

        @if(isset($hourly_sales))
        <div class="row">
            <!-- Today invoice collection starts -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Today's Invoice Collection</div>
                    <div class="panel-body">
                        <canvas id="collectionChart" width="400" height="100"></canvas>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->

        <script>
            var ctx = document.getElementById('collectionChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($hourly_sales->pluck('hour')) !!},
                    datasets: [{
                        label: 'Collection',
                        data: {!! json_encode($hourly_sales->pluck('sales')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
        @endif

        <script type="text/javascript">
            $(document).ready(function(){
                $('#table').DataTable();
                $('#table1').DataTable();

            });
        </script>
@endsection
