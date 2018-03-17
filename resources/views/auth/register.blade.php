@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h2>Join as a Wordskills Travel Member</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" method="post" id="form-register" action="{{url('register')}}">
                        {{ csrf_field() }}
                        <span class="help-block1">
                            <strong></strong>
                        </span>
                        <div class="form-group">
                            <label class="control-label">Username:</label>
                            <input type="text" name="username" required class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Address:</label>
                            <input type="email" name="email" required class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password:</label>
                            <input type="password" name="password" required class="form-control" minlength="6" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password Confirm:</label>
                            <input type="password" name="password_confirmation" required minlength="6" class="form-control" placeholder="Enter your password confirm">
                        </div>
                        <span class="help-block">
                            <strong></strong>
                        </span>
                        <div class="text-right">
                            <button type="submit" id="btnRegister" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
       $('#btnRegister').click(function () {
           if ($('#form-register').serializeArray().length > 1) {
               $('#form-register').submit(function (event) {
                   event.preventDefault();
               });
               var register = $.ajax({
                   url : "{{url('api/v1/register')}}",
                   type :  'post',
                   data : $('#form-register').serializeArray()
               });

               register.done(function (result) {
                   if(result.message === 'fail') {
                       let html = "";
                       $.each(result.result, function (index, item) {
                            html += '<strong>' + item + '</strong><br>';
                       });
                       $('.help-block').html(html);
                       return false;
                   }
                   else {
                       $('.help-block1 strong').text("Đăng ký thành công");
                       $('.help-block').html('');
                   }
               });

               register.fail(function (error) {
                   alert(error);
               });
           }
       });
    });
</script>
@endsection
