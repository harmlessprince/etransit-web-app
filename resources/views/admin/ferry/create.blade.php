@extends('admin.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .bulk-upload-button {
        background: #021037 !important;
        cursor: pointer;
        opacity: 0.8 !important;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
    }
    .sumbit_request{
        background: #021037 !important;
        cursor: pointer;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        padding:10px;
    }
    .sumbit_request:hover{
        background: #DC6513 !important;
        cursor: pointer;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        padding:10px;
    }
    .bulk-upload-button:hover {
        background: #DC6513 !important;
        opacity: 0.8 !important;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
        cursor: pointer;
    }

    .car-box{
        display: grid;
        grid-template-columns: repeat(1, 1fr);

    }
    .car-box input , select{
        outline:none !important;
        border:none !important;
        border-bottom: 1px solid #03174C !important;
    }
    input:focus ,select:focus{
        outline: none !important;
    }
    textarea {
        background-color: transparent !important;
        resize: none !important;
        outline: none !important;
        border: 1px solid #03174C !important;
    }

    textarea:focus {
        outline: none !important;
        border: 1px solid  #03174C  !important;
    }
    .image_file{
        outline: none !important;
        border:none !important;
    }
    .images-preview-div img
    {
        padding: 10px;
        max-width: 200px;
    }
    #buttonID{
        background:rgba(219, 226, 241, 0.54);
        color:white;
        padding:10px;
        border-radius: 50%;

    }
    .file_image_form{
        display:flex;
    }
    .add_butto{
        margin-top:90px;
    }
    .invalid-feedback{
        color:red !important;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background: #ccc !important;
    }
    .coach-box{
        display:flex;
    }
    .coach-btn{
        margin-top:35px;
    }

</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Add Ferry</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="button-box" >
            <div>
                {{--                <a href="{{url('/admin/import-export-cars')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Boats</a>&nbsp;--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
        <div class="card">

            <div class="card-body">
                <form method="post" action="{{url('/admin/store/ferry')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="boat_name">Ferry Name</label>
                            <input type="text" name="ferry_name" id="ferry_name" class="form-control" value="{{ old('ferry_name') }}" required />
                            <input type="hidden" name="service_id" value="{{$service->id}}" />
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="ferry_type">Ferry Type</label>
                            <select class="form-control" name="ferry_type" id="ferry_type">
                                <option> Please Select Ferry Type</option>
                                @foreach($ferryTypes as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="seats">Number Of Seats</label>
                            <input type="number" name="seats" id="seats" class="form-control" value="{{ old('seats') }}" required />
                        </div>
                    </div>
                    <div class="col-md-12 coach-box">
                        <div class="car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_type">Coach Type</label>
                                <input type="text" name="coach_type[]" id="coach_type" class="form-control" value="{{ old('coach_type') }}" placeholder="e.g A" required />
                            </div>
                        </div>
                        <div class=" car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_seats">Number of Seats</label>
                                <input type="number" name="coach_seats[]" id="coach_seats[]" class="form-control" placeholder="e.g 8" value="{{ old('coach_seat') }}" required />
                            </div>
                        </div>
                        <div class="col-md-4 coach-btn">
                            <button class="btn btn-success" id="coach">Add More Coach</button>
                        </div>
                    </div>
                    <div class="add_coach"></div>
                    <div class="file_image_form">
                        <div class="form-group">
                            <label for="images">Add Images</label>
                            <input   type="file" id="images" class="form-control image_file custom-file-upload" name="images[]" multiple="multiple" required >
                        </div>
                        <div class="add_button">
                            <button id="buttonID"> <img src="{{asset('images/icons/upload.png')}}"  width="20" height="20" /> </button>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="add_file"></div><br>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="images-preview-div"> </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="ckeditor form-control" name="description" id="description" rows="10" cols="20" required >{{old('description')}}</textarea>
                    </div>
                    <button class="sumbit_request" type="submit">Add Ferry</button>
                </form>
            </div>

        </div>
    </div>

    <script type="text/javascript">

        $('#buttonID').click(function(e){
            e.preventDefault();
            $('.add_file').append(`<div >
                        <div class="gender_section" style="margin-top:10px;">
                            <div class="passenger_type radio-group">
                                <div class="passenger_options custom-file-upload">
                                    <input type="file" name="images[]"  required/>
                                </div>
                            </div>
                        </div>
                    </div>`);
        });
        $('#coach').click(function(e){
            e.preventDefault();
            $('.add_coach').append(` <div class="col-md-12 coach-box" id="coachForm">
                        <div class="car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_type">Coach Type</label>
                                <input type="text" name="coach_type[]" id="coach_type" class="form-control" value="{{ old('coach_type') }}" required />
                            </div>
                        </div>
                        <div class=" car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_seats">Number of Seats</label>
                                <input type="number" name="coach_seats[]" id="coach_seats" class="form-control" value="{{ old('coach_seats') }}" required />
                            </div>
                        </div>
                        <div class="col-md-4 coach-btn">
                            <button class="btn btn-danger" id="coachRemove">Remove Coach</button>
                        </div>
                    </div>`);
        });


        $(document).on('click', '#coachRemove', function () {
            $(this).closest('#coachForm').remove();
        });

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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
