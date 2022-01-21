@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>list of Roles</h1>
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
        <a href="{{url(route('role.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>New Roles</a>
        @include('flash::message')
 

        @forelse ($roles as $role)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $role->name }}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('role.edit', [$role->id]) }}"><i
                class="fas fa-edit"></i></a>
          </td>
          <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal"
              data-target="#exampleModal{{ $role->id }}">
              <i class="fas fa-trash-alt"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $role->id }}" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form action="{{ route('role.destroy', $role->id) }}" method="post">@csrf
                  @method('DELETE')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete
                        confirmation</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p> Are you sure you want to delete this item?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Yes Delete it</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Modal -->
          </td>
        </tr>
      @empty
        <p>No roles found.</p>
      @endforelse

         
      </div><!-- box-body -->
        <!-- /.card-body -->
        <div class="card-footer">
        
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
