@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>កែប្រែលេខសម្ងាត់</h1>
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
                                <h3 class="card-title">កែប្រែលេខសម្ងាត់</h3>
                            </div>
                            
                            <form method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>លេខសម្ងាត់ចាស់</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="បញ្ចូលលេខសម្ងាត់ចាស់" required>
                                    </div>
                                    <div class="form-group">
                                        <label>លេខសម្ងាត់ថ្មី</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="បញ្ចូលលេខសម្ងាត់ថ្មី" required>
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
