@extends('apps.app', [
    'title' => 'BankStatement',
    'headerRoute' => 'statements.index',
])

@section('app')

   <div class="bg-tint py-3">
      <div class="col-12 text-center">
         <h1 class="ff-catamaran my-1 my-md-2">
            < <span class="typed"></span> >
         </h1>
      </div>
      <div class="col-12">
         <div class="d-flex justify-content-center">
            <div class="p-2 bg-tint-light rounded m-1">Your current balance is:
               <span class="fw-bold">{{ $states->first()['total_amount'] ?? '0.00' }} Taka</span>
            </div>
         </div>
         <div class="d-flex justify-content-center">
            <a class="p-2 rounded m-1 shadow btn btn-outline-primary bg-gradient ff-catamaran"
               href="{{ route('statements.create') }}">
               Add a state
            </a>
            <a class="p-2 rounded m-1 shadow btn btn-info bg-gradient ff-catamaran text-white"
               href="{{ route('statements.compare') }}">
               Compare balance
            </a>
            {{-- <a class="p-2 rounded m-1 shadow btn btn-outline-success bg-gradient ff-catamaran"
               href="{{ route('contacts.download') }}" target="_blank">
               Download contacts
            </a> --}}
         </div>
      </div>
   </div>
   <div class="container my-4">
      <table id="data" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>Date</th>
               <th>Total Asset</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($states as $s)
               <tr>
                  <td class="ff-source-code">{{ $s['statement_date'] }}</td>
                  <td class="ff-source-code">{{ $s['total_amount'] }} Taka</td>
                  <td>
                     <button class="btn btn-sm badge btn-outline-secondary text-dark" type="button"data-bs-toggle="modal"
                        data-bs-target="#viewStmt-{{ $s['uniqId'] }}" title="View"><i class="fa fa-eye"></i></button>
                     <div class="modal fade" id="viewStmt-{{ $s['uniqId'] }}" tabindex="-1"
                        aria-labelledby="viewStmt-{{ $s['uniqId'] }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title"><span class="text-muted">Statement Date:
                                    </span>{{ $s['statement_date'] }}</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="row pb-2">
                                    @foreach ($s['items'] as $item)
                                       <div class="col-4 mb-1 border-bottom">
                                          {{ $item->reference }}
                                       </div>
                                       <div class="col-3 mb-1 text-end border-bottom">
                                          {{ $item->amount }}
                                       </div>
                                       <div class="col-5"></div>
                                    @endforeach
                                 </div>
                                 <div class="row mt-2 mb-1 fw-bold border-top border-dark">
                                    <div class="col-4 mb-1">
                                       Total
                                    </div>
                                    <div class="col-3 mb-1 text-end">
                                       {{ number_format($s['total_amount'], 2) }}
                                    </div>
                                    <div class="col"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
@endsection

@section('js')
   <script>
      $(document).ready(function() {
         var dt = $('#data').DataTable({
            "pageLength": 100,
            "order": []
         });
         // $('#data').wrap('<div class="dataTables_scroll" />');

         new Typed('.typed', {
            strings: ['Keep track of your bank balance'],
            typeSpeed: 100,
            loop: true,
            cursorChar: '',
         });
         hljs.highlightAll();
      });

      function addMore() {
         $("#numbers").append(`<div class="col-4 mb-2">
                                    <input type="text" class="form-control number" name="number"
                                        required placeholder="01xxxxxxxxx">
                                </div>
                                <div class="col-2 mb-2">
                                    <select class="custom-select form-control avb">
                                        <option value="1">On</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                </div>`);
      }
      document.addEventListener('DOMContentLoaded', (event) => {
         document.querySelectorAll('.code').forEach((block) => {
            hljs.highlightBlock(block);
         });
      });
   </script>
@endsection
