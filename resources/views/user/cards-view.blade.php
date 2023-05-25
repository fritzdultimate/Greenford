@include('user.dialogbox.error-modal')
@include('user.dialogbox.success-modal')
@include('user.dialogbox.iconed-button-inline')
@include('user.layouts.header')

<!-- App Header -->
<div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            My Cards
        </div>
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#addCardActionSheet">
                <ion-icon name="add-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    @include('user.actionsheet.add-card-action-sheet')

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
                                <a class="dropdown-item" href="#" data-id="{{ $card->card_id }}" onclick="toggleVisibility(this)" id="CardActionBtn-{{ $card->card_id }}">
                                    Show
                                </a>
                                <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" onclick="deleteCardPan(this)" data-id="{{ $card->card_id }}">
                                    <ion-icon name="close-outline"></ion-icon>Delete
                                </a>
                            </div>
                        </div>
                        <div class="balance">
                            <span class="label">BALANCE</span>
                            <h1 class="title" style="font-size: 20px">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $card->balance)}}</h1>
                        </div>
                        <div class="in">
                            <div class="card-number">
                                <span class="label">Card Number</span>
                                <span id="hidden-card-number-{{ $card->card_id }}">•••• {{ substr($card->card_number, -4, 4) }}</span>
                                <span id="visible-card-number-{{ $card->card_id }}" style="display: none">{{ $card->card_number }}</span>
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
                                            <span id="hidden-card-cvv-{{ $card->card_id }}">***</span>
                                            <span id="visible-card-cvv-{{ $card->card_id }}" style="display: none">{{ $card->card_cvv }}</span>
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
            @if($cards->count() == 0)
            <div class="flex justify-center content-center" style="display: flex; justify-content: center; height: 100%; align-items: center; flex-direction: column; font-size: 18px;">
                You have not created any card yet!
            </div>
            @endif

        </div>


    </div>
    <!-- * App Capsule -->
@include('user.layouts.general-scripts')
<script src="{{ asset('dash/js/cards.js') }}"></script>
<script src="{{ asset('dash/js/delete-card.js') }}"></script>
@include('user.layouts.footer')
<script>
    IconedButtonInlineHeader.innerHTML = "Are you sure you want to delete this card?"
    IconedButtonInlineMessage.innerHTML = "This card will be deleted permanently.";
    function toggleVisibility(event) {
        let action = event.text.trim();
        let id = event.dataset.id;

        if(document.getElementById('CardActionBtn-' + id).text.trim() == 'Show') {
            document.getElementById('CardActionBtn-' + id).innerHTML = 'Hide';
            document.getElementById('hidden-card-number-' + id).style.display = 'none';
            document.getElementById('visible-card-number-' + id).style.display = 'block';

            // toggle cvv
            document.getElementById('hidden-card-cvv-' + id).style.display = 'none';
            document.getElementById('visible-card-cvv-' + id).style.display = 'block';
        } else if(document.getElementById('CardActionBtn-' + id).text.trim() == 'Hide') {
            document.getElementById('hidden-card-number-' + id).style.display = 'block';
            document.getElementById('visible-card-number-' + id).style.display = 'none';
            document.getElementById('CardActionBtn-' + id).innerHTML = 'Show';

            // toggle cvv
            document.getElementById('hidden-card-cvv-' + id).style.display = 'block';
            document.getElementById('visible-card-cvv-' + id).style.display = 'none';
        }
    }

    function deleteCardPan(event) {
        cardId = event.dataset.id;
    }
</script>