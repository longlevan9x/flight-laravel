@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h2>Log in to your account</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="form-login" role="form" action="#" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Email Address:</label>
                            <input type="email"  name="email" class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <span class="help-block">
                            <strong></strong>
                        </span>
                        <div class="text-right">
                            <button type="submit" id="btnLogin" class="btn btn-primary">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#btnLogin').click(function () {
            if ($('#form-login').serializeArray().length > 1) {
                $('#form-login').submit(function (event) {
                    event.preventDefault();
                });
                var login = $.ajax({
                    url : "{{url('api/v1/login')}}",
                    type :  'post',
                    data : $('#form-login').serializeArray()
                });

                login.done(function (result) {
                    if(result.message === 'fail') {
                        let html = "";
                        $.each(result.result, function (index, item) {
                            html += '<strong>' + item + '</strong><br>';
                        });
                        $('.help-block').html(html);
                        return false;
                    }
                    else {
                        setSession(result.result);
                    }
                });

                login.fail(function (error) {
                    alert(error.responseJSON.error);
                });

                function setSession(result) {

                    result._token = '{{csrf_token()}}';
                    let ajx = $.ajax({
                        url : '{{url('set-session')}}',
                        type : 'post',
                        data : result
                    });

                    ajx.done(function (result) {
                        if(result.message === 'ok') {
                            window.location.href = "{{url('home')}}";
                        }
                        else {
                            alert(result.text);
                        }
                    });
                    ajx.fail(function (error) {
                        console.log(error);
                    });
                }
            }
        });
    });
</script>
@endsection
