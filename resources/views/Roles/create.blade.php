 
@extends('layouts.app')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
          <h1>Add New Role</h1>
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
            <form class="forms-sample" action="{{ route('role.store') }}" method="post">
              @csrf
              <div class="row justify-content-center">
                <div class="col-lg-8">

                  <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>
                          {{ $message }}
                        </strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">

                    <label for="display_name">الاسم المعروض</label>
                 
                    {!!Form::text('display_name',null,[
                      'class'=>'form-control'
                    ])!!}
                  </div>
                  
                  <div class="form-group">

                    <label for="description">الوصف </label>
                 
                    {!!Form::textarea('description',null,[
                      'class'=>'form-control'
                    ])!!}
                  </div>
                  
  
                  <div class="row justify-content-center">
                    @foreach ( Spatie\Permission\Models\Permission::get() as $permission)
                      <div class="col-lg-3">
                        <input id="select-all" type="checkbox"><label for="select-all">Select all</label>
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input" id="formCheck{{ $permission->id }}"
                            name="permission_list[]" value="{{ $permission->id }}">
                       
                          <label class="form-check-label"
                            for="formCheck{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  @push('scripts')
                  <script>
                    $("#select-all").click(function(){
                      $("input[type=checkbox]").prop('checked',$(this).prop('checked'));

                    });
                  </script>
                      
                  @endpush

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