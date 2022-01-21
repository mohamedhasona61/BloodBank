@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Clients</h1>
        </div>
        @include('clients.alert')
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Of All Clients</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Deactivate</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($clients as $client)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>
                  <a class="btn btn-warning" href="#"><i class="fas fa-user-slash"></i></a>
                </td>
                <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-toggle="modal"
                    data-target="#exampleModal{{ $client->id }}">
                    <i class="fas fa-trash-alt"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <form action="{{ route('client.destroy', $client->id) }}" method="post">@csrf
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
              <p>No Clients found.</p>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>




  </section>
  <!-- /.content -->
@endsection