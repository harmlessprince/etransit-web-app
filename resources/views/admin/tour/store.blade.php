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
                        <li class="breadcrumb-item">Add Tour</li>
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
                <form method="post" action="{{url('/admin/store/tour')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="tour_name">Tour Name</label>
                            <input type="text" name="tour_name" id="tour_name" class="form-control" value="{{ old('tour_name') }}" required />
                            <input type="hidden" name="service_id" value="{{$service->id}}"/>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required />
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="departure_date">Departure Date</label>
                            <input type="date" name="departure_date" id="departure_date" class="form-control" value="{{ old('departure_date') }}" required />
                        </div>

                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="departure_time">Departure Time</label>
                            <input type="time" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time') }}" required />
                        </div>

                    </div>
                    <div class="row">
                        <div class="car-box col-md-6 col-sm-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="duration">Duration </label>
                                <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}" required  mon="0"/>
                            </div>
                        </div>
                        <div class="car-box col-md-6 col-sm-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="duration_options">Select Duration in (Months/Weeks/Days/)</label>
                                <select id="duration_options" name="duration_options" class="form-control">
                                    <option value="">Select Options</option>
                                    <option valuw="year">Year</option>
                                    <option valuw="month">Month</option>
                                    <option valuw="weeks">Weeks</option>
                                    <option valuw="days">Days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="tour_type">Tour Type</label>
                            <select class="form-control" name="tour_type" id="tour_type">
                                <option value="">Select Tour Type</option>
                                <option value="domestic">Domestic</option>
                                <option value="international">International</option>

                            </select>

                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="amount_regular">Amount (Regular)</label>
                            <input type="text" name="amount_regular" id="amount_regular" class="form-control" value="{{ old('amount_regular') }}" required  mon="0"/>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="amount_standard">Amount (Standard)</label>
                            <input type="text" name="amount_standard" id="amount_standard" class="form-control" value="{{ old('amount_standard') }}" required  mon="0"/>
                        </div>
                    </div>
                    <div class="alert alert-primary" role="alert">
                        Upload the right dimension width=957px height=408px
                    </div>
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
                    <button class="sumbit_request" type="submit">Add Tour</button>
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
                                    <input type="file" name="images[]" required/>
                                </div>
                            </div>
                        </div>
                    </div>`);
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
