@extends('layouts.app')
@inject('model', 'App\Models\Category' )
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Categoty</h1>
          </div>
          <div class="col-sm-6">
         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
      
      <div class="box-body">
        @include('partials.validation_errors')
       
        {!!Form::model($model,[
            
          'action'=>'App\Http\Controllers\CategoryController@store'
        ])!!}
         @include('categories.form')
 {!!Form::close()!!}

      </div><!-- box-body -->
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
