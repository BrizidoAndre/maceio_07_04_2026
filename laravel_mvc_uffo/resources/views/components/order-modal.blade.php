@props([
    'model' => new \App\Models\Order(),
])
@php
    $canBeAltered = $model->status === 'Cancelled' || $model->status === 'Completed';
@endphp
<div class="card m-3 product-card card-model"
     data-bs-toggle="modal"
     data-bs-target="#modal-{{$model->getKey()}}"
     draggable="true" data-id="{{$model->getKey()}}">
    <h5 class="card-header">{{$model->user->username}}</h5>
    <div class="card-body">
        <ul class="list-group">
            @foreach($model->orderItems as $item)
                <li class="list-group-item d-flex"><span>{{$item->product->name}} (x{{$item->quantity}})</span> <span
                        class="ms-auto">${{$item->product->price}}</span></li>
            @endforeach
            @if($model->promocode)
                <li class="list-group-item d-flex bg-body-tertiary text-success">
                    <span>Promo code</span>
                    <span class="ms-auto">-${{$model->promocode->discount}}</span></li>
            @endif
            <li class="list-group-item d-flex"><span>Total:</span> <h4
                    class="card-text ms-auto">
                    ${{$model->total_amount}}</h4></li>
        </ul>
    </div>
</div>

<div class="modal fade modal-order" id="modal-{{$model->getKey()}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Total items</span>
                        <span class="badge bg-primary rounded-pill">{{count($model->orderItems)}}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($model->orderItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{asset('img/' . $item->product->photo)}}" style="object-fit: cover;"
                                         width="50"
                                         height="50">
                                    <div>
                                        <h6 class="my-0">{{$item->product->name}} (x{{$item->quantity}})</h6>
                                        <small class="text-body-secondary">{{$item->product->description}}</small>
                                    </div>
                                </div>
                                <span class="text-body-secondary">${{$item->product->price * $item->quantity}}</span>
                            </li>
                        @endforeach
                        @if($model->promocode)
                            <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                <div class="text-success">
                                    <h6 class="my-0">Promo code</h6>
                                    <small>{{$model->promocode->code}}</small>
                                </div>
                                <span class="text-success">−${{$model->promocode->discount}}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>${{$model->total_amount}}</strong>
                        </li>
                    </ul>
                </div>
                <x-form method="put" action="{{route('order.status', $model)}}" id="form-status-{{$model->getKey()}}">
                    <div class="d-flex justify-content-between">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="pending-{{$model->getKey()}}"
                                   value="Pending" @disabled($canBeAltered) @checked($model->status === 'Pending')>
                            <label class="form-check-label" for="pending-{{$model->getKey()}}">Pending</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status"
                                   id="progress-{{$model->getKey()}}"
                                   value="In Progress" @disabled($canBeAltered) @checked($model->status === 'In Progress')>
                            <label class="form-check-label" for="progress-{{$model->getKey()}}">In progress</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status"
                                   id="completed-{{$model->getKey()}}"
                                   value="Completed" @disabled($canBeAltered) @checked($model->status === 'Completed')>
                            <label class="form-check-label" for="completed-{{$model->getKey()}}">Completed</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status"
                                   id="cancelled-{{$model->getKey()}}"
                                   value="Cancelled" @disabled($canBeAltered) @checked($model->status === 'Cancelled')>
                            <label class="form-check-label" for="cancelled-{{$model->getKey()}}">Cancelled</label>
                        </div>
                    </div>
                </x-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="form-status-{{$model->getKey()}}" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalChoice"
                    @disabled($canBeAltered)
                >Save
                    changes
                </button>
            </div>
        </div>
    </div>
</div>
