
  <div class="form-group">
    <label for="name">Name</label>
    {!!Form::text('name',null,[
      'class'=>'form-control'
    ])!!}
  </div>
  <div class="form-group">
    <label for="governorate">Choose a governorate</label>
    <select name="governorate"
      class="custom-select form-control @error('governorate_id') is-invalid @enderror">
      <option value="">Select a governorate</option>
      @foreach ($governorates as $governorate)
        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
      @endforeach
    </select>
    @error('governorate_id')
      <span class="invalid-feedback" role="alert">
        <strong>
          {{ $message }}
        </strong>
      </span>
    @enderror
  </div>

  <div class="form-group">
  <button class="btn btn-primary" type="submit">Submit</button>
  </div>
