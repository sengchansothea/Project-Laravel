@extends('layout.app')

@section('style')
    <style>
        /* Type Request Tag Style */
        .req-leave, .req-overtime, .req-other {
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
        .req-overtime {
            background-color: #e3f2fd; /* ផ្ទៃខៀវខ្ចី */
            color: #0d47a1; /* អក្សរខៀវ */
            border: 1px solid #90caf9;
        }

        /* Other Request */
        .req-other {
            background-color: #f3e5f5; /* ផ្ទៃស្វាយខ្ចី */
            color: #4a148c; /* អក្សរស្វាយ */
            border: 1px solid #ce93d8;
        }

        .img-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            /* កាត់ជារង្វង់ */
            object-fit: cover;
            /* កាត់អោយស្មើ */
            display: block;
            /* កែ inline element → block */
            margin-left: auto;
            /* ចំកណ្ដាលផ្ដេក */
            margin-right: auto;
        }

        td.center-image {
            text-align: center;
            /* កណ្ដាលផ្ដេក */
            vertical-align: middle;
            /* កណ្ដាលឈរ */
        }
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

        /* Department Tag Style */
        .dept-it,.dept-sales {
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-block;
            min-width: 110px;
            text-align: center;
        }

        /* ពណ៌សម្រាប់ IT */
        .dept-it {
            background-color: #e0f7fa; /* ផ្ទៃទឹកសមុទ្រ​ខ្ចីៗ */
            color: #00695c; /* អក្សរទឹកសមុទ្រ */
            border: 1px solid #00acc1;
        }

        /* ពណ៌សម្រាប់ Sales */
        .dept-sales {
            background-color: #e8f5e9; /* ផ្ទៃបៃតងខ្ចី */
            color: #2e7d32; /* អក្សរបៃតង */
            border: 1px solid #81c784;
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
                        <h1>TeamLeader Request List<small style="color: rgb(0, 60, 255)"></small></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- <!-- Filter Form -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">Search Request List</h3>
                            </div>
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>គោត្តនាមនិងនាម</label>
                                            <input type="text" value="{{ Request::get('name') }}" name="name"
                                                class="form-control" placeholder="ឈ្មោះ ឬ នាមត្រកូល">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>អ៊ីមែល</label>
                                            <input type="text" value="{{ Request::get('email') }}" name="email"
                                                class="form-control" placeholder="អ៊ីមែល">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>ដេប៉ាតឺម៉ង់<span style="color: red">*</span></label>
                                            <select name="department_id" class="form-control">
                                                <option value="">ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                                                <option {{ (Request::get('department_id') == '1') ? 'selected' : '' }} value="1">ដេប៉ាតឺម៉ង់ IT</option>
                                                <option {{ (Request::get('department_id') == '2') ? 'selected' : '' }} value="2">ដេប៉ាតឺម៉ង់ Sales</option>
                                                <option {{ (Request::get('department_id') == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>តួនាទី</label>
                                            <select name="user_type" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ Request::get('user_type') == '4' ? 'selected' : '' }} value="4">HR Manager</option>
                                                <option {{ Request::get('user_type') == '5' ? 'selected' : '' }} value="5">CFO</option>
                                                <option {{ Request::get('user_type') == '6' ? 'selected' : '' }} value="6">TeamLeader</option>
                                                <option {{ Request::get('user_type') == '7' ? 'selected' : '' }} value="7">Employee</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 text-left">
                                            <button type="submit" style="margin-top: 32px;" class="btn btn-primary">
                                                <i class="fas fa-search"></i> ស្វែងរក
                                            </button>
                                            <a href="{{url('CEO/myApprove')}}" class="btn btn-success" style="margin-top: 32px;">
                                                <i class="fas fa-sync-alt"></i> កំណត់ឡើងវិញ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

                @include('message')

                <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">List Request</h3>
                            <div class="card-tools text-right mb-2">
                                <a href="{{ url('admin/CEO/export-csv') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                                <a href="{{ url('admin/CEO/export-excel') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ url('admin/CEO/export-pdf') }}" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="overflow-x: auto; width: 100%;">
                                <table class="table table-bordered" style="white-space: nowrap;">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>លេខសម្គាល់</th>
                                            <th>រួបភាព</th>
                                            <th>ឈ្មោះ</th>
                                            <th>ភេទ</th>
                                            <th>តួនាទី</th>
                                            <th>អ៊ីមែល</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                            <th>ដេប៉ាតឺម៉ង់</th>
                                            <th>ប្រភេទសំណើ</th>
                                            <th>កាលបរិច្ឆេទបង្កើត</th>
                                            <th>ស្ថានភាព</th>
                                            <th>សកម្មភាព</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getSearchApporveTL as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->user_id}}</td>
                                                <td class="center-image">
                                                    @if (!empty($employee->getProfile()))
                                                        <a href="{{ url('admin/profile', ['id' => $employee->id]) }}">
                                                            <img src="{{ $employee->getProfile() }}" class="img-circle">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->gender == 'Male' ? 'ប្រុស' : ($employee->gender == 'Female' ? 'ស្រី' : 'មិនបានបញ្ជាក់') }}</td>
                                                <td>
                                                    @if ($employee->user_type == '7')
                                                        <span>Employee</span>
                                                    @elseif($employee->user_type =='6')
                                                        <span>TeamLeader</span>
                                                    @elseif($employee->user_type =='5')
                                                        <span>CFO</span>
                                                    @elseif($employee->user_type =='4')
                                                        <span>HR Manager</span>
                                                    @endif
                                                </td>
                                                <td>{{ $employee->user_email }}</td>
                                                <td>{{ $employee->phone_number }}</td>
                                                <td>
                                                    @if($employee->department_name == 'Department IT') 
                                                        <span class="dept-it">ដេប៉ាតឺម៉ង់ IT</span>
                                                    @elseif($employee->department_name == 'Department Sales')
                                                        <span class="dept-sales">ដេប៉ាតឺម៉ង់ Sales</span>
                                                    @else
                                                        {{ $employee->department_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($employee->type_request == 'Leave')
                                                        <span class="req-leave">សុំច្បាប់</span>
                                                    @elseif ($employee->type_request == 'Mession')
                                                        <span class="req-overtime">ស្នើសុំបេសកម្ម</span>
                                                    @else
                                                        <span class="req-other">{{ $employee->type_request }}</span>
                                                    @endif
                                                </td>                                
                                                <td>{{ $employee->created_at->format('d-m-Y H:i A') }}</td>
                                                <td>
                                                    @if ($employee->status == 0 )
                                                        <small class="status-active">បានអនុម័ត</small>
                                                    @elseif ($employee->status == 1)
                                                        <small class="status-inactive">កំពុងរង់ចាំ</small>
                                                    @elseif ($employee->status == 2)
                                                        <small class="status-inactive">បានបដិសេដ</small>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ url('teamleader/myRequest/approveRequest/' . $employee->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Approve 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-3">
                                
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
