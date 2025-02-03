@extends('backend.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <!--**********************************
                Content body start
            ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-header">
                            <h3 class="card-title">Total Students</h3>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $totalStudents }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            <h3 class="card-title">New Students</h3>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $newStudents }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-header">
                            <h3 class="card-title">Total Courses</h3>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $totalCourses }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-header">
                            <h3 class="card-title">Fees Collection</h3>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $feesCollection }}$</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income/Expense Report</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart_2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income/Expense Report</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="areaChart_1"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-sm-12 mb-4">
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
                                    @foreach($tasks as $task)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->assigned_professor }}</td>
                                            <td><span class="badge badge-{{ $task->status_class }}">{{ $task->status }}</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: {{ $task->progress }}%;" role="progressbar">
                                                        <span class="sr-only">{{ $task->progress }}% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Notifications</h4>
                        </div>
                        <div class="card-body">
                            <div class="widget-todo dz-scroll" style="height:370px;" id="DZ_W_Notifications">
                                <ul class="timeline">
                                    @foreach($notifications as $notification)
                                        <li>
                                            <div class="timeline-badge {{ $notification->badge_class }}"></div>
                                            <a class="timeline-panel text-muted mb-3 d-flex align-items-center" href="javascript:void(0);">
                                                <img class="rounded-circle" alt="image" width="50" src="{{ asset($notification->image) }}">
                                                <div class="col">
                                                    <h5 class="mb-1">{{ $notification->message }}</h5>
                                                    <small class="d-block">{{ $notification->created_at->format('d M Y - h:i A') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">New Student List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-striped">
                                    <thead>
                                    <tr>
                                        <th class="px-5 py-3">Name</th>
                                        <th class="py-3">Assigned Professor</th>
                                        <th class="py-3">Branch</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Date Of Admit</th>
                                        <th class="py-3">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr class="btn-reveal-trigger">
                                            <td class="p-3">
                                                <a href="javascript:void(0);">
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid" src="{{ asset($student->avatar) }}" width="30" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="mb-0 fs--1">{{ $student->name }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="py-2">{{ $student->assigned_professor }}</td>
                                            <td class="py-2">{{ $student->branch }}</td>
                                            <td><span class="badge badge-rounded {{ $student->status_class }}">{{ $student->status }}</span></td>
                                            <td class="py-2">{{ $student->date_of_admit->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                Content body end
    ***********************************-->

@endsection

@push('scripts')
    <!-- Chart ChartJS plugin files -->
    <script src="{{ asset('public/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('public/vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Chart sparkline plugin files -->
    <script src="{{ asset('public/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Demo scripts -->
    <script src="{{ asset('public/js/dashboard/dashboard-3.js') }}"></script>
@endpush
