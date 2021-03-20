<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <title>Twilio Call</title>
    <style>
        form {
            background-color: #fff;
            width: 1000px;
            float: center;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="mt-5">
    <div class="card m-auto pl-3" style="width: 36rem;">
        <form class="mt-4" style="width: 34rem;" method="post" action="{{ route('initiate_call') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group row col-12">
                <div class="form-group col-12">
                    <label for="phoneNumber">Phone number</label>
                    <input type="text" style="width: 30rem;" class="form-control" name="phone_number" id="phoneNumber" value="+251913089916" aria-describedby="phoneHelp"  required>
                    <small id="phoneHelp" class="form-text text-muted">Phone number should match<code>[+][country code][phone number including area code]</code></small>
                </div>
                <button type="submit" style="margin-right: 20rem" class="btn btn-primary ml-3">Call</button>
                <button type="submit" class="mr-2 btn btn-primary" formaction="{{route('initiate_message')}}">Message</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    @if(session('success P'))
        callSuccess();
    @elseif(session('error P'))
            callFail();
    @elseif(session('success M'))
            messageSuccess();
    @elseif(session('error M'))
            messageFail();
    @endif

    function messageSuccess(){
        swalAlert({icon: 'success', text: 'Message sent successfully!', tittle: 'Success'})
    }
    function messageFail(){
        swalAlert({icon: 'error', text: 'Message failed!', tittle: 'Error'})
    }
    function callSuccess(){
        swalAlert({icon: 'success', text: 'Successfully Called Your Phone!', tittle: 'Success'})
    }
    function callFail(){
        swalAlert({icon: 'error', text: 'Phone Call Failed!', tittle: 'Error'})
    }
    function swalAlert({icon, tittle, text}) {
        swal({
            title: tittle,
            text: text,
            icon: icon,
            confirmButtonText: 'Cool'
        });
    }
</script>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

