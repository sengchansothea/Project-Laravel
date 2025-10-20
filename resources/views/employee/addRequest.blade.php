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
                                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមត្រកូល">
                                            <div style="color:red;">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>នាមខ្លួន<span style="color: red">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមខ្លួន​">
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ភេទ<span style="color: red">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">ជ្រើសរើសភេទ</option>
                                                <option {{ ($user->gender== 'Male') ? 'selected' : '' }} value="Male">ប្រុស</option>
                                                <option {{ ($user->gender == 'Female') ? 'selected' : '' }} value="Female">ស្រី</option>
                                                <option {{ ($user->gender == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>លេខទូរស័ព្ទ</span></label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number)}}" placeholder="លេខទូរស័ព្ទ">
                                            <div style="color:red;">{{ $errors->first('phone_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ប្រភេទនៃសំណើរ<span style="color: red">*</span></label>
                                            <select name="type_request" class="form-control">
                                                <option value="">ជ្រើសរើសប្រភេទនៃសំណើរ</option>
                                                <option {{ (old('type_request') == 'Leave') ? 'selected' : '' }} value="Leave">សុំច្បាប់ឈប់សម្រាក</option>
                                                <option {{ (old('type_request') == 'Mession') ? 'selected' : '' }} value="Mession">ស្មើសុំបេសកម្ម</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('type_request') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">ដេប៉ាតឺម៉ង់<span style="color: red">*</span></label>
                                            <select name="department_id" class="form-control">
                                                <option value="">ជ្រើសរើសដេប៉ាតីម៉ង់</option>
                                                @foreach ($getDepartment as $item)
                                                    <option {{ old('department_id') == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <div style="color:red;">{{ $errors->first('department_id') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>រយៈពេល<span style="color: red">*</span></label>
                                            <textarea name="time" class="form-control" cols="20" rows="10" style="height: 76px;" value="{{ old('time') }}" placeholder=".....ថ្ងៃ ចាប់ពីថ្ងៃទី.... ខែ... ឆ្នាំ២០... ដល់ថ្ងៃទី...ខែ... ឆ្នាំ២០...."></textarea>
                                            <div style="color:red;">{{ $errors->first('time') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>មូលហេតុ ឬហេតុផល<span style="color: red">*</span></label>
                                            <textarea name="reason" class="form-control" cols="20" rows="10" style="height: 76px;" value="{{ old('reason') }}" placeholder="មូលហេតុៈ ............"></textarea>
                                            <div style="color:red;">{{ $errors->first('reason') }}</div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="card-footer">
                                    <a href="{{ url('employee/formRequest') }}" class="btn btn-danger">បោះបង់</a>
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
