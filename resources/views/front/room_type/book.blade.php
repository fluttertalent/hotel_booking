@extends('layouts.front')

@section('content')

    <!--TOP SECTION-->
   
    <!--END HOTEL ROOMS-->
    <!--CHECK AVAILABILITY FORM-->
    <div class="check-available">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inn-com-form">
                        {!! Form::open(array('url' => 'room_type_book/'.$ids, 'class' => 'col s12')) !!}
                        {{ Form::hidden('_method', 'POST') }}
                        @csrf
                        @if ($errors->any())
                            <div class="row" style="margin-top:50px">
                                <div class="col-md-12 alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                            <div style="margin-top:50px" class="row">
                                <div class="col s12 avail-title">
                                    <h4>Check Availability</h4>
                                    <p>The final price is calculated by dates and prices of suites </p>
                                </div>
                            </div>
                        <input name="booking_validation" type="hidden" value="0">

                        <div class="row">
                                <div class="input-field col s12 m4 l2">
                                    <input type="text" style="color: black" value="{{config('app.currency').$totalPrice }}" class="form-btn" disabled>
                                </div>
                                <div class="input-field col s12 m4 l2">
                                    <input type="text" id="from" name="arrival_date" value="{{date('Y/m/d', strtotime($arrival_date))}}" readonly>
                                    <label for="from">Arrival Date</label>
                                </div>
                                <div class="input-field col s12 m4 l2">
                                    <input type="text" id="to" name="departure_date" value="{{date('Y/m/d', strtotime($departure_date))}}" readonly>
                                    <label for="to">Departure Date</label>
                                </div>
                                <div class="input-field col s12 m4 l2">
                                    <input type="submit" value="submit" class="form-btn">
                                </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END CHECK AVAILABILITY FORM-->
    <div class="hom-com">
        <div class="container">
            <div class="row">              
                
                    <!--=========================================-->
                    <div class="hp-call hp-right-com">
                        <div class="hp-call-in"> <img src="{{ asset("front/images/icon/dbc4.png") }}" alt="">
                            <h3><span>Call us!</span> {{ config('app.phone_number') }}</h3> <small>We are available 24/7 Monday to Sunday</small> <a href="#">Call Now</a> </div>
                    </div>
                    <!--=========================================-->
                    <!--=========================================-->
                    <div class="hp-book hp-right-com">
                        <div class="hp-book-in">
                            <a href="" id="bookmark_button" class="like-button"><i class="fa fa-heart-o"></i> Bookmark this listing</a> <!--<span>159 people bookmarked this place</span>-->
                            <ul>
                                <li><a href="https://www.facebook.com/sharer.php?u={{ Request::url() }}" rel="me" title="Facebook" target="_blank"><i class="fa fa-facebook"></i> Share</a>
                                </li>
                                </li>
                                <li><a href="https://plus.google.com/share?url={{ Request::url() }}" rel="me" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i> Share</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--=========================================-->
                    <!--=========================================-->
                    <div class="hp-card hp-right-com">
                        <div class="hp-card-in">
                            <h3>We Accept</h3> <img src="{{ asset("front/images/card.png") }}" alt=""> </div>
                    </div>
                    <!--=========================================-->
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        $(function() {
            $('#bookmark_button').click(function() {
                if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
                    window.sidebar.addPanel(document.title, window.location.href, '');
                } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
                    window.external.AddFavorite(location.href, document.title);
                } else if (window.opera && window.print) { // Opera Hotlist
                    this.title = document.title;
                    return true;
                } else { // webkit - safari/chrome
                    alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
                }
            });
        });
    </script>

    @endsection
