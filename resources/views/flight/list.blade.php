@extends('index')
@section('content')
    <div class="container">
        <section>
            <h2>UAE - Abu Dhabi (AUH) <i class="glyphicon glyphicon-arrow-right"></i> Indonesia - Jakarta (CGK)</h2>
            @foreach(Session::get('flightList') as $key => $value)
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong><a href="flight-detail.html">Qatar Airways</a></strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time">18:45</big></div>
                                            <div><span class="place">Jakarta (CGK)</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time">02:55</big></div>
                                            <div><span class="place">Abu Dhabi (AUH)</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time">11h 10m</big></div>
                                            <div><strong class="text-danger">1 Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>IDR8.265.550,00</strong></h3>
                                            <div>
                                                <a href="flight-detail.html" class="btn btn-link">See Detail</a>
                                                <a href="flight-book.html" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">&lsaquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">&rsaquo;</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </section>
    </div>
@endsection