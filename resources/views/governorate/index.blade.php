@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>list of governorates</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      <div class="box-body">
        <a href="{{url(route('governorate.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>New Governorate</a>
        @include('flash::message')


        @if (count($records))
        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>


          <tbody>
          @foreach ($records as $record )
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$record->name}}</td>
            <td class="text-center"> <a href="{{url(route('governorate.edit',$record->id ))}}"><i class="fa fa-edit"></i></a></td>
            
            <td class="text-center">

              {!!Form::open([
                   'action'=>['App\Http\Controllers\GovernorateController@destroy',$record->id],
                    'method' =>'delete'
              ])!!}
              <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
              {!!Form::close()!!}
            </td>
            
          
            
            
            
          </tr>
            
          @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-danger" role="alert">
           No Data
      </div>
        @endif
          
       
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
