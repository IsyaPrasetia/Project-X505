<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Webinar;

class WebinarController extends Controller
{
    public function show($id)
    {
        $webinar = Webinar::findOrFail($id);
        $contacts = ContactSetting::pluck('value', 'key')->toArray();

        return view('webinar.show', compact('webinar', 'contacts'));
    }
}
