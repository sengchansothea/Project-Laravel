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
                        <h1>បញ្ជីការស្នើសុំ <small style="color: rgb(0, 60, 255)"></small></h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/request/requestadd') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> បន្ថែមប្រភេទសំណើរ</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

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
                                    <th>ប្រភេទសំណើរ</th>
                                    <th>ស្ថានភាព</th>
                                    <th>បង្កើតដោយ</th>
                                    <th>កាលបរិច្ឆេទបង្កើត</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $request )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($request->name) }}</td>
                                        <td>
                                            <small class="{{ $request->status == 0 ? 'status-active' : 'status-inactive' }}">
                                                {{ $request->status == 0 ? 'បានអនុម័ត' : 'កំពុងរង់ចាំ' }}
                                            </small>
                                        </td>
                                        <td>{{ $request->created_by_name }} {{$request->created_by_last_name}}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($request->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/request/requestedit/' . $request->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/request/requestdelete/' . $request->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
        </section>
    </div>
@endsection
