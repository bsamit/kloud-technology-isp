@props([
    'label' => 'DataTable',
    'column' => 12,
])
<div class="container-fluid">
    <div class="row">
        <div class="col-xxl-{{$column}} col-sm-{{$column}}">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h4>{{$label}}</h4><span>
                </div>
                <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
