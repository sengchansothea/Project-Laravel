@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>កែប្រែដេប៉ាតឺម៉ង់</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មានដេប៉ាតឺម៉ង់</h3>
                            </div>
                            
                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ឈ្មោះដេប៉ាតីម៉ង់</label>
                                        <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" placeholder="បញ្ចូលឈ្មោះ" required> 
                                    </div>
                                    <div class="form-group">
                                        <label>ស្ថានភាព<span style="color: red">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ $getRecord->status == '0' ? 'selected' : '' }} value="0">បានអនុម័ត</option>
                                                <option {{ $getRecord->status == '1' ? 'selected' : '' }} value="1">កំពុងរង់ចាំ</option>
                                            </select>
                                        <div style="color:red;">{{ $errors->first('status') }}</div>
                                    </div>                
                                </div>

                                <div class="card-footer">
                                    <a href="{{ url('deptAdmin/department') }}" class="btn btn-danger">បោះបង់</a>
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
