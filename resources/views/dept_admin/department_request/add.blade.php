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
                                        <label> ឈ្មោះដេប៉ាតឺម៉ង់</label>
                                        <select name="dapartments_id" class="form-control" required>
                                            <option value="">ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                                            @foreach ($getDepartment as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ប្រភេទនៃសំណើរ</label>
                                        @foreach ($getTypeRequest as $typerequest)
                                            <div>
                                                <label style="font-weight: normal">
                                                    <input name="type_requests_id[]" value="{{ $typerequest->id }}"
                                                        type="checkbox"> {{ $typerequest->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>ស្ថានភាព</label>
                                        <select name="status" class="form-control">
                                            <option value="">ជ្រើសរើសស្ថានភាព</option>
                                            <option value="0">បានអនុម័ត</option>
                                            <option value="1">កំពុងរង់ចាំ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ url('deptAdmin/assign_department_request/list') }}"
                                        class="btn btn-danger">បោះបង់</a>
                                    <button type="submit" class="btn btn-primary">ដាក់បញ្ចូល</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
