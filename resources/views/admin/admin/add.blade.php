@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>បន្ថែមអ្នកគ្រប់គ្រងថ្មី</h1>
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
                                <h3 class="card-title">បញ្ចូលព័ត៌មានអ្នកគ្រប់គ្រងថ្មី</h3>
                            </div>
                            
                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ឈ្មោះ</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="បញ្ចូលឈ្មោះ" required> 
                                    </div>
                                    <div class="form-group">
                                        <label>អ៊ីមែល</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="បញ្ចូលអ៊ីមែល" required>
                                        <div style="color:red;">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>ពាក្យសម្ងាត់</label>
                                        <input type="password" name="password" class="form-control" placeholder="បញ្ចូលពាក្យសម្ងាត់" required>
                                    </div>                   
                                </div>

                                <div class="card-footer">
                                    <a href="{{ url('admin/admin/list') }}" class="btn btn-danger">បោះបង់</a>
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
