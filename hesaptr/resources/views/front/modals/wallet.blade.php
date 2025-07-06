@auth
    <!-- Balance Modal -->
    <div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center" id="balanceModalLabel">
                        {{ __('Your Wallet') }}
                        <span class="badge text-bg-secondary rounded-5 ms-3">
                            <span>
                                {{ config('app.currency_symbol') }}{{ money(Auth::user()->wallet) }}
                            </span>
                        </span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-inline-block" method="POST" action="{{ route('order.wallet.store') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cash-stack me-1" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                </svg>
                                {{ __('Amount') }}
                            </span>
                            <span class="input-group-text bg-white">
                                {{ config('app.currency_symbol') }}
                            </span>
                            <input type="number" class="form-control" name="amount" value="50">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="payment_method" aria-label="Default select example">
                                @if (Cache::get('paytr_active') == 1)
                                    <option value="paytr">
                                        {{ Cache::get('paytr_name') }}
                                        @if (Cache::get('paytr_extra_commission'))
                                            {{ ' +
                                                                            ' .
                                                Cache::get('paytr_extra_commission') .
                                                '%' .
                                                ' Commission' }}
                                        @endif
                                    </option>
                                @endif
                                @if (Cache::get('stripe_active') == 1)
                                    <option value="stripe">
                                        {{ Cache::get('stripe_name') }}
                                        @if (Cache::get('stripe_extra_commission'))
                                            {{ ' +
                                                                            ' .
                                                Cache::get('stripe_extra_commission') .
                                                '%' .
                                                ' Commission' }}
                                        @endif
                                    </option>
                                @endif
                                @if (Cache::get('shopier_active') == 1)
                                    <option value="shopier">
                                        {{ Cache::get('shopier_name') }}
                                        @if (Cache::get('shopier_extra_commission'))
                                            {{ ' +
                                                                            ' .
                                                Cache::get('shopier_extra_commission') .
                                                '%' .
                                                ' Commission' }}
                                        @endif
                                    </option>
                                @endif
                                @if (Cache::get('iban_active') == 1)
                                    <option value="iban">
                                        {{ Cache::get('iban_name') }}

                                    </option>
                                @endif
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cash-stack" viewBox="0 1 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                </svg>
                                {{ __('Add Money') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endauth
