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
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 30px;
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
                        <li class="breadcrumb-item">Add car</li>
                    </ol>
                </div>
{{--                <div class="col-6">--}}
{{--                    <!-- Bookmark Start-->--}}
{{--                    <div class="bookmark pull-right">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>--}}
{{--                            <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>--}}
{{--                                <form class="form-inline search-form" action="#" method="get">--}}
{{--                                    <div class="form-group form-control-search">--}}
{{--                                        <div class="Typeahead Typeahead--twitterUsers">--}}
{{--                                            <div class="u-posRelative">--}}
{{--                                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search.." name="q" title="" autofocus>--}}
{{--                                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="Typeahead-menu"></div>--}}
{{--                                            <script id="result-template" type="text/x-handlebars-template">--}}
{{--                                                <div class="ProfileCard u-cf">--}}
{{--                                                    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>--}}
{{--                                                    <div class="ProfileCard-details">--}}
{{--                                                        <div class="ProfileCard-realName">some name</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </script>--}}
{{--                                            <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="button-box" >
            <div>
                <a href="{{url('/admin/import-export-cars')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Cars</a>&nbsp;
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
                <form method="post" action="{{url('/admin/store/car')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="car-box">
                        <div class="form-group">
                            <label>Car Brand</label>
                            <input type="text" name="car_brand" id="car_brand" class="form-control" value="{{ old('car_brand') }}"  required/>
                        </div>
                        <div class="form-group">
                            <label for="car_registration">Car Registration</label>
                            <input type="text" class="form-control" name="car_registration" id="car_registration" value="{{ old('car_registration') }}"  required/>
                        </div>
                        <div class="form-group">
                            <label for="car_type">Car Type</label>
                            <select  class="form-control" name="car_type" id="car_type"  required>
                                <option>Select Car Type</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="car_class">Car Class </label>
                            <select  class="form-control" name="car_class" id="car_class" required>
                                <option>Select Car Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Seat Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" value="{{ old('capacity') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="transmission">Seat Capacity</label>
                           <select class="form-control" name="transmission" id="transmission">
                               <option value="automatic">Automatic</option>
                               <option value="manual">Manual</option>
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="model_year">Model Year</label>
                            <input type="text" class="form-control" name="model_year" id="model_year" value="{{ old('model_year') }}" placeholder="2009" required/>
                        </div>

                        <div class="form-group">
                            <label for="daily_rentals">Daily Rentals</label>
                            <input type="text" class="form-control" name="daily_rentals" id="daily_rentals" value="{{ old('daily_rentals') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="extra_hour">Extra Hour</label>
                            <input type="text" class="form-control" name="extra_hour" id="extra_hour" value="{{ old('extra_hour') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="sw_region_fare">SW Region (Fare)r</label>
                            <input type="text" class="form-control" name="sw_region_fare" id="sw_region_fare" value="{{ old('sw_region_fare') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="se_region_fare">SE Region (Fare)</label>
                            <input type="text" class="form-control" name="se_region_fare" id="se_region_fare" value="{{ old('se_region_fare') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="ss_region_fare">SS Region (Fare)</label>
                            <input type="text" class="form-control" name="ss_region_fare" id="ss_region_fare" value="{{ old('ss_region_fare') }}"  required/>
                        </div>

                        <div class="form-group">
                            <label for="nc_region_fare">NC Region (Fare)</label>
                            <input type="text" class="form-control" name="nc_region_fare" id="nc_region_fare" value="{{ old('nc_region_fare') }}"  required/>
                        </div>


                    </div>
                    <div class="alert alert-primary" role="alert">
                       Upload the righ dimension width=233px height=83px
                    </div>
                  <div class="file_image_form">

                      <div class="form-group">
                          <label for="images">Add Images</label>
                          <input   type="file" id="images" class="form-control image_file" name="images[]" multiple="multiple" required>

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
                        <textarea class="form-control" name="description" id="description" rows="10" cols="20" value="{{ old('description') }}" required> </textarea>
                    </div>
                    <button class="sumbit_request" type="submit">Add Car</button>
                </form>
            </div>

        </div>

    </div>

    <script type="text/javascript">

        $('#buttonID').click(function(e){
            e.preventDefault();
            $('.add_file').append(`<div >
                        <div class="gender_section">
                            <div class="passenger_type radio-group">
                                <div class="passenger_options">
                                    <input type="file" name="images[]"  />

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

@endsection
