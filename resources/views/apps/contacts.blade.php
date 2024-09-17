@extends('apps.app', [
    'title' => 'Contacts',
    'headerRoute' => 'contacts.index',
])

@section('app')
   <div class="bg-tint py-3">
      <div class="col-12 text-center">
         <h1 class="ff-catamaran my-1 my-md-2">
            < <span class="typed"></span> >
         </h1>
         <p class="ff-catamaran">Never lose your contacts</p>
      </div>
      <div class="col-12">
         <div class="d-flex justify-content-center">
            <div class="p-2 bg-tint-light rounded m-1">Over {{ $contacts->count() }} contacts</div>
            <div class="p-2 bg-tint-light rounded m-1">Over {{ count($numbers) }} numbers</div>
         </div>
         <div class="d-flex justify-content-center">
            <button class="p-2 rounded m-1 shadow btn btn-outline-primary bg-gradient ff-catamaran" type="button"
               data-bs-toggle="modal" data-bs-target="#addFaqModal">
               Add a contact
            </button>
            <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="form-group row">
                           <div class="col-4 mb-3">
                              <input type="text" class="form-control" id="c_name"
                                 placeholder="{{ __('Contact name') }}" required>
                           </div>
                           <div class="col-8 mb-3">
                              <input type="text" class="form-control" id="f_name"
                                 placeholder="{{ __('Full name or Recognition') }}" required>
                           </div>
                           <div class="col-md-3 mb-3">
                              <input type="number" class="form-control" id="priority" step="1" min="1"
                                 placeholder="{{ __('Priority') }}">
                           </div>
                           <div class="col-5 mb-3">
                              <input type="email" class="form-control" id="email" placeholder="{{ __('Email') }}">
                           </div>
                           <div class="row col-12 mb-3 input-group" id="numbers">
                              <label for="number" class="mb-1">Number(s)</label>
                              <div class="col-4 mb-2">
                                 <input type="text" class="form-control number" id="number" name="number" required
                                    placeholder="01xxxxxxxxx">
                              </div>
                              <div class="col-2 mb-2">
                                 <select class="custom-select form-control avb">
                                    <option value="1">On</option>
                                    <option value="0">Unavailable</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <button onclick="addMore()" class="btn btn-info">+</button>
                     </div>
                     <div class="modal-footer">
                        <button type="button" onclick="addContact(this)" class="btn btn-primary">Save</button>
                     </div>
                  </div>
               </div>
            </div>
            <a class="p-2 rounded m-1 shadow btn btn-outline-success bg-gradient ff-catamaran"
               href="{{ route('contacts.download') }}" target="_blank">
               Download contacts
            </a>
         </div>
      </div>
   </div>
   <div class="container my-4">
      <table id="data" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>Name</th>
               <th>Full name</th>
               <th>Number(s)</th>
               <th>Priority</th>
               <th>Email</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($contacts as $c)
               <tr>
                  <td class="ff-maven">{{ $c->name }}</td>
                  <td class="ff-merriweather">
                     {{ $c->f_name }}
                     <a class="badge bg-secondary text-white" href="{{ route('contacts.edit', $c->id) }}" title="Edit"><i
                           class="fas fa-edit"></i></a>
                  </td>
                  <td>
                     <ul class="list-group ff-source-code">
                        @foreach ($c->contactItems as $item)
                           <li class="list-group-item d-flex justify-content-between align-items-center">
                              {{ $item->number }}
                              <span class="badge bg-{{ $item->av ? 'success' : 'danger' }} rounded-pill">
                                 @if ($item->av)
                                    <i class="fas fa-check"></i>
                                 @else
                                    <i class="fas fa-times"></i>
                                 @endif
                              </span>
                           </li>
                        @endforeach
                     </ul>
                  </td>
                  <td>{{ $c->priority }}</td>
                  <td>{{ $c->email }}</td>
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
            strings: ['List of contacts'],
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
