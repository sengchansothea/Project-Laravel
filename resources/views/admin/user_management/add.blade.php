@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>បន្ថែមអ្នកប្រើប្រាស់ប្រព័ន្ធថ្មី</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មានអ្នកប្រើប្រាស់ថ្មី</h3>
                            </div>

                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row column-md-12">
                                        <div class="form-group col-md-6">
                                            <label>នាមត្រកូល <span style="color: red">*</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមត្រកូល" required>
                                            <div style="color:red;">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>គោត្តនាម <span style="color: red">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" placeholder="បញ្ចូលគោត្តនាម" required>
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>អ៊ីមែល <span style="color: red">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" placeholder="បញ្ចូលអ៊ីមែល" required>
                                            <div style="color:red;">{{ $errors->first('email') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>តួនាទី<span style="color: red">*</span></label>
                                            <select name="user_type" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ old('user_type') == '1' ? 'selected' : '' }}
                                                    value="1">Admin
                                                </option>
                                                <option {{ old('user_type') == '2' ? 'selected' : '' }}
                                                    value="2">Department Admin
                                                </option>
                                                <option {{ old('user_type') == '3' ? 'selected' : '' }} 
                                                    value="3">CEO
                                                </option>
                                                <option {{ old('user_type') == '4' ? 'selected' : '' }}
                                                    value="4">HR Manager
                                                </option>
                                                <option {{ old('user_type') == '5' ? 'selected' : '' }}
                                                    value="5">CFO
                                                </option>
                                                <option {{ old('user_type') == '6' ? 'selected' : '' }}
                                                    value="6">Team Leader
                                                </option>
                                                <option {{ old('user_type') == '7' ? 'selected' : '' }}
                                                    value="7">Employee
                                                </option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('user_type') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ពាក្យសម្ងាត់</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="បញ្ចូលពាក្យសម្ងាត់" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ដេប៉ាតឺម៉ង់<span style="color: red">*</span></label>
                                            <select name="department_id" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ old('department_id') == '1' ? 'selected' : '' }} value="1">ដេប៉ាតឺម៉ង់ IT</option>
                                                <option {{ old('department_id') == '2' ? 'selected' : '' }} value="2">ដេប៉ាតឺម៉ង់ Sales</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('department_id') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាព<span style="color: red">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ old('status') == '0' ? 'selected' : '' }} value="0">សកម្ម
                                                </option>
                                                <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                                    អសកម្ម</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a href="{{ url('admin/user_management/list') }}" class="btn btn-danger">បោះបង់</a>
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
