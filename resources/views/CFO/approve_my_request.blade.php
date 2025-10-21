@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <center><h1>លិខិតស្មើសុំ</h1></center>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('message')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">បញ្ចូលព័ត៌មាន</h3>
                            </div>
                            
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row column-md-12">
                                        <div class="form-group col-md-6">
                                            <label>នាមត្រកូល <span style="color: red">*</span></label>
                                            <input type="text" name="name" value="{{ old('name', $getRecord->name ?? '') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមត្រកូល">
                                            <div style="color:red;">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>នាមខ្លួន<span style="color: red">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $getRecord->last_name ?? '') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមខ្លួន​">
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ភេទ<span style="color: red">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">ជ្រើសរើសភេទ</option>
                                                <option {{ ($getRecord->gender== 'Male') ? 'selected' : '' }} value="Male">ប្រុស</option>
                                                <option {{ ($getRecord->gender == 'Female') ? 'selected' : '' }} value="Female">ស្រី</option>
                                                <option {{ ($getRecord->gender == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>លេខទូរស័ព្ទ</span></label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $getRecord->phone_number)}}" placeholder="លេខទូរស័ព្ទ">
                                            <div style="color:red;">{{ $errors->first('phone_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ប្រភេទនៃសុំណើរ<span style="color: red">*</span></label>
                                            <select name="type_request_id" class="form-control">
                                                <option value="">ជ្រើសរើសប្រភេទនៃសំណើរ</option>
                                                <option {{ ($getRecord->type_request_id == '1') ? 'selected' : '' }} value="1">សុំច្បាប់ឈប់សម្រាក</option>
                                                <option {{ ($getRecord->type_request_id == '2') ? 'selected' : '' }} value="2">ស្មើសុំបេសកម្ម</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('type_request_id') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាព<span style="color: red">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">ជ្រើសរើសស្ថានភាព</option>
                                                <option {{ ($getRecord->status== '0') ? 'selected' : '' }} value="0">បានអនុម័ត</option>
                                                <option {{ ($getRecord->status == '1') ? 'selected' : '' }} value="1">កំពុងរង់ចាំ</option>
                                                <option {{ ($getRecord->status == '2') ? 'selected' : '' }} value="2">បានបដិសេដ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('status') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>រយៈពេល<span style="color: red">*</span></label>
                                            <textarea name="time" class="form-control" cols="20" rows="10" style="height: 76px;">{{ old('time', $getRecord->time) }}</textarea>
                                            <div style="color:red;">{{ $errors->first('time') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>មូលហេតុ ឬហេតុផល<span style="color: red">*</span></label>
                                            <textarea name="reason" class="form-control" cols="20" rows="10" style="height: 76px;">{{ old('reason', $getRecord->reason) }}</textarea>
                                            <div style="color:red;">{{ $errors->first('reason') }}</div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="card-footer">
                                    <a href="{{ url('CFO/myRequest') }}" class="btn btn-danger">បោះបង់</a>
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
