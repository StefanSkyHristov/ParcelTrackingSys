<x-admin-master>
    @section('title', 'Delivery Checkout')
    @section('content')

    <div class="row mx-2">
        @if (Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    </div>
    <div class="row">
        <form action="{{route('payment.checkout')}}" method="POST" id="stripe" class="card-form">
            @csrf
            <input type="hidden" name="parcel" id="parcel" value="{{$parcel}}">
            <input type="hidden" name="payment_method" class="payment-method" value="">
            <input id="card-holder-name" type="text">

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>

            <button id="card-button">
                Process Payment
            </button>
        </form>
    </div>

    @endsection
</x-admin-master>

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()

    let card = elements.create('card')
    card.mount('#card-element')
    let paymentMethod = null
    $('.card-form').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {name: $('.card-holder-name').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-form').submit()
            }
        })
        return false
    })
</script>
