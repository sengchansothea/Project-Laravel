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
                                            <label>នាមត្រកូល</label>
                                            <input type="text" name="name" value="{{ old('name', $getRecord->name) }}"
                                                class="form-control" placeholder="បញ្ចូលនាមត្រកូល">
                                            <div style="color:red;">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>គោត្តនាម</label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}"
                                                class="form-control" placeholder="បញ្ចូលគោត្តនាម">
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>អ៊ីមែល</label>
                                            <input type="email" name="email" value="{{ old('email', $getRecord->email) }}"
                                                class="form-control" placeholder="បញ្ចូលអ៊ីមែល">
                                            <div style="color:red;">{{ $errors->first('email') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>តួនាទី</label>
                                            <select name="user_type" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{  ($getRecord->user_type == '1') ? 'selected' : '' }}
                                                    value="1">System Admin 
                                                </option>
                                                <option {{  ($getRecord->user_type == '2') ? 'selected' : '' }}
                                                    value="2">Department admin
                                                </option>
                                                <option {{  ($getRecord->user_type == '3')? 'selected' : '' }}
                                                    value="3">CEO
                                                </option>
                                                <option {{  ($getRecord->user_type == '4')? 'selected' : '' }}
                                                    value="4">HR Manager
                                                </option>
                                                <option {{  ($getRecord->user_type == '5') ? 'selected' : '' }}
                                                    value="5">CFO</option>
                                                <option {{  ($getRecord->user_type == '6')? 'selected' : '' }}
                                                    value="6">Team Leader
                                                </option>
                                                <option {{  ($getRecord->user_type == '7')? 'selected' : '' }}
                                                    value="7">Employee
                                                </option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('user_type') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ដេប៉ាតឺម៉ង់</label>
                                            <select name="department_id" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ ($getRecord->department_id =='1') ? 'selected' : '' }} value="1">ដេប៉ាតឺម៉ង់ IT</option>
                                                <option {{ ($getRecord->department_id =='2') ? 'selected' : '' }} value="2">ដេប៉ាតឺម៉ង់ Sales</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('department_id') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាព</label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ ($getRecord->status == '0') ? 'selected' : '' }} value="0">អនុម័ត</option>
                                                <option {{ ($getRecord->status == '1') ? 'selected' : '' }} value="1">កំពុងរង់ចាំ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('status') }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <p style="color: rgb(51, 91, 235)">Do you want to change the password do please add new password</p>
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
