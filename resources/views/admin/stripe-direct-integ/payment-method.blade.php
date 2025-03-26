@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Stripe Direct Integration Payment Method</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 " style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                <form action="{{route('admin.direct.payment-method.post')}}" method="post" id="form">
                    @csrf
                    {{-- <input id="card-holder-name" type="text"> --}}

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element"></div>
                    <input type="hidden" name="payment_method" id="payment_method">
                    <button id="card-button" class="btn btn-primary mt-3" type="button" {{-- data-secret="{{ $intent->client_secret }}" --}}>
                        Process Payment
                    </button>
                </form>
            </div>



        </div>


    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // intialize stripe
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // handle payment
        const cardButton = document.getElementById('card-button');
        cardButton.addEventListener('click', async (e) => {
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', cardElement
            );

            if (error) {
                alert('Error');
                console.log(error);
            } else {
                alert('Success');
                console.log(paymentMethod);
                document.getElementById('payment_method').value = paymentMethod.id;
                document.getElementById('form').submit();
            }
        });
    </script>
@endsection
