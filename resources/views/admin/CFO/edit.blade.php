@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>កែប្រែឈ្មោះ CFO</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មាន CFO</h3>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row column-md-12">
                                        <div class="form-group col-md-6">
                                            <label>នាមត្រកូល <span style="color: red">*</span></label>
                                            <input type="text" name="name" value="{{ old('name', $getRecord->name) }}"
                                                class="form-control" placeholder="បញ្ចូលនាមត្រកូល">
                                            <div style="color:red;">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>គោត្តនាម <span style="color: red">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}"
                                                class="form-control" placeholder="បញ្ចូលគោត្តនាម">
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ភេទ<span style="color: red">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">ជ្រើសរើសភេទ</option>
                                                <option {{ ($getRecord->gender == 'Male') ? 'selected' : '' }} value="Male">ប្រុស</option>
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
                                            <label>ស្ថានភាពគ្រួសារ</span></label>
                                           <select name="marital_status" class="form-control">
                                                <option value="">ជ្រើសរើសស្ថានភាពគ្រួសារ</option>
                                                <option {{ ($getRecord->marital_status == 'Married') ? 'selected' : '' }} value="Married">បានរៀបការ</option>
                                                <option {{ ($getRecord->marital_status == 'Single') ? 'selected' : '' }} value="Single">អនីតិជន</option>
                                                <option {{ ($getRecord->marital_status == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ថ្ងៃកំណើត <span style="color: red">*</span></span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth)}}">
                                            <div style="color:red;">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ថ្ងៃចូលធ្វើការ <span style="color: red">*</span></span></label>
                                            <input type="date" class="form-control" name="date_of_joining" value="{{ old('date_of_joining', $getRecord->date_of_joining)}}">
                                            <div style="color:red;">{{ $errors->first('date_of_joining') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ទីកន្លែងកំណើត</label>
                                            <select name="province" class="form-control">
                                                <option value="">ជ្រើសរើសខេត្ត</option>
                                                <option {{ ($getRecord->province == 'Kratie') ? 'selected' : '' }} value="Kratie">ក្រចេះ</option>
                                                <option {{ ($getRecord->province == 'Kandal') ?'selected' : '' }} value="Kandal">កណ្ដាល</option>
                                                <option {{ ($getRecord->province == 'Kep') ? 'selected' : '' }} value="Kep">កែប</option>
                                                <option {{ ($getRecord->province == 'Kampot') ? 'selected' : '' }} value="Kampot">កំពត</option>
                                                <option {{ ($getRecord->province == 'Kompong Cham') ? 'selected' : '' }} value="Kompong Cham">កំពង់ចាម</option>
                                                <option {{ ($getRecord->province == 'Kompong Chhnang') ? 'selected' : '' }} value="Kompong Chhnang">កំពង់ឆ្នាំង</option>
                                                <option {{ ($getRecord->province == 'Kompong Thom') ? 'selected' : '' }} value="Kompong Thom">កំពង់ធំ</option>
                                                <option {{ ($getRecord->province == 'Kompong Speu') ? 'selected' : '' }} value="Kompong Speu">កំពង់ស្ពឺ</option>
                                                <option {{ ($getRecord->province == 'Koh Kong') ? 'selected' : '' }} value="Koh Kong">កោះកុង</option>
                                                <option {{ ($getRecord->province == 'Takaev') ? 'selected' : '' }} value="Takaev">តាកែវ</option>
                                                <option {{ ($getRecord->province == 'Thbong Khmum') ? 'selected' : '' }} value="Thbong Khmum">ត្បូងឃ្មុំ</option>
                                                <option {{ ($getRecord->province == 'Pailin') ? 'selected' : '' }} value="Pailin">ប៉ៃលិន</option>
                                                <option {{ ($getRecord->province == 'Battambang') ? 'selected' : '' }} value="Battambang">បាត់ដំបង</option>
                                                <option {{ ($getRecord->province == 'Banteay Meanchey') ? 'selected' : '' }} value="Banteay Meanchey">បន្ទាយមានជ័យ</option>
                                                <option {{ ($getRecord->province == 'Prey Veng') ? 'selected' : '' }} value="Prey Veng">ព្រៃវែង</option>
                                                <option {{ ($getRecord->province == 'Pursat') ? 'selected' : '' }} value="Pursat">ពោធិ៍សាត់</option>
                                                <option {{ ($getRecord->province == 'Preah Sihanouk') ? 'selected' : '' }} value="Preah Sihanouk">ព្រះសិហនុ</option>
                                                <option {{ ($getRecord->province == 'Preah Vihear') ? 'selected' : '' }} value="Preah Vihear">ព្រះវិហារ</option>
                                                <option {{ ($getRecord->province == 'Phnom Penh') ? 'selected' : '' }} value="Phnom Penh">ភ្នំពេញ</option>
                                                <option {{ ($getRecord->province == 'Mondulkiri') ? 'selected' : '' }} value="Mondulkiri">មណ្ឌលគិរី</option>
                                                <option {{ ($getRecord->province == 'Ratanakiri') ? 'selected' : '' }} value="Ratanakiri">រតនៈគីរី</option>
                                                <option {{ ($getRecord->province == 'Svay Rieng') ? 'selected' : '' }} value="Svay Rieng">ស្វាយរៀង</option>
                                                <option {{ ($getRecord->province == 'Stung Treng') ? 'selected' : '' }} value="Stung Treng">ស្ទឹងត្រែង</option>
                                                <option {{ ($getRecord->province == 'Siem Reap') ? 'selected' : '' }} value="Siem Reap">សៀមរាប</option>
                                                <option {{ ($getRecord->province == 'Uddor Meanchey') ? 'selected' : '' }} value="Uddor Meanchey">ឧត្តរមានជ័យ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>រូបភាព Profile</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color:red;">{{ $errors->first('profile_pic') }}</div>
                                            @if (!empty($getRecord->getProfile()))
                                                <img src="{{$getRecord->getProfile() }}" style="width:auto;height:50px">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាព<span style="color: red">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ $getRecord->status == '0' ? 'selected' : '' }} value="0">បានអនុម័ត</option>
                                                <option {{ $getRecord->status == '1' ? 'selected' : '' }} value="1">កំពុងរង់ចាំ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('status') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>អាស័យដ្ឋានបច្ចុប្បន្ន</label>
                                            <textarea name="address" class="form-control" cols="20" rows="10" style="height: 76px;">{{ old('address', $getRecord->address)}}</textarea>
                                            <div style="color:red;">{{ $errors->first('address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>កម្រិតវប្បធម៌</label>
                                            <textarea name="qualification" class="form-control" cols="20" rows="10" style="height: 76px;">{{ old('qualification', $getRecord->qualification)}}</textarea>
                                            <div style="color:red;">{{ $errors->first('qualification') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>បទពិសោធន៍ការងារ</label>
                                            <textarea name="work_experience" class="form-control" cols="20" rows="10" style="height: 76px;">{{ old('work_experience', $getRecord->work_experience)}}</textarea>
                                            <div style="color:red;">{{ $errors->first('work_experience') }}</div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label>អ៊ីមែល <span style="color: red">*</span></label>
                                            <input type="email" name="email" value="{{ old('email', $getRecord->email) }}"
                                                class="form-control" placeholder="បញ្ចូលអ៊ីមែល">
                                            <div style="color:red;">{{ $errors->first('email') }}</div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label>ពាក្យសម្ងាត់</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="បញ្ចូលពាក្យសម្ងាត់">
                                            <small style="color: rgb(52, 52, 248)">Do you want to change password so Please add new password</small>
                                        </div>
                                       
                                        
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a href="{{ url('admin/CFO/list') }}" class="btn btn-danger">បោះបង់</a>
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
