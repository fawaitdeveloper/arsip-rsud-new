<div class="card mb-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#disposisi"
                            type="button" role="tab" aria-controls="disposisi" aria-selected="true">Disposisi <i
                                class='bx bx-reply-all'></i></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="disposisi" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        @include('dashboard.letter-out.components.disposisi')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
