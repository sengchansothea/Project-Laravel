@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ចាត់តាំងដេប៉ាតឺម៉ង់ជាមួយប្រភេទសំណើរ</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">បញ្ចូលការចាត់តាំង</h3>
                            </div>

                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label> ឈ្មោះអ្នកត្រូវបានចាត់តាំង</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="">ជ្រើសរើសឈ្មោះ</option>
                                            @foreach ($getUser as $user)
                                                <option {{ $getRecord->user_id == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> ឈ្មោះដេប៉ាតឺម៉ង់</label>
                                        <select name="dapartment_id" class="form-control" required>
                                            <option value="">ជ្រើសរើសឈ្មោះដេប៉ាតឺម៉ង់</option>
                                            @foreach ($getDepartment as $department)
                                                <option {{ $getRecord->dapartment_id == $department->id ? 'selected' : '' }}
                                                    value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> ប្រភេទនៃសំណើរ</label>
                                        <select name="type_request_id" class="form-control" required>
                                            <option value="">ជ្រើសរើសប្រភេទនៃសំណើរ</option>
                                            @foreach ($getTypeRequest as $typerequest)
                                                <option {{ $getRecord->type_request_id == $typerequest->id ? 'selected' : '' }}
                                                    value="{{ $typerequest->id }}">{{ $typerequest->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ស្ថានភាព</label>
                                        <select name="status" class="form-control">
                                            <option value="">ជ្រើសរើសស្ថានភាព</option>
                                            <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">
                                                បានអនុម័ត</option>
                                            <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">
                                                កំពុងរង់ចាំ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ url('deptAdmin/assign_department_approver/list') }}"
                                        class="btn btn-danger">បោះបង់</a>
                                    <button type="submit" class="btn btn-primary">ចាត់តាំង</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
