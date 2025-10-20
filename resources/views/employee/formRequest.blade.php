@extends('layout.app')

@section('style')
    <style>
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
                        <h1>​បញ្ជីនៃការស្នើសុំ <small style="color: rgb(0, 60, 255)"></small></h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ url('employee/formRequest/addRequest') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> ការស្មើសុំសំណើរ
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                

                @include('message')

                <!-- Table Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools text-right mb-2">
                            <a href="{{ url('admin/employee/export-csv') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-csv"></i> CSV
                            </a>
                            <a href="{{ url('admin/employee/export-excel') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                            <a href="{{ url('admin/e,ployee/export-pdf') }}" class="btn btn-outline-danger btn-sm">
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
                                        <th>រួបភាព</th>
                                        <th>ឈ្មោះ</th>
                                        <th>ភេទ</th>
                                        <th>លេខទូរស័ព្ទ</th>
                                        <th>ដេប៉ាតឺម៉ង់</th>
                                        <th>ស្ថានភាព</th>
                                        <th>ប្រភេទនៃសំណើរ</th>
                                        <th>មូលហេតុ</th>
                                        <th>រយៈពេល</th>
                                        <th>កាលបរិច្ឆេទបង្កើត</th>
                                        <th>សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecords as $employee)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td class="center-image">
                                                @if (!empty($employee->getProfile()))
                                                    <a href="{{ url('admin/profile', ['id' => $employee->id]) }}">
                                                        <img src="{{ $employee->getProfile() }}" class="img-circle">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->gender == 'Male' ? 'ប្រុស' : ($employee->gender == 'Female' ? 'ស្រី' : 'មិនបានបញ្ជាក់') }}</td>
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
                                                 @if ($employee->status == 0 )
                                                    <small class="status-active">បានអនុម័ត</small>
                                                @elseif ($employee->status == 1)
                                                    <small class="status-inactive">កំពុងរង់ចាំ</small>
                                                @elseif ($employee->status == 2)
                                                    <small class="status-inactive">បានបដិសេដ</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($employee->type_request == 'Leave')
                                                    <span class="req-leave">សុំច្បាប់</span>
                                                @elseif ($employee->type_request == 'Overtime')
                                                    <span class="req-overtime">សុំម៉ោងបន្ថែម</span>
                                                @else
                                                    <span class="req-other">{{ $employee->type_request }}</span>
                                                @endif
                                            </td> 
                                            <td>{{ $employee->reason }}</td>  
                                            <td>{{ $employee->time }}</td>  
                                            
                                            <td>{{ $employee->created_at->format('d-m-Y H:i A') }}</td>
                                            <td>
                                                <a href="{{ url('employee/formRequest/editRequest/' . $employee->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ url('employee/formRequest/deleteRequest/' . $employee->id) }}" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
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
        </section>
    </div>
@endsection
