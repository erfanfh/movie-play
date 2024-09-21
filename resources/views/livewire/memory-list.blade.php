<div class="row">
    <div class="col-12 mb-3 mb-lg-5">
        <div class="position-relative card table-nowrap table-card">
            <div class="card-header align-items-center">
                <h5 class="mb-0">History</h5>
                <p class="mb-0 small text-muted">Match played</p>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="small text-uppercase bg-body text-muted">
                    <tr>
                        <th>#</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memories as $key => $memory)
                        <tr class="align-middle">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $memory->score }}</td>
                            <td>{{ $memory->created_at->format('m/d/Y') }}</td>
                            <td>{{ $memory->created_at->format('H:m:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($memories->hasMorePages())
                <div x-intersect.full="$wire.loadMore()" class="p-4 d-flex justify-content-center">
                    <div wire:loading wire:target="loadMore"
                         class="loading-indicator">
                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
