@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ព័ត៌មានផ្ទាល់ខ្លួន</h1>
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
                                <h3 class="card-title">ព័ត៌មានផ្ទាល់ខ្លួន</h3>
                            </div>

                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>នាមត្រកូល</label>
                                        <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" placeholder="បញ្ចូលឈ្មោះ" required> 
                                    </div>
                                    <div class="form-group">
                                        <label>នាមខ្លួន</label>
                                        <input type="text" name="last_name" value="{{old('last_name', $getRecord->last_name) }}" class="form-control" placeholder="បញ្ចូលឈ្មោះ" required> 
                                    </div>
                                    <div class="form-group">
                                        <label>អ៊ីមែល</label>
                                        <input type="email" name="email" value="{{ old('email', $getRecord->email) }}" class="form-control" placeholder="បញ្ចូលអ៊ីមែល" required>
                                        <div style="color:red;">{{ $errors->first('email') }}</div>
                                    </div>                 
                                </div>

                                <div class="card-footer">
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
