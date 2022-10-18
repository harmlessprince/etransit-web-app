@extends('Eticket.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Bus Import/ Export with Excel File</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="button-box" >
            <a href="{{url('/e-ticket/export/vehicle')}}" class="btn btn-success btn-sm"  style="margin-right:10px;">Download Excel File</a>&nbsp;
        </div>
        <div class="card ">
            <div class="card-body">
                <div id="app">
                    <excel-upload></excel-upload>
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
