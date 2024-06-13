@if ($flow->access == 'RF')
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalforward">Teruskan</a></li>
@elseif($flow->access == 'RFT')
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalalihkan">Alihkan</a></li>
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalreceive">Terima</a></li>
@elseif($flow->access == 'RT')
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalreceive">Terima</a></li>
@endif
