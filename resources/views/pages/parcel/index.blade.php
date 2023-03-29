@extends('layouts.app')
<style>

.parcel_box{
    display:grid;
    grid-template-columns: repeat(12 , 1fr);
}

.parcel_info_box{
    grid-column: 1/7;
    padding:50px;
    margin-left: 80px;
    margin-top: 30px;
}

.parcel_item_box{
    grid-column: 7/12;
    margin-top: 30px;
    background: white;
    padding:50px;
}
.pick_up_box{
    display: grid;
    grid-template-columns: 1fr 1fr ;
    grid-gap: 40px;
}
input , select {
 border:none !important;
 border-bottom: 1px solid grey !important;
    outline: none !important;
}
label{
    color: #828282;
}
.document , .parcel{
    margin:10px;
    padding: 30px;
}
.document_parcel_box{
    display: flex;
    justify-content: space-around;
}
.document_box{
    background: rgba(219, 226, 241, 0.38);
    margin:10px;
    padding: 30px;
    border-radius: 10px;
}
#document_input{
    border-radius: 50%;
    width:20px;
    height:20px;
    background: white;

}
#parcel_input{
    border-radius: 50%;
    width:20px;
    height:20px;
    background: white;

}
.document_fill_box{
    display: flex;
    justify-content: flex-end;
}
.document_parcel_box h4{
    text-align: center;
}
.dimension_2{
    display:grid;
    grid-template-columns: repeat(3,1fr);
    grid-gap: 10px;
}

.buttonPay{
    display: grid;
    justify-content: center;
    grid-column: 1/12;
}
.doc_dimension{
    margin-left: 50px;
    margin-right:50px;
}
.doc_header{
    display: grid;
    justify-content: center;
}
.invalid-feedback {
    color: red;
}
.document_class{
    color:red;
}
@media (max-width: 800px) {
    .parcel_box {
        display: flex;
        flex-direction: column;
    }
}
@media (max-width: 600px) {
    .pick_up_box, .dimension_2 {
        display: flex;
        flex-direction: column;
    }
}
@media (max-width: 900px) {
    .document, .parcel {
        margin: 5px;
        padding: 15px;
    }
}
@media (max-width: 400px) {
    .document, .parcel {
        margin: 1px;
        padding: 1px;
    }
    .parcel_info_box {
        margin-left: 25px
    }
}


</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@section('content')
    <form action="{{url('send-parcel-info')}}" method="POST">
        @csrf
        <div class="parcel_box">
            <div class="parcel_info_box">
                <div >
                    <h4>Pickup</h4>
                    <div class="pick_up_box">
                        <div class="form-group">
                            <label for="pickup">PICK UP LOCATION ( STATE )</label>
                            <select class="form-control @error('state')is-invalid @enderror" id="pickup" name="state">
                                <option> Select a state </option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="senders_name">SENDERS NAME</label>
                            <input type="text" class="form-control @error('senders_name')is-invalid @enderror"  name="senders_name" id="senders_name" />
                            @if($errors->has('senders_name'))
                            <span class="invalid-feedback">
                                <strong >{{ $errors->first('senders_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div >
                        <div class="form-group">
                            <label for="pickup">PiICK UP LOCATION ( CITY )</label>
                            <select class="form-control @error('city')is-invalid @enderror" id="pickup" name="city">
                            </select>
                            @if($errors->has('city'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="pick_up_box">
                        <div class="form-group">
                            <label for="sender_contact">CONTACT NUMBER</label>
                            <input type="text" class="form-control @error('senders_phone_number')is-invalid @enderror" name="senders_phone_number" id="sender_contact"/>
                            @if($errors->has('senders_phone_number'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('senders_phone_number') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sender_landmark"> LANDMARK </label>
                            <input type="text" class="form-control @error('sender_landmark')is-invalid @enderror" name="sender_landmark" id="sender_landmark" />
                            @if($errors->has('sender_landmark'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('sender_landmark') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <BR><BR>
                <div >
                    <h4>Drop Off</h4>
                    <div class="pick_up_box">
                        <div class="form-group">
                            <label class="dropoff_location">DROPOFF LOCATION ( STATE )</label>
                            <select class="form-control  @error('delivery_state_id')is-invalid @enderror"  name="delivery_state_id" id="dropoff_location">
                                <option> Select a state </option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('delivery_state_id'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('delivery_state_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="receiver_name">RECEIVERS NAME</label>
                            <input type="text" class="form-control @error('receiver_name')is-invalid @enderror" name="receiver_name" id="receiver_name"/>
                            @if($errors->has('receiver_name'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('receiver_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div >
                        <div class="form-group">
                            <label for="pickup">DROP OFF LOCATION ( CITY )</label>
                            <select class="form-control  @error('delivery_city_id')is-invalid @enderror"  name="delivery_city_id" id="dropoff_location">
                            </select>
                            @if($errors->has('delivery_city_id'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('delivery_city_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="pick_up_box">
                        <div class="form-group">
                            <label for="receiver_contact">CONTACT NUMBER</label>
                            <input type="text" class="form-control @error('receiver_phone_number')is-invalid @enderror" name="receiver_phone_number" id="receiver_contact"/>
                            @if($errors->has('receiver_phone_number'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('receiver_phone_number') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="receiver_landmark">LANDMARK</label>
                            <input type="text" class="form-control  @error('receiver_landmark')is-invalid @enderror" id="receiver_landmark" name="receiver_landmark"/>
                            @if($errors->has('receiver_landmark'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('receiver_landmark') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="parcel_item_box">
                <div class="">
                    <div >
                       <div class="doc_header">
                           <h4>What will you be sending ? </h4>
                            <strong class="document_class">{{ $errors->first('document') }}</strong>
                       </div>
                        <div class="document_parcel_box">

                            <div class="document" onclick="changeDocumentInputBg('document_input')" >
                                <div class="document_box">
                                    <div class="document_fill_box">
                                        <div id="document_input"></div>
                                    </div>
                                    <div>
                                        <img src="{{asset('images/icons/document.png')}}"/>
                                        @if(count($parcel) > 0)
                                            <input type="hidden" name="document" id="document_id" value="{{$parcel[0]->id}}" disabled/>
                                        @endif
                                    </div>
                                </div>
                                <h4>Document</h4>
                            </div>

                            <div class="parcel" onclick="changeParcelInputBg('parcel_input')">
                                <div class="document_box">
                                    <div class="document_fill_box">
                                        <div id="parcel_input"></div>
                                    </div>
                                    <div>
                                        <img src="{{asset('images/icons/parcel.png')}}"/>
                                        @if(count($parcel) > 1)
                                            <input type="hidden" name="document" id="parcel_id" value="{{$parcel[1]->id}}" disabled/>
                                        @endif
                                    </div>
                                </div>
                                <h4>Parcel</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc_dimension">
                    <div class="form-group">
                        <label>ITEMS WEIGHT (KG)</label>
                        <input type="text" class="form-control  @error('item_weight')is-invalid @enderror" name="item_weight" placeholder="30" />
                        @if($errors->has('item_weight'))
                            <span class="invalid-feedback">
                                <strong >{{ $errors->first('item_weight') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="dimension_2">
                        <div class="form-group">
                            <label>HEIGHT (CM)</label>
                            <input type="text" class="form-control @error('item_height')is-invalid @enderror" name="item_height" placeholder="30" />
                            @if($errors->has('item_height'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('item_height') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>WIDTH (CM)</label>
                            <input type="text" class="form-control @error('item_width')is-invalid @enderror" name="item_width" placeholder="30" />
                            @if($errors->has('item_width'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('item_width') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>LENGTH (CM)</label>
                            <input type="text" class="form-control @error('item_length')is-invalid @enderror" name="item_length" placeholder="30" />
                            @if($errors->has('item_length'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('item_length') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>QUANTITY</label>
                        <input type="text" class="form-control @error('item_quantity')is-invalid @enderror" name="item_quantity" placeholder="30" />
                        @if($errors->has('item_quantity'))
                            <span class="invalid-feedback">
                                <strong >{{ $errors->first('item_quantity') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>NOTES</label>
                        <input type="text" name="notes" class="form-control @error('notes')is-invalid @enderror" />
                        @if($errors->has('notes'))
                            <span class="invalid-feedback">
                                <strong >{{ $errors->first('notes') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
    </div>

    <div class="buttonPay">
        <div class="payment_button">
             <button >PROCEED TO PAYMENT</button>
        </div>
    </div>
    </form>
        <script>
            function changeDocumentInputBg(i) {
                document.getElementById(i).style.background='#0B277F';
                document.getElementById('document_id').disabled = false;
                document.getElementById("parcel_input").style.background='white';
                document.getElementById('parcel_input').disabled = true;
            }

            function changeParcelInputBg(i){
                document.getElementById(i).style.background='#0B277F';
                document.getElementById("document_input").style.background='white';
                document.getElementById('parcel_id').disabled = false;
                document.getElementById('document_id').disabled = true;
            }


                $(document).ready(function() {
                    $('select[name="state"]').on('change', function() {
                        var stateID = $(this).val();
                        if(stateID) {
                            $.ajax({
                                url: '/pick-up-city/'+stateID,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $('select[name="city"]').empty();
                                    $.each(data, function(key, value) {
                                       // console.log(value)
                                        $('select[name="city"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                                    });

                                }
                            });
                        }else{
                            $('select[name="city"]').empty();
                        }
                    });
                });


            $(document).ready(function() {
                $('select[name="delivery_state_id"]').on('change', function() {
                    var stateID = $(this).val();
                    if(stateID) {
                        $.ajax({
                            url: '/pick-up-city/'+stateID,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                                $('select[name="delivery_city_id"]').empty();
                                $.each(data, function(key, value) {
                                    console.log(value)
                                    $('select[name="delivery_city_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                                });

                            }
                        });
                    }else{
                        $('select[name="city"]').empty();
                    }
                });
            });

        </script>

@endsection
