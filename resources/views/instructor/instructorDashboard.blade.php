@extends('backend.layouts.app')
@section('title', 'Instructor Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endpush

@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-header">
                            <h3 class="card-title">Total Students</h3>
                            <h5 class="mb-0"><i class="fa fa-caret-up"></i> 422</h5>
                        </div>
                        <div class="card-body text-center">
                            <div id="sparkline12"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            <h3 class="card-title">New Students</h3>
                            <h5 class="mb-0"><i class="fa fa-caret-up"></i> 357</h5>
                        </div>
                        <div class="card-body text-center">
                            <div id="spark-bar-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-header">
                            <h3 class="card-title">Total Courses</h3>
                            <h5 class="mb-0"><i class="fa fa-caret-up"></i> 547</h5>
                        </div>
                        <div class="card-body">
                            <span class="bar1" data-peity='{ "fill": ["rgb(0, 0, 128)", "rgb(7, 135, 234)"]}'>6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-header">
                            <h3 class="card-title">Fees Collection</h3>
                            <h5 class="mb-0"><i class="fa fa-caret-up"></i> 3280$</h5>
                        </div>
                        <div class="card-body">
                            <span class="peity-line-2" data-width="100%">7,6,8,7,3,8,3,3,6,5,9,2,8</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income/Expense Report</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart_2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income/Expense Report</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="areaChart_1"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Assign Task</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Assigned Professors</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Working Design report</td>
                                        <td>Herman Beck</td>
                                        <td><span class="badge badge-primary">DONE</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Fees Collection report</td>
                                        <td>Emma Watson</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Management report</td>
                                        <td>Mary Adams</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>Library book status</td>
                                        <td>Caleb Richards</td>
                                        <td><span class="badge badge-danger">Suspended</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>Placement status</td>
                                        <td>June Lane</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Notifications</h4>
                        </div>
                        <div class="card-body">
                            <div class="widget-todo" style="height:370px; overflow-y: auto;" id="DZ_W_Notifications">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge primary"></div>
                                        <a class="timeline-panel text-muted d-flex align-items-center" href="javascript:void(0);">
                                            <img class="rounded-circle" alt="image" width="50" src="{{ asset('images/profile/education/pic1.jpg') }}">
                                            <div class="col">
                                                <h5 class="mb-1">Dr. Sultads sent you a photo</h5>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- Add more notifications as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">New Student List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Assigned Professor</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Date Of Admit</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="media d-flex align-items-center">
                                                <div class="avatar avatar-xl mr-2">
                                                    <img class="rounded-circle img-fluid" src="{{ asset('images/avatar/5.png') }}" width="30" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-0">Ricky Antony</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Herman Beck</td>
                                        <td>Mechanical</td>
                                        <td><span class="badge badge-primary">DONE</span></td>
                                        <td>30/03/2018</td>
                                        <td>
                                            <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Add more students as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard-3.js') }}"></script>
@endpush
