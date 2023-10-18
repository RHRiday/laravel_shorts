<?php

namespace App\Http\Controllers;

use App\Models\Contact\Contact;
use App\Models\Contact\ContactItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apps.contacts', [
            'contacts' => Contact::all()->sortBy([
                ['priority', 'asc'],
                ['name', 'asc']
            ]),
            'numbers' => ContactItem::all(),
        ]);
    }

    /**
     * Download resource as pdf.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        // return view('apps.contacts_download', [
        //     'contacts' => Contact::all()->sortBy([
        //         ['name', 'asc']
        //     ])
        // ]);
        return Pdf::loadView('apps.contacts_download', [
            'contacts' => Contact::all()->sortBy([
                ['name', 'asc']
            ])
        ])->download('Contacts-' . date('dMY') . '.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $contact = Contact::create([
                'name' => $request->name,
                'f_name' => $request->f_name,
                'priority' => $request->priority ?? 4,
                'email' => $request->email,
            ]);
            $loop = 0;
            foreach ($request->numbers as $con) {
                if (!empty($con)) {
                    ContactItem::create([
                        'contact_id' => $contact->id,
                        'number' => $con,
                        'av' => $request->availability[$loop],
                    ]);
                }
                $loop++;
            }
        } catch (\Exception $ex) {
            return $ex;
        }

        return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('apps.contacts_edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $contact->update([
                'name' => $request->name,
                'f_name' => $request->f_name,
                'priority' => $request->priority ?? 4,
                'email' => $request->email,
            ]);
            $contact->contactItems()->delete();
            foreach ($request->number as $key => $con) {
                if (!empty($con)) {
                    ContactItem::create([
                        'contact_id' => $contact->id,
                        'number' => $con,
                        'av' => $request->avb[$key],
                    ]);
                }
            }
        } catch (\Exception $ex) {
            return $ex;
        }

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
