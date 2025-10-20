@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>កែប្រែប្រភេទសំណើ</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មានប្រភេទសំណើរ</h3>
                            </div>
                            
                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ឈ្មោះនៃសំណើរ<span style="color: red">*</span></label>
                                            <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" placeholder="បញ្ចូលឈ្មោះនៃសំណើរ" required> 
                                        <div style="color:red;">{{ $errors->first('name') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>ប្រភេទនៃសំណើរ<span style="color: red">*</span></label>
                                            <select name="type_request" class="form-control">
                                                <option value="">សូមជ្រើសរើសប្រភេទសំណើរ</option>
                                                <option {{ $getRecord->type_request == 'Leave' ? 'selected' : '' }} value="Leave">ការឈប់សម្រាក</option>
                                                <option {{ $getRecord->type_request == 'Mession' ? 'selected' : '' }} value="Mession">ការបំពេញការងារ</option>
                                            </select>
                                        <div style="color:red;">{{ $errors->first('status') }}</div>
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
                                    <a href="{{ url('deptAdmin/type_Request/list') }}" class="btn btn-danger">បោះបង់</a>
                                    <button type="submit" class="btn btn-primary">ដាក់ស្នើ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
