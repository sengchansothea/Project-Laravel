@extends('layout.app')

@section('style')
   <style>
    /* Table Design */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
            width: 100%;
        }

        .table th {
            background-color: #f1f5f9;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 8px 10px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .table tbody tr:hover {
            background-color: #e6f7ff;
            transition: background-color 0.2s ease-in-out;
        }

        /* Status Tag */
        .status-active,
        .status-inactive {
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
            min-width: 90px;
            text-align: center;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Buttons */
        .btn-sm {
            padding: 4px 10px;
            border-radius: 8px;
        }

        .btn-sm i {
            margin-right: 4px;
        }

        /* Card Style */
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Pagination */
        .pagination {
            margin: 0;
        }

        .pagination li a,
        .pagination li span {
            border-radius: 6px !important;
            padding: 6px 12px;
            margin: 0 2px;
        }

        .req-leave, .req-mession {
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-block;
            min-width: 110px;
            text-align: center;
        }

        /* Leave Request */
        .req-leave {
            background-color: #fff3cd; /* ផ្ទៃលឿងខ្ចី */
            color: #b08a1b; /* អក្សរលឿង */
            border: 1px solid #ffeeba;
        }

        /* Overtime Request */
        .req-mession {
            background-color: #e3f2fd; /* ផ្ទៃខៀវខ្ចី */
            color: #0d47a1; /* អក្សរខៀវ */
            border: 1px solid #90caf9;
        }

        /* Khmer Font */
        .language_kh * {
            font-family: 'Siemreap', 'Inter', system-ui, sans-serif !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>​បញ្ជីឈ្មោះដេប៉ាតឺម៉ង់នៃការស្នើសុំ <small style="color: rgb(0, 60, 255)">({{$getRecord->count()}} សំណើរ)</small></h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('deptAdmin/assign_department_request/add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> បន្ថែមឈ្មោះដេប៉ាតឺម៉ង់នៃការស្មើសុំ</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-lightblue">
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>ឈ្មោះដេប៉ាតីម៉ង់</label>
                                            <input type="text" value="{{ Request::get('name') }}" name="name"
                                                class="form-control" placeholder="ឈ្មោះដេប៉ាតឺម៉ង់">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ប្រភេទនៃសំណើរ</label>
                                                <select name="type_request" class="form-control">
                                                    <option value="">សូមជ្រើសរើសប្រភេទសំណើរ</option>
                                                    <option {{ Request::get('type_request') == 'Leave' ? 'selected' : '' }} value="Leave">ការឈប់សម្រាក</option>
                                                    <option {{ Request::get('type_request') == 'Mession' ? 'selected' : '' }} value="Mession">សូមធ្វើការថែមម៉ោង</option>
                                                </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ថ្ងៃ ខែ​ ឆ្នាំបង្កើ់ត</label>
                                            <input type="date" value="{{ Request::get('date') }}" name="date"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-3 text-left">
                                            <button type="submit" style="margin-top: 32px;" class="btn btn-primary">
                                                <i class="fas fa-search"></i> ស្វែងរក
                                            </button>
                                            <a href="{{ url('deptAdmin/department') }}" class="btn btn-success" style="margin-top: 32px;">
                                                <i class="fas fa-sync-alt"></i> កំណត់ឡើងវិញ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                @include('message')

                <div class="card">
                    <div class="card-header">
                        <div class="card-tools text-right mb-2">
                            <a href="{{ url('admin/user_management/export-csv') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-csv"></i> CSV
                            </a>
                            <a href="{{ url('admin/user_management/export-excel') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                            <a href="{{ url('admin/user_management/export-pdf') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះដេប៉ាតឺម៉ង់</th>
                                    <th>ប្រភេទនៃសំណើរ</th>
                                    <th>ស្ថានភាព</th>
                                    <th>បង្កើតដោយ</th>
                                    <th>កាលបរិច្ឆេទបង្កើត</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->dapartment_name }}</td>
                                        <td>
                                            @if ($department->type_requests_id == '1')
                                                <span class="req-leave">សុំច្បាប់ឈប់សម្រាក</span>
                                            @elseif($department->type_requests_id == '2')
                                                <span class="req-mession">សូមធ្វើការថែមម៉ោង</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <small class="{{ $department->status == 0 ? 'status-active' : 'status-inactive' }}">
                                                {{ $department->status == 0 ? 'បានអនុម័ត' : 'កំពុងរង់ចាំ' }}
                                            </small>
                                        </td>
                                        <td>{{ $department->created_by_name}} {{ $department->created_by_last_name}}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($department->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('deptAdmin/assign_department_request/edit_single/' . $department->id) }}"
                                                class="btn btn-primary btn-sm">EditSingle</a>
                                            <a href="{{ url('deptAdmin/assign_department_request/edit_all/' . $department->id) }}"
                                                class="btn btn-success btn-sm">Edit All</a>
                                            <a href="{{ url('deptAdmin/assign_department_request/delete/' . $department->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="padding: 10px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
        </section>
    </div>
@endsection
