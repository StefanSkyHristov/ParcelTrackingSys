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
            <input class="StripeElement mb-3" id="card-holder-name" type="text" placeholder="Card holder name" required>

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>

            <div class="form-group mt-3">
                <button id="card-button" class="btn btn-primary">
                    Checkout @convert($parcel->price*100)
                </button>
            </div>
        </form>
    </div>

    @endsection
</x-admin-master>

@section('styles')
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

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
