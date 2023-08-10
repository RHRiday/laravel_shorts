@extends('apps.attendance')

@section('content')
   {{-- @dd($student) --}}
   <h2 class="text-center">Attendance data</h2>
   <div class="row">
      <div class="col-9 col-md-6 col-lg-4 mx-auto">
         <table class="table">
            <thead>
               <th class="th">Name of the student: </th>
               <td>
                  {{ $student->first()->name }}
               </td>
            </thead>
            <tr>
               <th class="th">Started: </th>
               <td>
                  {{ Carbon::parse($student->first()->att_date)->format('d-m-Y') }}
               </td>
            </tr>
            <tr>
               <th class="th">Total attendance:</th>
               <td>
                  {{ $student->count() }}
               </td>
            </tr>
            <tr>
               <th class="th">Payment count:</th>
               <td>
                  {{ $student->where('payment', 'ok')->count() }}
               </td>
            </tr>
            <tr>
               <th class="th" rowspan="{{ $student->count() }}">Payment Dates:</th>
               <td>
                  <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#payDates">Show</button>
                  <div class="modal fade" id="payDates" tabindex="-1" aria-labelledby="deleteAttLabelpayDates"
                     aria-hidden="true">
                     <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteAttLabelpayDates">Payment dates</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <table class="table table-bordered">
                                 @foreach ($student->where('payment', 'ok') as $entry)
                                    <tr>
                                       <td class="fw-bold">
                                          #{{ $loop->index + 1 }}
                                       </td>
                                       <td class="text-center">
                                          {{ Carbon::parse($entry->att_date)->format('d-m-Y') }}
                                       </td>
                                    </tr>
                                 @endforeach
                              </table>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </td>
            </tr>
         </table>
      </div>
   </div>
   <div class="my-3">
      <h1 class="text-center">{{ $student->first()->name }}'s Attendance sheet</h1>
      <div class="container">
         <table class="table">
            <tr>
               <th scope="col">Name of the Student</th>
               <th scope="col">Attendance</th>
               <th scope="col">Action</th>
            </tr>

            @foreach ($student as $att)
               <tr>
                  <td>{{ $att->name }}</td>
                  <td>
                     {{ Carbon::parse($att->att_date)->format('d/m/Y') . ' (' . Carbon::parse($att->att_date)->englishDayOfWeek . ')' }}
                  </td>
                  <td>
                     <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#entry_{{ $att->id }}">Delete</button>
                     <div class="modal fade" id="entry_{{ $att->id }}" tabindex="-1"
                        aria-labelledby="deleteAttLabelentry_{{ $att->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h1 class="modal-title fs-5" id="deleteAttLabelentry_{{ $att->id }}">Delete entry?
                                 </h1>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <p>{{ $att->name . ' on ' . Carbon::parse($att->att_date)->format('d/m/Y') }}</p>
                                 <form action="{{ route('attendances.destroy', $att->id) }}" method="post"
                                    class="row g-3">
                                    @csrf
                                    <div class="col-auto">
                                       <input type="text" class="form-control" name="validation"
                                          placeholder="Your identity?" required>
                                    </div>
                                    <div class="col-auto">
                                       <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                 </form>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </td>
               </tr>
            @endforeach
         </table>
         <hr>
         <button type="button" class="btn btn-dark" onclick="window.history.back()"><i class="fas fa-reply"></i>
            Back</button>
      </div>
   </div>
@endsection
