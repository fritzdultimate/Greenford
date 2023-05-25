<!-- my cards -->
<div class="section full mt-4">
    <div class="section-heading padding">
        <h2 class="title">My Cards</h2>
        <a href="/user/cards" class="link">View All</a>
    </div>

    <!-- carousel single -->
    <div class="carousel-single splide">
        <div class="splide__track">
            <ul class="splide__list">

            @foreach($cards as $card)
                <li class="splide__slide">
                    <!-- card block -->
                    <div class="card-block mb-2 {{ $card->card_color }}">
                        <div class="card-main">
                            <div class="card-button dropdown">
                                <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item CardActionBtn-{{ $card->card_id }}" href="#" data-id="{{ $card->card_id }}" onclick="toggleVisibility(this)" id="CardActionBtn-{{ $card->card_id }}">
                                        Show
                                    </a>
                                    <a class="dropdown-item" data-bs-target="#DialogIconedButtonInline" href="#" data-bs-toggle="modal" onclick="deleteCardPan(this)" data-id="{{ $card->card_id }}">
                                        <ion-icon name="close-outline"></ion-icon>Delete
                                    </a>
                                </div>
                            </div>
                            <div class="balance">
                                <span class="label">BALANCE</span>
                                <h1 class="title">{{ get_currency_symbol($user_settings->currency) }} {{ currency_conversion($user_settings->currency, $card->balance) }}</h1>
                            </div>
                            <div class="in">
                                <div class="card-number">
                                    <span class="label">Card Number</span>
                                    <span class="hidden-card-number-{{ $card->card_id }}">•••• {{ substr($card->card_number, -4, 4) }}</span>
                                    <span class="visible-card-number-{{ $card->card_id }}" style="display: none">{{ $card->card_number }}</span>
                                </div>
                                <div class="bottom">
                                    <div class="card-expiry">
                                        <span class="label">Expiry</span>
                                        <small style="font-size: 10px">{{ date('m / y', strtotime($card->exp_date))}}</small>
                                    </div>
                                    <div class="card-ccv">
                                        <span class="label">CCV</span>
                                        <span class="hidden-card-cvv-{{ $card->card_id }}">***</span>
                                        <span class="visible-card-cvv-{{ $card->card_id }}" style="display: none">{{ $card->card_cvv }}</span>
                                    </div>
                                    <div class="card-ccv" style="margin-left: 35px;">
                                        <span class="label">TYPE</span>
                                        <span  style="font-style:itali; color: #bfbfaa">{{ $card->card_color == 'bg-info' ? 'Visa': 'Master' }}</span>
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
                    <!-- * card block -->
                
                </li>
            @endforeach

            </ul>
        </div>
    </div>
    <!-- * carousel single -->

</div>
<!-- * my cards -->
<script src="{{ asset('dash/js/delete-card.js') }}"></script>
<script>
    IconedButtonInlineHeader.innerHTML = "Are you sure you want to delete this card?"
    IconedButtonInlineMessage.innerHTML = "This card will be deleted permanently.";
    function toggleVisibility(event) {
        let action = event.text.trim();
        let id = event.dataset.id;

        if(document.getElementById('CardActionBtn-' + id).text.trim() == 'Show') {
            [...document.querySelectorAll('.CardActionBtn-' + id)].forEach((e) => {
                e.innerHTML = 'Hide'
            });
            [...document.querySelectorAll('.hidden-card-number-' + id)].forEach((e) => {
                e.style.display = 'none';
            });
            [...document.querySelectorAll('.visible-card-number-' + id)].forEach((e) => {
                e.style.display = 'block';
            });


            // toggle cvv
            [...document.querySelectorAll('.hidden-card-cvv-' + id)].forEach((e) => {
                e.style.display = 'none';
            });
            [...document.querySelectorAll('.visible-card-cvv-' + id)].forEach((e) => {
                e.style.display = 'block';
            });
        } else if(document.getElementById('CardActionBtn-' + id).text.trim() == 'Hide') {
            [...document.querySelectorAll('.hidden-card-number-' + id)].forEach((e) => {
                e.style.display = 'block';
            });
            [...document.querySelectorAll('.visible-card-number-' + id)].forEach((e) => {
                e.style.display = 'none';
            });
            [...document.querySelectorAll('.CardActionBtn-' + id)].forEach((e) => {
                e.innerHTML = 'Show'
            });

            // toggle cvv
            [...document.querySelectorAll('.hidden-card-cvv-' + id)].forEach((e) => {
                e.style.display = 'block';
            });
            [...document.querySelectorAll('.visible-card-cvv-' + id)].forEach((e) => {
                e.style.display = 'none';
            });
        }
    }

    function deleteCardPan(event) {
        cardId = event.dataset.id;
    }
</script>