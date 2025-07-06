@extends('front.layouts.app')
@push('title', __('Payment'))
@section('content')
<!-- Stripe Modal -->
<div class="modal fade" id="stripeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="stripeModalLAbel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="stripe_modal_title" class="modal-title" id="stripeModalLAbel">
                    {{config('app.currency_symbol')}}{{ money($total) }} {{ __('Payment') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display a payment form -->
                <form id="payment-form">
                    <div id="payment-element">
                        <!--Stripe.js injects the Payment Element-->
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid col-6 mx-auto mt-3">
                        <button class="btn btn-primary" id="submit">
                            <span id="spinner" class="spinner d-none spinner-grow spinner-grow-sm" role="status"
                                aria-hidden="true"></span>

                            <span id="button-text">
                                {{__('Pay')}} {{config('app.currency_symbol')}}{{ money($total) }}
                            </span>
                        </button>
                    </div>

                    <div id="payment-message" class="hidden"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe_modal = new bootstrap.Modal(document.getElementById('stripeModal'));
        stripe_modal.show()
        const stripeModal = document.getElementById('stripeModal')
        stripeModal.addEventListener('hidden.bs.modal', event => {
            window.location.href = history.back(); //previous page
        })

</script>
<script>
    // This is your test publishable API key.
        const stripe = Stripe(
            "{{Cache::get('stripe_api_key')}}", {
                locale: "{{ app()->getLocale() }}",
            });

        // The items the customer wants to buy
        const items = [{
            id: "{{ $order_id }}",
        }];

        let elements;

        initialize();
        checkStatus();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
        async function initialize() {
            const {
                clientSecret
            } = await fetch("{{ route('stripe.callback') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    items
                }),
            }).then((r) => r.json());

            elements = stripe.elements({
                clientSecret
            });

            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "{{ route('stripe.callback.ok') }}",
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        // Fetches the payment intent status after payment submission
        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const {
                paymentIntent
            } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("d-none");
                document.querySelector("#button-text").classList.add("d-none");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("d-none");
                document.querySelector("#button-text").classList.remove("d-none");
            }
        }
</script>
@endpush
