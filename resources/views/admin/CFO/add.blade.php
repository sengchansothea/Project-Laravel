@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>បន្ថែមឈ្មោះ CFO ថ្មី</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មាន CFO ថ្មី</h3>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
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
                                            <label>នាមខ្លួន<span style="color: red">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" placeholder="បញ្ចូលនាមខ្លួន​" required>
                                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ភេទ<span style="color: red">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">ជ្រើសរើសភេទ</option>
                                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">ប្រុស</option>
                                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">ស្រី</option>
                                                <option {{ (old('gender') == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>លេខទូរស័ព្ទ</span></label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number')}}" placeholder="លេខទូរស័ព្ទ">
                                            <div style="color:red;">{{ $errors->first('phone_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាពគ្រួសារ</span></label>
                                           <select name="marital_status" class="form-control">
                                                <option value="">ជ្រើសរើសស្ថានភាពគ្រួសារ</option>
                                                <option {{ (old('marital_status') == 'Married') ? 'selected' : '' }} value="Married">បានរៀបការ</option>
                                                <option {{ (old('marital_status') == 'Single') ? 'selected' : '' }} value="Single">អនីតិជន</option>
                                                <option {{ (old('marital_status') == 'Other') ? 'selected' : '' }}value="Other">ផ្សេងៗ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ថ្ងៃកំណើត <span style="color: red">*</span></span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')}}">
                                            <div style="color:red;">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ថ្ងៃចូលធ្វើការ <span style="color: red">*</span></span></label>
                                            <input type="date" class="form-control" name="date_of_joining" value="{{ old('date_of_joining')}}">
                                            <div style="color:red;">{{ $errors->first('date_of_joining') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ទីកន្លែងកំណើត</label>
                                            <select name="province" class="form-control">
                                                <option value="">ជ្រើសរើសខេត្ត</option>
                                                <option {{ (old('province') == 'Kratie') ? 'selected' : '' }} value="Kratie">ក្រចេះ</option>
                                                <option {{ (old('province') == 'Kandal') ?'selected' : '' }} value="Kandal">កណ្ដាល</option>
                                                <option {{ (old('province') == 'Kep') ? 'selected' : '' }} value="Kep">កែប</option>
                                                <option {{ (old('province') == 'Kampot') ? 'selected' : '' }} value="Kampot">កំពត</option>
                                                <option {{ (old('province') == 'Kompong Cham') ? 'selected' : '' }} value="Kompong Cham">កំពង់ចាម</option>
                                                <option {{ (old('province') == 'Kompong Chhnang') ? 'selected' : '' }} value="Kompong Chhnang">កំពង់ឆ្នាំង</option>
                                                <option {{ (old('province') == 'Kompong Thom') ? 'selected' : '' }} value="Kompong Thom">កំពង់ធំ</option>
                                                <option {{ (old('province') == 'Kompong Speu') ? 'selected' : '' }} value="Kompong Speu">កំពង់ស្ពឺ</option>
                                                <option {{ (old('province') == 'Koh Kong') ? 'selected' : '' }} value="Koh Kong">កោះកុង</option>
                                                <option {{ (old('province') == 'Takaev') ? 'selected' : '' }} value="Takaev">តាកែវ</option>
                                                <option {{ (old('province') == 'Thbong Khmum') ? 'selected' : '' }} value="Thbong Khmum">ត្បូងឃ្មុំ</option>
                                                <option {{ (old('province') == 'Pailin') ? 'selected' : '' }} value="Pailin">ប៉ៃលិន</option>
                                                <option {{ (old('province') == 'Battambang') ? 'selected' : '' }} value="Battambang">បាត់ដំបង</option>
                                                <option {{ (old('province') == 'Banteay Meanchey') ? 'selected' : '' }} value="Banteay Meanchey">បន្ទាយមានជ័យ</option>
                                                <option {{ (old('province') == 'Prey Veng') ? 'selected' : '' }} value="Prey Veng">ព្រៃវែង</option>
                                                <option {{ (old('province') == 'Pursat') ? 'selected' : '' }} value="Pursat">ពោធិ៍សាត់</option>
                                                <option {{ (old('province') == 'Preah Sihanouk') ? 'selected' : '' }} value="Preah Sihanouk">ព្រះសិហនុ</option>
                                                <option {{ (old('province') == 'Preah Vihear') ? 'selected' : '' }} value="Preah Vihear">ព្រះវិហារ</option>
                                                <option {{ (old('province') == 'Phnom Penh') ? 'selected' : '' }} value="Phnom Penh">ភ្នំពេញ</option>
                                                <option {{ (old('province') == 'Mondulkiri') ? 'selected' : '' }} value="Mondulkiri">មណ្ឌលគិរី</option>
                                                <option {{ (old('province') == 'Ratanakiri') ? 'selected' : '' }} value="Ratanakiri">រតនៈគីរី</option>
                                                <option {{ (old('province') == 'Svay Rieng') ? 'selected' : '' }} value="Svay Rieng">ស្វាយរៀង</option>
                                                <option {{ (old('province') == 'Stung Treng') ? 'selected' : '' }} value="Stung Treng">ស្ទឹងត្រែង</option>
                                                <option {{ (old('province') == 'Siem Reap') ? 'selected' : '' }} value="Siem Reap">សៀមរាប</option>
                                                <option {{ (old('province') == 'Uddor Meanchey') ? 'selected' : '' }} value="Uddor Meanchey">ឧត្តរមានជ័យ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>រូបភាព Profile</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color:red;">{{ $errors->first('profile_pic') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ស្ថានភាព<span style="color: red">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">សូមជ្រើសរើស</option>
                                                <option {{ old('status') == '0' ? 'selected' : '' }} value="0">បានអនុម័ត
                                                </option>
                                                <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                                    កំពុងរង់ចាំ</option>
                                            </select>
                                            <div style="color:red;">{{ $errors->first('status') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>អាស័យដ្ឋានបច្ចុប្បន្ន</label>
                                            <textarea name="address" class="form-control" cols="20" rows="10" style="height: 76px;"value="{{ old('address') }}"></textarea>
                                            <div style="color:red;">{{ $errors->first('address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>កម្រិតវប្បធម៌</label>
                                            <textarea name="qualification" class="form-control" cols="20" rows="10" style="height: 76px;"value="{{ old('qualification') }}"></textarea>
                                            <div style="color:red;">{{ $errors->first('qualification') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>បទពិសោធន៍ការងារ</label>
                                            <textarea name="work_experience" class="form-control" cols="20" rows="10" style="height: 76px;"value="{{ old('work_experience') }}"></textarea>
                                            <div style="color:red;">{{ $errors->first('work_experience') }}</div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>អ៊ីមែល <span style="color: red">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" placeholder="បញ្ចូលអ៊ីមែល" required>
                                            <div style="color:red;">{{ $errors->first('email') }}</div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label>ពាក្យសម្ងាត់</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="បញ្ចូលពាក្យសម្ងាត់" required>
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
