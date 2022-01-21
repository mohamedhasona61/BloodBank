@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
          <h1>Add New City</h1>
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
            <form class="forms-sample" action="{{url(route('cities.store' ))}}" method="post">
              @csrf
              <div class="row justify-content-center">
                <div class="col-lg-8">

                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                      placeholder="name of city">
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>
                          {{-- {{ $message }} --}}
                        </strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="governorate_id">Choose a governorate</label>
                    <select name="governorate_id" class="form-control @error('governorate_id') is-invalid @enderror">
                      <option value="">Select a governorate</option>
                      @foreach ($governorates as $governorate)
                        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                      @endforeach
                    </select>
                    @error('governorate_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>
                          {{-- {{ $message }} --}}
                        </strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- /.content -->
@endsection