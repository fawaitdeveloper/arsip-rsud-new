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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#balas"
                            type="button" role="tab" aria-controls="balas" aria-selected="false">Balas <i
                                class='bx bx-reply'></i></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="disposisi" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        @include('dashboard.letter-in.components.disposisi')
                    </div>
                    <div class="tab-pane fade" id="balas" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        @include('dashboard.letter-in.components.balas')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
