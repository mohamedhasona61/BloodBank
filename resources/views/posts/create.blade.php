@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
          <h1>Add New Post</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-body">
            @include('posts.form')
            {!!Form::model([
    
              'action'=>'App\Http\Controllers\PostController@store'
            ])!!}
     {!!Form::close()!!}
    
          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- /.content -->
@endsection