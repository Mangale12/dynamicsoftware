@extends("admin.dashboard")
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous"
/>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Category</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Category :</strong>
                        <select name="category" id="" class="form-control">
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="demo"></div>

                </div>

                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    @endsection

    @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>
<script src="{{ asset('public/assets/plugins/jquery/spartan-multi-image-picker-min.js') }}"></script>

    <script>
$(document).ready(function(e) {
  var tagsValue = '';
  $('.emails').val(tagsValue).tagsinput();

  $("#demo").spartanMultiImagePicker({
            fieldName: 'gallery_image[]',
            maxCount: 10,
          	allowedExt:'png|jpg|jpeg|gif|webp',
            rowHeight: '200px',
            groupClassName: 'col-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('File size too big');
            }
        });

});


    </script>
    @endsection
