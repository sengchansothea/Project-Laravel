@extends('layout.app')

@section('style')
    <style>
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
                        <h1>​បញ្ជីឈ្មោះ Department Admin <small style="color: rgb(0, 60, 255)">({{ $getRecord->count() }}
                                នាក់)</small></h1>
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
                                            <label>គោត្តនាមនិងនាម</label>
                                            <input type="text" value="{{ Request::get('name') }}" name="name"
                                                class="form-control" placeholder="ឈ្មោះ ឬ នាមត្រកូល">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ភេទ<span style="color: red">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">ជ្រើសរើសភេទ</option>
                                                <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">ប្រុស</option>
                                                <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">ស្រី</option>
                                                <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>អ៊ីមែល</label>
                                            <input type="text" value="{{ Request::get('email') }}" name="email"
                                                class="form-control" placeholder="អ៊ីមែល">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ស្ថានភាព</label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ Request::get('status') == '0' ? 'selected' : '' }} value="0">បានអនុម័ត</option>
                                                <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">កំពុងរង់ចាំ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>មកពីខេត្ត</label>
                                            <select name="province" class="form-control">
                                                <option value="">ជ្រើសរើសខេត្ត</option>
                                                <option {{ (Request::get('province') == 'Kratie') ? 'selected' : '' }} value="Kratie">ក្រចេះ</option>
                                                <option {{ (Request::get('province') == 'Kandal') ?'selected' : '' }} value="Kandal">កណ្ដាល</option>
                                                <option {{ (Request::get('province') == 'Kep') ? 'selected' : '' }} value="Kep">កែប</option>
                                                <option {{ (Request::get('province') == 'Kampot') ? 'selected' : '' }} value="Kampot">កំពត</option>
                                                <option {{ (Request::get('province') == 'Kompong Cham') ? 'selected' : '' }} value="Kompong Cham">កំពង់ចាម</option>
                                                <option {{ (Request::get('province') == 'Kompong Chhnang') ? 'selected' : '' }} value="Kompong Chhnang">កំពង់ឆ្នាំង</option>
                                                <option {{ (Request::get('province') == 'Kompong Thom') ? 'selected' : '' }} value="Kompong Thom">កំពង់ធំ</option>
                                                <option {{ (Request::get('province')== 'Kompong Speu') ? 'selected' : '' }} value="Kompong Speu">កំពង់ស្ពឺ</option>
                                                <option {{ (Request::get('province') == 'Koh Kong') ? 'selected' : '' }} value="Koh Kong">កោះកុង</option>
                                                <option {{ (Request::get('province') == 'Takaev') ? 'selected' : '' }} value="Takaev">តាកែវ</option>
                                                <option {{ (Request::get('province') == 'Thbong Khmum') ? 'selected' : '' }} value="Thbong Khmum">ត្បូងឃ្មុំ</option>
                                                <option {{ (Request::get('province') == 'Pailin') ? 'selected' : '' }} value="Pailin">ប៉ៃលិន</option>
                                                <option {{ (Request::get('province') == 'Battambang') ? 'selected' : '' }} value="Battambang">បាត់ដំបង</option>
                                                <option {{ (Request::get('province') == 'Banteay Meanchey') ? 'selected' : '' }} value="Banteay Meanchey">បន្ទាយមានជ័យ</option>
                                                <option {{ (Request::get('province') == 'Prey Veng') ? 'selected' : '' }} value="Prey Veng">ព្រៃវែង</option>
                                                <option {{ (Request::get('province') == 'Pursat') ? 'selected' : '' }} value="Pursat">ពោធិ៍សាត់</option>
                                                <option {{ (Request::get('province') == 'Preah Sihanouk') ? 'selected' : '' }} value="Preah Sihanouk">ព្រះសិហនុ</option>
                                                <option {{ (Request::get('province') == 'Preah Vihear') ? 'selected' : '' }} value="Preah Vihear">ព្រះវិហារ</option>
                                                <option {{ (Request::get('province') == 'Phnom Penh') ? 'selected' : '' }} value="Phnom Penh">ភ្នំពេញ</option>
                                                <option {{ (Request::get('province') == 'Mondulkiri') ? 'selected' : '' }} value="Mondulkiri">មណ្ឌលគិរី</option>
                                                <option {{ (Request::get('province') == 'Ratanakiri') ? 'selected' : '' }} value="Ratanakiri">រតនៈគីរី</option>
                                                <option {{ (Request::get('province') == 'Svay Rieng') ? 'selected' : '' }} value="Svay Rieng">ស្វាយរៀង</option>
                                                <option {{ (Request::get('province') == 'Siem Reap') ? 'selected' : '' }} value="Siem Reap">សៀមរាប</option>
                                                <option {{ (Request::get('province') == 'Uddor Meanchey') ? 'selected' : '' }} value="Uddor Meanchey">ឧត្តរមានជ័យ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>ថ្ងៃ ខែ ឆ្នាំ</label>
                                            <input type="date" value="{{ Request::get('date') }}" name="date"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-3 text-left">
                                            <button type="submit" style="margin-top: 32px;" class="btn btn-primary">
                                                <i class="fas fa-search"></i> ស្វែងរក
                                            </button>
                                            <a href="{{ url('deptAdmin/employee/list') }}" class="btn btn-success" style="margin-top: 32px;">
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
                            <a href="{{ url('admin/user_management/export-excel') }}"
                                class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                            <a href="{{ url('admin/user_management/export-pdf') }}"
                                class="btn btn-outline-danger btn-sm">
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
                                        <th>រូបភាព</th>
                                        <th>ឈ្មោះ</th>
                                        <th>ភេទ</th>
                                        <th>អ៊ីមែល</th>
                                        <th>លេខទូរស័ព្ទ</th>
                                        <th>ស្ថានភាព</th>
                                        <th>ថ្ងៃ​កំណើត</th>
                                        <th>ថ្ងៃចូលធ្វើការ</th>
                                        <th>ស្ថានភាពគ្រួសារ</th>
                                        <th>មកពីខេត្ត</th>
                                        <th>កាលបរិច្ឆេទបង្កើត</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $dept)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="center-image">
                                                @if (!empty($dept->getProfile()))
                                                    <a href="{{ url('admin/profile', ['id' => $dept->id]) }}">
                                                        <img src="{{ $dept->getProfile() }}" class="img-circle">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $dept->name }} {{ $dept->last_name }}</td>
                                            <td>{{ $dept->gender == 'Male' ? 'ប្រុស' : ($dept->gender == 'Female' ? 'ស្រី' : 'មិនបានបញ្ជាក់') }}
                                            </td>
                                            <td>{{ $dept->email }}</td>
                                            <td>{{ $dept->phone_number }}</td>
                                            <td>
                                                <small
                                                    class="{{ $dept->status == 0 ? 'status-active' : 'status-inactive' }}">
                                                    {{ $dept->status == 0 ? 'បានអនុម័ត' : 'កំពុងរង់ចាំ' }}
                                                </small>
                                            </td>
                                            <td>
                                                @if (!empty($dept->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($dept->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($dept->date_of_joining))
                                                    {{ date('d-m-Y', strtotime($dept->date_of_joining)) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dept->marital_status == 'Single')
                                                    អនីតិជន
                                                @elseif($dept->marital_status == 'Married')
                                                    បានរៀបការហើយ
                                                @elseif($dept->marital_status == 'Other')
                                                    មិនបានបញ្ជាក់
                                                @endif
                                            </td>
                                            <td>{{ $dept->province_kh }}</td>
                                            <td>{{ $dept->created_at->format('d-m-Y H:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

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
