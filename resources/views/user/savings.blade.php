<!-- Saving Goals -->
<div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Saving Goals</h2>
                <a href="/user/savings" class="link">View All</a>
            </div>
            <div class="goals">
                @foreach($savings as $save)
                    <!-- item -->
                    <div class="item">
                        <div class="in">
                            <div>
                                <h4>{{ ucfirst($save->name) }}</h4>
                                <p>{{ ucfirst($save->description) }}</p>
                            </div>
                            <div class="price">$ {{ number_format($save->target, 2, '.', ',') }}</div>
                        </div>
                        <div class="progress text-center">
                            <div class="progress-bar text-center" role="progressbar" style="width: {{ number_format($save->saved/($save->target/100))  }}%;" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100">{{ number_format($save->saved/($save->target/100), 2)  }}%</div>
                        </div>
                    </div>
                    <!-- * item -->
                @endforeach
            </div>
        </div>
        <!-- * Saving Goals -->