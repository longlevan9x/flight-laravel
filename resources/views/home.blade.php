@extends('index')

@section('content')
<div class="container">
    <br>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#flight-tab">Flight Booking</a></li>
    </ul>
    <div class="tab-content">
        <div id="flight-tab" class="tab-pane fade in active">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" id="form-search" action="#" method="post">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="form-heading">1. Flight Destination</h4>
                                <div class="form-group">
                                    <label class="control-label">From: </label>
                                    <input type="search" name="from_city_name" required placeholder="Abu Dhabi (UEA)" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">To: </label>
                                    <input type="search" name="to_city_name" required placeholder="Indonesia - Jakarta (CGK)" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4 class="form-heading">2. Date of Flight</h4>
                                <div class="form-group">
                                    <label class="control-label">Departure: </label>
                                    <input type="date" name="from_date" class="form-control" placeholder="Choose Departure Date">
                                </div>
                                <div class="form-group">
                                    <div class="radio">
                                        <label><input type="radio" name="flight_type" class="flight_type" checked value="one-way">One Way</label>
                                        <label><input type="radio" name="flight_type" class="flight_type" value="return">Return</label>
                                    </div>
                                </div>
                                <div class="form-group hide return">
                                    <label class="control-label">Return: </label>
                                    <input type="date" name="return_date" class="form-control" placeholder="Choose Return Date">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4 class="form-heading">3. Search Flights</h4>
                                <div class="form-group">
                                    <label class="control-label">Total Person: </label>
                                    <select class="form-control" name="total_person">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Flight Class: </label>
                                    <select class="form-control" name="flight_class">
                                        <option value="economy">Economy</option>
                                        <option value="business">Business</option>
                                        <option value="premium-economy">Premium Economy</option>
                                    </select>
                                </div>
                                <input type="hidden" name="api_token" value="{{Session::get('token')}}">
                                <div class="form-group">
                                    <button type="submit" id="btnSearch" class="btn btn-primary btn-block">Search Flights</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.flight_type').click(function () {
            if ($('input[name="flight_type"]:checked').val() === 'one-way') {
                $('.return').addClass('hide');
            }
            else {
                $('.return').removeClass('hide');
            }
        });

         $('#btnSearch').click(function () {
             $('#form-search').submit(function () {
                 event.preventDefault();
             });
             let data = $('#form-search').serializeArray();
             let ajx = $.ajax({
                 url : '{{'api/v1/flight-book/search-flight'}}',
                 type : 'post',
                 data : data
             });

             ajx.done(function (result) {
                 window.location.replace('{{url('flight/list')}}');
                 // console.log(result);
             });
             ajx.fail(function (error) {
                 window.replace('{{url('flight/list')}}');
                 // console.log(error);
             });
         });
    });
</script>
@endsection
