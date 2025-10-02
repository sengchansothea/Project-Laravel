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
                        <h1>​បញ្ជីឈ្មោះអ្នកគ្រប់គ្រង</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/user_management/add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> បន្ថែមអ្នកគ្រប់គ្រងថ្មី
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Filter Form -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card card-lightblue">
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>នាមត្រកូល</label>
                                            <input type="text" value="{{ Request::get('name') }}" name="name"
                                                class="form-control" placeholder="នាមត្រកូល">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>នាមខ្លួន</label>
                                            <input type="text" value="{{ Request::get('last_name') }}" name="last_name"
                                                class="form-control" placeholder="នាមខ្លួន">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>អ៊ីមែល</label>
                                            <input type="text" value="{{ Request::get('email') }}" name="email"
                                                class="form-control" placeholder="អ៊ីមែល">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>តួនាទី</label>
                                            <select name="user_type" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ Request::get('user_type') == '1' ? 'selected' : '' }} value="1">System Admin</option>
                                                <option {{ Request::get('user_type') == '2' ? 'selected' : '' }} value="2">Department Admin</option>
                                                <option {{ Request::get('user_type') == '3' ? 'selected' : '' }} value="3">CEO</option>
                                                <option {{ Request::get('user_type') == '4' ? 'selected' : '' }} value="4">HR Manager</option>
                                                <option {{ Request::get('user_type') == '5' ? 'selected' : '' }} value="5">CFO</option>
                                                <option {{ Request::get('user_type') == '6' ? 'selected' : '' }} value="6">TeamLeader</option>
                                                <option {{ Request::get('user_type') == '7' ? 'selected' : '' }} value="7">Employee</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ដេប៉ាតឺម៉ង់</label>
                                            <select name="department_id" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ Request::get('department_id') == '1' ? 'selected' : '' }} value="1">IT</option>
                                                <option {{ Request::get('department_id') == '2' ? 'selected' : '' }} value="2">Sales</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ស្ថានភាព</label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ Request::get('status') == '0' ? 'selected' : '' }} value="0">សកម្ម</option>
                                                <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">អសកម្ម</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ថ្ងៃ ខែ ឆ្នាំ</label>
                                            <input type="date" value="{{ Request::get('date') }}" name="date"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-3 text-right">
                                            <button type="submit" style="margin-top: 32px;" class="btn btn-primary">
                                                <i class="fas fa-search"></i> ស្វែងរក
                                            </button>
                                            <a href="{{ url('admin/user_management/list') }}" class="btn btn-success" style="margin-top: 32px;">
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

                <!-- Table Card -->
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

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះ</th>
                                    <th>អ៊ីមែល</th>
                                    <th>តួនាទី</th>
                                    <th>ដេប៉ាតឺម៉ង់</th>
                                    <th>ស្ថានភាព</th>
                                    <th>កាលបរិច្ឆេទបង្កើត</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }} {{ $admin->last_name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->role_name }}</td>
                                        <td>{{ $admin->department_name ?? '-' }}</td>
                                        <td>
                                            <small class="{{ $admin->status == 0 ? 'status-active' : 'status-inactive' }}">
                                                {{ $admin->status == 0 ? 'បានអនុម័ត' : 'កំពុងរង់ចាំ' }}
                                            </small>
                                        </td>
                                        <td>{{ $admin->created_at->format('d-m-Y H:i A') }}</td>
                                        <td>
                                            <a href="{{ url('admin/user_management/edit/' . $admin->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ url('admin/user_management/delete/' . $admin->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-3">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
