@extends('dashboard.layouts.main')
@section('container')
<div class="container">
  <main id="main" class="main">
    <section class="">
      <div class="row">

        <div class="col-lg-12">
          <form action="/user/{{ auth()->user()->id }}/updatephoto" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="row">
              <div class="text-start mt-4 mb-4 fw-bold"></i>
                Photo user
              </div>
          
              <div class="text-start mt-4 mb-4 teks-transparan"></i>
                Perbarui Photo  disini
            </div>

            <div class="mb-3">
              <label for="photo" class="text-start mt-2 mb-2 fw-bold">Photo Profile</label>
              <div class="drag-file">
                <input type="file" name="photo" class="form-control-file" id="photo" accept="photo/*" value="{{ old('photo') }}">
                <label class="drag-file-text" for="photo" id="fileNameLabel">Drag File Here</label>
                <div id="previewContainer">
                  @if ($user && $user->photo)
                  <img class="image-preview" src="{{asset('storage/'.$user->photo) }}" alt="Preview">
                  @endif
                </div>
              </div>
              @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
              @endif
            </div>

            <div class="link-button">
              <input type="submit" class="btn btn-outline-primary" name="submit" value="Simpan" style="text-align: center">
            </div>

            </div>
          </form>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
</div>

<script>
  
</script>
@endsection

