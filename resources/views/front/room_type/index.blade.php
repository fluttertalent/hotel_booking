@extends('layouts.front')

@section('content')
    <div class="inn-body-section pad-bot-55">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>Room Types</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>All available hotel rooms and suites are listed below</p>   
                    <div class="inn-com-form">
                        <form>
                            <div class="input-field">
                                <input type="text" id="from" name="arrival_date" value="{{ date('Y/m/d') }}">
                                <label for="from">Arrival Date</label>
                            </div>
                            <div class="input-field">
                                <input type="text" id="to" name="departure_date" value="{{ date('Y/m/d') }}">
                                <label for="to">Departure Date</label>
                            </div>    
                        </form>  
                    </div>           
                </div>
            @forelse($room_types as $room_type)
                <!--ROOM SECTION-->
                <div class="room">
                    @if($room_type->cost_per_day !== $room_type->discountedPrice)
                    <div class="ribbon ribbon-top-left"><span>Discount</span>
                    </div>
                    @endif
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="{{'/storage/room_types/'.$room_type->images->first()->name}}" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>{{ $room_type->name }}</h4>
                        
                        <ul>
                            <li>Max Adult : {{ $room_type->max_adult }}</li>
                            <li>Max Child : {{ $room_type->max_child }}</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            @foreach($room_type->facilities as $facility)
                                <li>{{ $facility->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p>
                            <span class="room-price-1">{{ config('app.currency').$room_type->discountedPrice}}</span>
                            @if($room_type->cost_per_day !== $room_type->discountedPrice)
                            <span class="room-price">{{ config('app.currency').$room_type->cost_per_day }}</span>
                            @endif
                        </p>
                        <p>Non Refundable</p>                                              
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <!-- <div class="r5 r-com"> <a href="{{url('/room_type/'.$room_type->id)}}" class="inn-room-book">Book</a> </div> -->
                    <div class="r5 r-com">                        
                        <input style="width: 50px; height: 50px; {{ $room_type->room_service ? '' : 'display:none' }}" type="checkbox"  name="{{$room_type->name}}" id="{{$room_type->id}}" value="{{$room_type->name}}" order="{{$room_type->order}}" available = "{{$room_type->room_service}}" />                      
                    </div>
                </div>
                <!--END ROOM SECTION-->
                @empty
                <!--ROOM SECTION-->
                    <div class="room">
                        </div>
                        <!--ROOM IMAGE-->
                        <div class="r1 r-com"><img src="{{ asset("front/images/room/1.jpg") }}" />
                        </div>
                        <!--ROOM RATING-->
                        <div class="r2 r-com">
                            <h4>Master Suite</h4>
                            <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  4.5 / 5</span> </div>
                            <ul>
                                <li>Max Adult : 3</li>
                                <li>Max Child : 1</li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <!--ROOM AMINITIES-->
                        <div class="r3 r-com">
                            <ul>
                                <li>Ironing facilities</li>
                                <li>Tea/Coffee maker</li>
                                <li>Air conditioning</li>
                                <li>Flat-screen TV</li>
                                <li>Wake-up service</li>
                            </ul>
                        </div>
                        <!--ROOM PRICE-->
                        <div class="r4 r-com">
                            <p>Price for 1 night</p>
                            <p><span class="room-price-1">5000</span> <span class="room-price">$: 7000</span>
                            </p>
                            <p>Non Refundable</p>
                        </div>
                        <!--ROOM BOOKING BUTTON-->
                        <div class="r5 r-com">
                            <div class="r2-available">Available</div>
                            <p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
                    </div>
                    <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <div class="ribbon ribbon-top-left"><span>Featured</span>
                    </div>
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/2.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Mini Suite</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  4.2 / 5</span> </div>
                        <ul>
                            <li>Max Adult : 2</li>
                            <li>Max Child : 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Ironing facilities</li>
                            <li>Tea/Coffee maker</li>
                            <li>Air conditioning</li>
                            <li>Flat-screen TV</li>
                            <li>Wake-up service</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p><span class="room-price-1">4000</span> <span class="room-price">$: 4500</span>
                        </p>
                        <p>Non Refundable</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Available</div>
                        <p>Price for 1 night</p> <a href="room-details.html" class="inn-room-book">Book</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Featured</span></div>
                    -->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/3.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Ultra Deluxe</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  3.9 / 5</span> </div>
                        <ul>
                            <li>Max Adult : 4</li>
                            <li>Max Child : 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Ironing facilities</li>
                            <li>Tea/Coffee maker</li>
                            <li>Air conditioning</li>
                            <li>Flat-screen TV</li>
                            <li>Wake-up service</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p><span class="room-price-1">3500</span> <span class="room-price">$: 4000</span>
                        </p>
                        <p>Non Refundable</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Available</div>
                        <p>Price for 1 night</p> <a href="room-details-1.html" class="inn-room-book">Book</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Best Room</span></div>-->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/4.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Luxury Room</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  4.0 / 5</span> </div>
                        <ul>
                            <li>Max Adult : 5</li>
                            <li>Max Child : 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Ironing facilities</li>
                            <li>Tea/Coffee maker</li>
                            <li>Air conditioning</li>
                            <li>Flat-screen TV</li>
                            <li>Wake-up service</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p><span class="room-price-1">3000</span> <span class="room-price">$: 3500</span>
                        </p>
                        <p>Non Refundable</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Available</div>
                        <p>Price for 1 night</p> <a href="room-details.html" class="inn-room-book">Book</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <div class="ribbon ribbon-top-left"><span>Special</span>
                    </div>
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/5.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Premium Room</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  4.5 / 5</span> </div>
                        <ul>
                            <li>Max Adult : 5</li>
                            <li>Max Child : 2</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Ironing facilities</li>
                            <li>Tea/Coffee maker</li>
                            <li>Air conditioning</li>
                            <li>Flat-screen TV</li>
                            <li>Wake-up service</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p><span class="room-price-1">4000</span> <span class="room-price">$: 5000</span>
                        </p>
                        <p>Non Refundable</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Available</div>
                        <p>Price for 1 night</p> <a href="room-details-block.html" class="inn-room-book">Book</a> </div>
                </div>
                <!--END ROOM SECTION-->
                <!--ROOM SECTION-->
                <div class="room">
                    <!--<div class="ribbon ribbon-top-left"><span>Featured</span></div>-->
                    <!--ROOM IMAGE-->
                    <div class="r1 r-com"><img src="images/room/6.jpg" alt="" />
                    </div>
                    <!--ROOM RATING-->
                    <div class="r2 r-com">
                        <h4>Normal Room</h4>
                        <div class="r2-ratt"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <img src="images/h-trip.png" alt="" /> <span>Excellent  3.5 / 5</span> </div>
                        <ul>
                            <li>Max Adult : 4</li>
                            <li>Max Child : 4</li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!--ROOM AMINITIES-->
                    <div class="r3 r-com">
                        <ul>
                            <li>Ironing facilities</li>
                            <li>Tea/Coffee maker</li>
                            <li>Air conditioning</li>
                            <li>Flat-screen TV</li>
                            <li>Wake-up service</li>
                        </ul>
                    </div>
                    <!--ROOM PRICE-->
                    <div class="r4 r-com">
                        <p>Price for 1 night</p>
                        <p><span class="room-price-1">2000</span> <span class="room-price">$: 2500</span>
                        </p>
                        <p>Non Refundable</p>
                    </div>
                    <!--ROOM BOOKING BUTTON-->
                    <div class="r5 r-com">
                        <div class="r2-available">Available</div>
                        <p>Price for 1 night</p> <a href="room-details.html" class="inn-room-book">Book</a></div>
                </div>
                <!--END ROOM SECTION-->
                @endforelse
                <div class="row"> <button  id="submit-button" style="text-align: center; justify-content: center; width:100%; margin: 0 auto; display: block" class="inn-room-book">Book</a></div>
            </div>            
        </div>
    <script>      
        $(document).ready(function(){
            var checkboxes = $('input[type="checkbox"]');
            var temp_checkboxes = checkboxes;
            var lowestOrder = Number.MAX_SAFE_INTEGER;
            var lowestCheckbox;

            // Find the checkbox with the lowest order value
            checkboxes.each(function() {
                var checkbox = $(this);
                var order = parseInt(checkbox.attr('order'));
                if (order < lowestOrder && parseInt(checkbox.attr('available')) == 1) {
                    lowestOrder = order;
                    lowestCheckbox = checkbox;
                }
            });          

            checkboxes.each(function() {
                var checkbox = $(this);                
                if (checkbox.attr('order') !== lowestCheckbox.attr('order')) {
                    console.log(checkbox);
                    $(checkbox).prop('disabled',true);
                    $(checkbox).prop('checked',false);
                }
            });

            checkboxes.click(function() {      
                var checkbox = $(this);
                temp_checkboxes.each(function() {           
                    var temp_checkbox = $(this);            
                    if(parseInt($(temp_checkbox).attr('order')) > parseInt(checkbox.attr('order'))){
                        console.log('checked', checkbox.prop('checked'));
                        if(parseInt($(temp_checkbox).attr('order')) == parseInt(checkbox.attr('order'))+1 && checkbox.prop('checked') == true){
                            $(temp_checkbox).prop('disabled', false);
                        }else{
                            $(temp_checkbox).prop('checked', false);
                            $(temp_checkbox).prop('disabled', true);                            
                        }                        
                    }
                });
            });
            
            $('#submit-button').on('click', function(event) {
                event.preventDefault();
                var fromValue = $("#from").val();
                var toValue = $("#to").val();

                fromValue = fromValue.replace(/\//g, "-");
                toValue = toValue.replace(/\//g, "-");
                // Set the request body (if needed)
                var ids = [];
                $('input[type="checkbox"]:checked').each(function() {
                    ids.push($(this).attr('id'));
                });
                if(ids.length == 0){
                    alert("You must select the package!");
                }
                else
                    window.location.href = "/roombook/" + ids + "/" + fromValue + "/" + toValue;
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    url: '/checkSuiteAvailability',
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        arrival_date: "{{date('Y/m/d')}}",
                        departure_date: "{{date('Y/m/d')}}",                    
                    },
                    success: function(response) {
                        console.log(response.ids);
                        // Handle the successful response here
                        var ids = response.ids;
                        var available_ids = response.available_ids;
                        ids.forEach(id =>{
                            if(available_ids.includes(id) && $('#'+id).attr('available') != '0')
                                $('#'+id).css('display', 'block');
                            else{
                                $('#'+id).css('display', 'none');
                                $('#'+id).attr('available', '-1');
                            }
                        });

                        var lowestCheckbox;
                        var lowestOrder = Number.MAX_SAFE_INTEGER;

                        checkboxes.each(function() {
                            var checkbox = $(this);
                            var order = parseInt(checkbox.attr('order'));
                            if (order < lowestOrder && parseInt(checkbox.attr('available')) == 1) {
                                lowestOrder = order;
                                lowestCheckbox = checkbox;
                            }
                            
                        });                    

                        lowestCheckbox.prop('disabled', false);

                        checkboxes.each(function() {
                            var checkbox = $(this);                
                            if (checkbox.attr('order') !== lowestCheckbox.attr('order')) {                                
                                $(checkbox).prop('disabled',true);
                                $(checkbox).prop('checked',false);
                            }
                        });
                    },
                    error: function(error) {
                        // Handle any errors here
                    }
                });

            // when change the arrival date and departure date
            $("#from").change(function(event) {               

                 // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var fromValue = $("#from").val();
                var toValue = $("#to").val();

                $.ajax({
                    url: '/checkSuiteAvailability',
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        arrival_date: fromValue,
                        departure_date: toValue,                    
                    },
                    success: function(response) {
                        console.log(response.ids);
                        // Handle the successful response here
                        var ids = response.ids;
                        var available_ids = response.available_ids;
                        ids.forEach(id =>{
                            if(available_ids.includes(id) && $('#'+id).attr('available') == '1')
                                $('#'+id).css('display', 'block');
                            else{
                                $('#'+id).css('display', 'none');
                                $('#'+id).attr('available', '0');
                            }
                        });

                        var lowestCheckbox;
                        var lowestOrder = Number.MAX_SAFE_INTEGER;

                        checkboxes.each(function() {
                            var checkbox = $(this);
                            var order = parseInt(checkbox.attr('order'));
                            if (order < lowestOrder && parseInt(checkbox.attr('available')) == 1) {
                                lowestOrder = order;
                                lowestCheckbox = checkbox;
                            }
                            
                        });                    

                        lowestCheckbox.prop('disabled', false);

                        checkboxes.each(function() {
                            var checkbox = $(this);                
                            if (checkbox.attr('order') !== lowestCheckbox.attr('order')) {                                
                                $(checkbox).prop('disabled',true);
                                $(checkbox).prop('checked',false);
                            }
                        });
                    },
                    error: function(error) {
                        // Handle any errors here
                    }
                });
            });
            
            $("#to").change(function(event) {
                // Your code here
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var fromValue = $("#from").val();
                var toValue = $("#to").val();

                $.ajax({
                    url: '/checkSuiteAvailability',
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        arrival_date: fromValue,
                        departure_date: toValue,                    
                    },
                    success: function(response) {
                        var ids = response.ids;
                        var available_ids = response.available_ids;
                        ids.forEach(id =>{
                            if(available_ids.includes(id) && $('#'+id).attr('available') == '1')
                                $('#'+id).css('display', 'block');
                            else
                                $('#'+id).css('display', 'none');
                        });
                        // Handle the successful response here
                        var lowestCheckbox;
                        var lowestOrder = Number.MAX_SAFE_INTEGER;

                        checkboxes.each(function() {
                            var checkbox = $(this);
                            var order = parseInt(checkbox.attr('order'));
                            if (order < lowestOrder && parseInt(checkbox.attr('available')) == 1) {
                                lowestOrder = order;
                                lowestCheckbox = checkbox;
                            }                            
                        });
                        
                        lowestCheckbox.prop('disabled', false);
                        
                        checkboxes.each(function() {
                            var checkbox = $(this);                
                            if (checkbox.attr('order') !== lowestCheckbox.attr('order')) {                                
                                $(checkbox).prop('disabled',true);
                                $(checkbox).prop('checked',false);
                            }
                        });
                    },
                    error: function(error) {
                        // Handle any errors here
                    }
                });

            });
             
        });
    </script>
@endsection
