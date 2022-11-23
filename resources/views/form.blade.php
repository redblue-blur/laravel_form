<!doctype html>
<html lang="en">
  <head>
    <style>
        .pad{
            padding: 50px;
            border: 1px solid white;
        }
    </style>
    <title>{{$title}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
<style type="text/css">
    #otpdiv{
            display: none;
		}
    #resendtext{
            display: none;
        }
</style>
  <body>
        <h1>{{$title}}</h1>
        <form id="myform" action="{{ secure_url('/input') }}" method="post">
            @csrf
            <div class="container pad">
                <div class="form-group">
                    <div id="emaildiv">
                        <label for="">Enter email</label>
                        <input type="email" id="emailinput" class="form-control" name="emailcheck">
                        </br>
                        <input type="button" id="sendotp" class="btn btn-primary" value="confirm"/>
                    </div>
                    <div id="otpdiv">
                        <label for="">Enter OTP</label>
                        <input type="string" class="form-control" name="otpcheck"  aria-describedby="emailHelpId" placeholder="">
                        </br>
                        <!-- <input type="button" id="resendotp" class="btn btn-primary" value="Resend OTP"/> -->
                        <button class="btn btn-primary">Submit</button>
                        <!-- <br/><small id="resendtext">wait for 2 min</small> -->
                    </div>
                </div>
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ secure_asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ secure_asset('/js/additional-methods.min.js') }}"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $("#myform").validate({
                    ignore:[],
                    rules: {
                        emailcheck: {
                            required: true,
                            email: true,
                            remote: {
                                url: "{{secure_url('/email_validate')}}",
                                type: "post"
                                }
                        },
                        otpcheck: {
                            required: true,
                            number: true,
                            remote: {
                                url: "{{secure_url('/otp_validate')}}",
                                type: "post"
                                }
                        }
                    }
                });
                $("#sendotp").click(function(e) {
                    e.preventDefault();
                    console.log('button click');
                    $("#sendotp").hide();
                    $("#otpdiv").show();
                    $("#emailinput").attr("readonly", true);
                    // $.ajax({
                    //     method : 'POST',
                    //     crossDomain: true,
                    //     url: "{{secure_url('/otp_verify')}}",
                    //     data: {
                    //         'number' : $("#mobile_num").val()
                    //     },
                    //     success: function(data) {
                    //         $("#sendOTP").attr("disabled", true);
                    //     }
                    // });
                });
                // $('#resendotp').click(function(){
                //     var btn = $(this);
                //     btn.prop('disabled',true);
                //     $("#resendtext").show();
                //     window.setTimeout(function(){ 
                //         btn.prop('disabled',false);
                //         $("#resendtext").hide();
                //     },2000);
                // });
            });
        </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>