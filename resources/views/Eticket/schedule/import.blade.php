@extends('Eticket.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

     .file-upload{
         height:400px;
         width: 100%;
         border: 1px dotted #DC6513;;
         border-radius: 20px;
     }


    .image-button{
        display:flex;
        justify-content: center;
        margin-top: 100px;

    }
    .progress-bar-container{
        display:flex;
        justify-content: center;
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
                        <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Event Schedule Import/ Export with Excel File</li>
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
                {{--                    <!-- Bookmark Ends-->--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="button-box" >
            <a href="{{url('/e-ticket/export/schedule')}}" class="btn btn-success btn-sm"  style="margin-right:10px;">Download Excel File</a>&nbsp;
        </div>
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
        <div class="card ">
            <div class="card-body">
                <div id="app">
{{--                    <bus-schedules-upload></bus-schedules-upload>--}}
                    <div class="file-upload">
                        <form action="{{url('e-ticket/import/e-ticket/schedule')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" >
                                <div class="image-button">
                                    <img :src="'/assets/images/file/file.png'"   alt="image"  onclick="chooseFile();"  />
                                </div>
                                <input name="excel_file" type="file" class="form-control" v-on:change="onImageChange" ref="excel_file" id="fileInput" hidden >
                                <br/>
                                <div class="progress-bar-container">
{{--                                    <progress max="100" :value.prop="uploadPercentage"></progress>--}}
                                    <br>
                                </div>
                                <div style="display: flex;justify-content: center;" >
                                    <button class="btn btn-sm btn-success btn-submit"  @click="uploadImage"  >Click To Upload File</button>
                                </div >
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function chooseFile() {
            $("#fileInput").click();
        }
    </script>
@endsection
