@extends('home')
@section('title')
    {{ @$editData ? 'Edit Custom Order' : 'Custom Order' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        @if (auth()->user()->role_id == 4)
                            <h4>{{ @$editData ? 'Edit' : 'Add' }} Custom Order</h4>
                        @else
                            <h4>Custom Order</h4>
                        @endif
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Custom Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @if (auth()->user()->role_id == 4)
                    <div class="col-xxl-3 col-sm-12">
                        <div class="card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                        @php
                                            $action  = @$editData ? route('custom-order.update',$editData->id) : route('custom-order.store');
                                        @endphp
                                        <form class="row g-3" action="{{ $action }}" method="POST">
                                            @csrf

                                            <x-common.text-area-field label="Order Details" :required="true" column=12
                                                name="details" placeholder="Enter Order Details" :value="@$editData->details" />

                                            <div class="col-12 mt-5 text-center">
                                                <button class="btn btn-primary" type="submit">Save Custom Order</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-sm-12">
                @else
                <div class="col-xxl-12 col-sm-12">
                @endif
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                            <h4>Custom Orders</h4><span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-9">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Details</th>
                                            <th>Remarks</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$order->details}}</td>
                                                <td>{{$order->remarks}}</td>
                                                <td>{{ucfirst($order->status)}}</td>
                                                {{-- <td>
                                                    <input class="tgl tgl-flip" id="cb5{{ $order->id }}" onchange="changeStatus('{{route('custom-order.change-status')}}', '{{ $order->id }}')" type="checkbox" {{ $order->status == 1 ? 'checked' : '' }}>
                                                    <label class="tgl-btn" data-tg-off="In Active" data-tg-on="Active" for="cb5{{ $order->id }}"></label>
                                                </td> --}}
                                                <td>
                                                    <ul class="action">
                                                        @if (auth()->user()->role_id == 4)
                                                            <li class="edit"> 
                                                                <a href="{{route('custom-order.edit',$order->id)}}">
                                                                    <i class="icon-pencil-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete"><a href="#" onclick="deleteModal('{{ route('custom-order.delete') }}', '{{ $order->id }}')"><i class="icon-trash"></i></a></li>
                                                        @elseif($order->status == 'pending')
                                                            <li class="delete"><a href="#" class="btn btn-success btn-xs" onclick="approveModal('{{ route('custom-order.approve') }}', '{{ $order->id }}')">Approve</a></li>
                                                            <li class="delete"><a href="#" class="btn btn-danger btn-xs" onclick="rejectModal('{{ route('custom-order.reject') }}', '{{ $order->id }}')">Reject</a></li>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </ul>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="exampleModalfullscreen-xl-{{$order->id}}" tabindex="-1" aria-labelledby="xlModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-fullscreen-xl-down">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="xlModalLabel">Full screen below xl</h1>
                                                      <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body dark-modal">
                                                      <div class="large-modal-header mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>
                                                        <h6>Web design </h6>
                                                      </div>
                                                      <p class="modal-padding-space">We build specialised websites for companies, list them on digital directories, and set up a sales funnel to boost ROI.</p>
                                                      <div class="modal-details">
                                                        <div class="web-content">
                                                          <h6>Wed designer</h6>
                                                          <div class="d-flex">
                                                            <div class="flex-shrink-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle svg-modal"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg></div>
                                                            <div class="flex-grow-1 ms-2">
                                                              <p>For a site to be successful, a designer must be able to communicate their ideas, chat with a firm about what they want, and inquire about the target audience.</p>
                                                            </div>
                                                          </div>
                                                          <div class="d-flex">
                                                            <div class="flex-shrink-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle svg-modal"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg></div>
                                                            <div class="flex-grow-1 ms-2">
                                                              <p>Most businesses employ a certain font or typography so that clients can quickly distinguish them from their rivals. Since designers now have access to a wider variety of fonts, firms may more easily and precisely communicate their brands through typography.</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="web-content">
                                                          <h6>UX designer </h6>
                                                          <div class="d-flex">
                                                            <div class="flex-shrink-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle svg-modal"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg></div>
                                                            <div class="flex-grow-1 ms-2">
                                                              <p>User research, persona creation, building wireframes and interactive prototypes, and testing ideas are among the common tasks of a UX designer. These duties can differ greatly between organizations.</p>
                                                            </div>
                                                          </div>
                                                          <div class="d-flex">
                                                            <div class="flex-shrink-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle svg-modal"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg></div>
                                                            <div class="flex-grow-1 ms-2">
                                                              <p>Keep in mind that you are creating solutions to particular challenges for a particular population living in a particular habitat. Always remember to correctly contextualise your thoughts and determine whether they are actually appropriate for the situation. It's sometimes necessary to concede that a digital solution is not the most appropriate choice in a certain circumstance.</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                      <button class="btn btn-primary" type="button">Save changes        </button>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let counter = $('.repeater-item').length;

            $('.add-more').click(function() {
                counter++;
                let repeaterItem = $('.repeater-item:first').clone();
                repeaterItem.find('input').val('');

                repeaterItem.find('input[name^="attributes"][name$="[name]"]')
                    .attr('name', 'attributes[' + counter + '][name]');
                repeaterItem.find('input[name^="attributes"][name$="[value]"]')
                    .attr('name', 'attributes[' + counter + '][value]');

                repeaterItem.find('label:contains("Attribute")').text('Attribute ' + counter);
                repeaterItem.find('label:contains("Value")').text('Value ' + counter);

                $('.repeater-container').append(repeaterItem);
            });

            $(document).on('click', '.remove-item', function() {
                if ($('.repeater-item').length > 1) {
                    $(this).closest('.repeater-item').remove();
                    reorderItems();
                }
            });

            function reorderItems() {
                $('.repeater-item').each(function(index) {
                    let newIndex = index + 1;
                    $(this).find('input[name^="attributes"][name$="[name]"]')
                        .attr('name', 'attributes[' + newIndex + '][name]');
                    $(this).find('input[name^="attributes"][name$="[value]"]')
                        .attr('name', 'attributes[' + newIndex + '][value]');
                    $(this).find('label:contains("Attribute")').text('Attribute ' + newIndex);
                    $(this).find('label:contains("Value")').text('Value ' + newIndex);
                });
                counter = $('.repeater-item').length;
            }
        });
    </script>
@endsection
