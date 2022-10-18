@extends('Eticket.layout.app')
<style>
    input , select{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }


    input:focus{
        outline:none !important;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
    }
    a{
        text-decoration: none !important;
    }
    .add_more_images_text{
        color:red;
    }
    .sumbit_request{
        color:#fff !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Add Car</li>
                    </ol>
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
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{url('/e-ticket/store-car')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="car-box">
                      <div class="row">
                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label>Car Brand and Model</label>
                                  <input type="text" name="car_brand" id="car_brand" class="form-control" value="{{ old('car_brand') }}" placeholder="e.g Toyota Corolla" required/>
                              </div>
                          </div>
                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label for="car_registration">Car Registration</label>
                                  <input type="text" class="form-control" name="car_registration" id="car_registration" value="{{ old('car_registration') }}"  required/>
                              </div>
                          </div>
                      </div>

                    <div class="row">
                        <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                            <div class="form-group">
                                <label for="car_type">Car Type</label>
                                <select  class="form-control" name="car_type" id="car_type"  required>
                                    <option>Select Car Type</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                            <div class="form-group">
                                <label for="car_class">Car Class </label>
                                <select  class="form-control" name="car_class" id="car_class" required>
                                    <option>Select Car Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                         <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                             <div class="form-group">
                                 <label for="capacity">Seat Capacity</label>
                                 <input type="number" class="form-control" name="capacity" id="capacity" value="{{ old('capacity') }}"  required/>
                             </div>
                         </div>
                         <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                             <div class="form-group">
                                 <label for="transmission">Transmission</label>
                                 <select class="form-control" name="transmission" id="transmission">
                                     <option value="automatic">Automatic</option>
                                     <option value="manual">Manual</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                    <div class="row">
                        <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                            <div class="form-group">
                                <label for="model_year">Model Year</label>
                                <input type="text" class="form-control" name="model_year" id="model_year" value="{{ old('model_year') }}" placeholder="2009" required/>
                            </div>
                        </div>

                        <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                            <div class="form-group">
                                <label for="daily_rentals">Daily Rentals Rate(Within area of operation)</label>
                                <input type="text" class="form-control" name="daily_rentals" id="daily_rentals" value="{{ old('daily_rentals') }}"  required/>
                            </div>
                        </div>
                    </div>

                      <div class="row">
                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label for="extra_hour">Fees per Extra Hour</label>
                                  <input type="text" class="form-control" name="extra_hour" id="extra_hour" value="{{ old('extra_hour') }}"  required/>
                              </div>
                          </div>

                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label for="sw_region_fare">SW Region (Fare)</label>
                                  <input type="text" class="form-control" name="sw_region_fare" id="sw_region_fare" value="{{ old('sw_region_fare') }}"  />
                              </div>
                          </div>
                      </div>

                       <div class="row">
                           <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                               <div class="form-group">
                                   <label for="se_region_fare">SE Region (Fare)</label>
                                   <input type="text" class="form-control" name="se_region_fare" id="se_region_fare" value="{{ old('se_region_fare') }}"  />
                               </div>
                           </div>

                           <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                               <div class="form-group">
                                   <label for="ss_region_fare">SS Region (Fare)</label>
                                   <input type="text" class="form-control" name="ss_region_fare" id="ss_region_fare" value="{{ old('ss_region_fare') }}"  />
                               </div>
                           </div>
                       </div>

                      <div class="row">
                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label for="nc_region_fare">NC Region (Fare)</label>
                                  <input type="text" class="form-control" name="nc_region_fare" id="nc_region_fare" value="{{ old('nc_region_fare') }}" />
                              </div>
                          </div>
                          <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                              <div class="form-group">
                                  <label for="nc_region_fare">Operating State</label>
                                  <select name="operating_state" id="operting_state" class="form-control">
                                      <option value="">Please Select Operating State</option>
                                      @foreach($locations as $location)
                                          <option value="{{$location->id}}">{{$location->location}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                        <div class="row">
                            <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
                                <div class="form-group">
                                    <label for="self_drive">Enable Self Drive</label>
                                    <input type="checkbox"  name="self_drive" id="self_drive"  >
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="alert alert-primary" role="alert">
                        Upload the right dimension width=233px height=83px
                    </div>
                    <div class="file_image_form row">

                        <div class="col-md-6 col-sm-6 col-sm-6 col-xl-6">
                            <div class="form-group">
                                <label for="images">Add Images</label>
                                <input type="file" id="images" class="form-control image_file" name="images[]" multiple="multiple" required>
                            </div>
                        </div>

                        <div class="add_button">
                            <button id="buttonID"> <img src="{{asset('images/icons/upload.png')}}"  width="20" height="20" /> </button><br>
                            <span class="add_more_images_text">Add More Images</span>
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
                        <textarea class="ckeditor form-control" name="description" id="description" rows="10" cols="20" value="{{ old('description') }}" required> </textarea>
                    </div>
                    <button class="sumbit_request btn btn-success" type="submit">Add Car</button>
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
                                    <input type="file" name="images[]"  required/>

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
