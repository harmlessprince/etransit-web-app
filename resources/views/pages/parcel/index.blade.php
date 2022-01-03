@extends('layouts.app')
<style>

.parcel_box{
    display:grid;
    grid-template-columns: repeat(12 , 1fr);
}
.parcel_info_box{
    grid-column: 1/7;
    /*background: #f5f7f9;*/
    padding:50px;
    margin-left: 80px;
    margin-top: 30px;
}
.parcel_item_box{
    grid-column: 8/12;
}
.pick_up_box{
    display: grid;
    grid-template-columns: 1fr 1fr ;
    grid-gap: 40px;
}
input {
 border:none !important;
 border-bottom: 1px solid grey !important;
}
label{
    color: #828282;
}
</style>
@section('content')
    <div class="parcel_box">
     <div class="parcel_info_box">
         <div >
             <h3>Pickup</h3>
             <div class="pick_up_box">
                 <div class="form-group">
                     <label>Pickup Location</label>
                     <input type="text" class="form-control"/>
                 </div>
                 <div class="form-group">
                     <label>Pickup Location</label>
                     <input type="text" class="form-control"/>
                 </div>
             </div>
             <div class="pick_up_box">
                 <div class="form-group">
                     <label>Pickup Location</label>
                     <input type="text" class="form-control"/>
                 </div>
                 <div class="form-group">
                     <label>Pickup Location</label>
                     <input type="text" class="form-control"/>
                 </div>
             </div>
         </div>
         <div >
             <h3>Drop Off</h3>
             <div class="pick_up_box">
                 <div class="form-group">
                     <label>PICKUP LOCATION</label>
                     <input type="text" class="form-control"/>
                 </div>
                 <div class="form-group">
                     <label>SENDERS NAME</label>
                     <input type="text" class="form-control"/>
                 </div>
             </div>
             <div class="pick_up_box">
                 <div class="form-group">
                     <label>DROPOFF LOCATION</label>
                     <input type="text" class="form-control"/>
                 </div>
                 <div class="form-group">
                     <label>RECEIVERS NAMEn</label>
                     <input type="text" class="form-control"/>
                 </div>
             </div>
         </div>
     </div>
        <div class="parcel_item_box">
            <h5>What will you be sending ? </h5>
        </div>
    </div>
@endsection
