@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>list Donations Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blood Bank</li>
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
          <h3 class="card-title">Donations Requests</h3>

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
        
        @include('flash::message')


        @if (count($donationRequests))
        <table class="table">
          <thead>
            <tr>
                <th>Patient id</th>
                <th>Patient Name</th>
                <th>City Name</th>
                <th>Blood Type</th>
                <th>Bags no.</th>
                <th>View</th>
                <th>Delete</th>
            </tr>
          </thead>


          <tbody>
          @foreach ($donationRequests as $donationRequest )
          <tr>
            <td>{{ $donationRequest->id }}</td>
            <td>{{ $donationRequest->patient_name }}</td>
            <td>{{ $donationRequest->city->name }}</td>
            <td>{{ $donationRequest->bloodType->name }}</td>
            <td>{{ $donationRequest->bags_num }}</td>
            <td>
              <a class="btn btn-primary" href="{{url(route('donationRequest.show',$donationRequest->id) ) }}">
                <i class="fas fa-eye"></i>
              </a>
            </td>
            <td class="text-center">
              {!!Form::open([
                   'action'=>['App\Http\Controllers\DonationRequestController@destroy',$donationRequest->id],
                    'method' =>'delete'
              ])!!}
              {!!Form::close()!!}
            </td>
        </tr>   
          @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-danger" role="alert">
           <p>No Donations Requests to Show</p>
      </div>
        @endif
        {{-- <a href="{{url(route('donationRequest.show'))}}"></a> --}}
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
