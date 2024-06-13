@if (count($replies) > 0)
    <div class="card mb-5">
        <div class="card-header">
            Data Balasan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <caption class="ms-4">
                                Data Balasan
                            </caption>
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Position</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($replies as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->position }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ date('d M Y', strtotime($item->created_at)) }}
                                            {{ date('h:i', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="card mb-5">
    <div class="card-header">
        History Naskah
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <caption class="ms-4">
                            Data History Naskah
                        </caption>
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Deskripsi</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ date('d M Y', strtotime($item->created_at)) }}
                                        {{ date('h:i', strtotime($item->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
