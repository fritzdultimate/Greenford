@include('admin.layouts.header')
@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('admin.actionsheet.edit-card')

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Transactions
        </div>
        
    </div>
    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2">
            <!-- card block -->
            @foreach($cards as $card)
                <div class="card-block mb-2 {{ $card->card_color }}">
                    <div class="card-main">
                        <div class="card-button dropdown">
                            <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal"></ion-icon>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" data-id="{{ $card->card_id }}" onclick="updateId(this)" data-bs-toggle="modal" data-bs-target="#editCardActionSheet">
                                    Edit
                                </a>
                            </div>
                        </div>
                        <div class="balance">
                            <span class="label">BALANCE</span>
                            <h1 class="title" style="font-size: 20px">{{ env('CURRENCY') }} {{ number_format($card->balance, 2, '.', ',')}}</h1>
                        </div>
                        <div class="in">
                            <div class="card-number">
                                <span class="label">Card Number</span>
                                <span id="visible-card-number-{{ $card->card_id }}">{{ $card->card_number }}</span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="bottom">
                                        <div class="card-expiry">
                                            <span class="label">Expiry</span>
                                            <small style="font-size: 10px">{{ date('m / y', strtotime($card->exp_date))}}</small>
                                        </div>
                                        <div class="card-ccv">
                                            <span class="label">CCV</span>
                                            <span id="visible-card-cvv-{{ $card->card_id }}">{{ $card->card_cvv }}</span>
                                        </div>
                                        <div class="card-ccv" style="margin-left: 35px;">
                                            <span class="label">TYPE</span>
                                            <span  style="font-style:itali; color: #bfbfaa">{{ $card->card_color == 'bg-info' ? 'Visa': 'Master' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inm">
                                <div class="card-numberp">
                                    <span style="font-weight: bold; color: rgb(221 221 221 / 68%);"> {{ ucfirst($card->user->fullname) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- * card block -->
        </div>

        

        @if($cards->count() == 0)
            <div class="flex justify-center content-center" style="display: flex; justify-content: center; height: 100%; align-items: center; flex-direction: column; font-size: 15px;">
                No card yet!
            </div>
        @endif


    </div>
    <!-- * App Capsule -->
    <script>
        let CardEditingId = null;

        function updateId(event) {
            CardEditingId = event.dataset.id;
            console.log(CardEditingId)
        }
    </script>

<script src="{{ asset('dash/js/fn.js') }}"></script>
<script src="{{ asset('dash/js/edit-card.js') }}"></script>
@include('admin.layouts.footer')