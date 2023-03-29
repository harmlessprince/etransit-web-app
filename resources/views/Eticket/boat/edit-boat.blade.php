@extends('Eticket.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">{{strtoupper($boat->name)}}</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>   
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                     <form action="{{url('e-ticket/update-boat/'.$boat->id)}}" method="post">
                         @csrf
                         <div class="form-group">
                             <label for="name">Name</label>
                             <input type="text" class="form-control" name="name" value="{{$boat->name}}" id="name"/>
                         </div>
                         
                         <div class="form-group">
                             <label for="location">Location</label>
                             <input type="text" class="form-control" name="location" value="{{$boat->location}}" id="location"/>
                         </div>
                         <div class="form-group">
                             <label for="description">Description</label>
                             <input type="text" class="form-control" name="description" value="{{$boat->description}}" id="description"/>
                         </div>
                         <!-- <div class="form-group">
                             <label for="paths">Paths</label>
                             <input type="text" class="form-control" name="paths" value="{{$boat->paths}}" id="paths"/>
                         </div> -->

                         <div class="alert alert-primary" role="alert">
                             Upload the right dimension width=957px height=408px
                         </div>
                        <div class="file_image_form">
                            <div class="form-group">
                                <label for="images">Add Images</label>
                                <input   type="file" id="images" class="form-control image_file custom-file-upload" name="images[]" multiple="multiple" required >
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="images-preview-div"> </div>
                        </div>



                        <div class="submit_button">
                             <button class="btn btn-success">Update Boat</button>
                         </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script type="text/javascript">
        $(function() {
    var previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#images').on('change', function() {
        previewImages(this, 'div.images-preview-div');
    });
});
    </script>





@endsection    