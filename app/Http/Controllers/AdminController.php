<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Speaker;
use App\Models\Testimonial;
use App\Models\Webinar;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $sortDate = request()->query('sort_date', 'desc');
        $sortDate = in_array($sortDate, ['asc', 'desc']) ? $sortDate : 'desc';
        $webinars = Webinar::orderBy('date', $sortDate)->get();
        $speakers = Speaker::orderBy('date', 'desc')->orderBy('created_at', 'desc')->get();
        $testimonials = Testimonial::orderBy('date', 'desc')->orderBy('created_at', 'desc')->get();
        $contacts = ContactSetting::pluck('value', 'key')->toArray();

        return view('admin.dashboard', compact('webinars', 'speakers', 'testimonials', 'contacts', 'sortDate'));
    }

    // ─── WEBINAR ───────────────────────────────────

    public function storeWebinar(Request $request)
    {
        $data = $request->validate([
            'tag' => 'nullable|string|max:255',
            'title' => 'required|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:255',
            'register_link' => 'nullable|string|max:255',
            'lms_link' => 'nullable|string|max:255',
            'register_closed' => 'boolean',
            'price' => 'nullable|string|max:255',
            'price2' => 'nullable|string|max:255',
            'professions' => 'nullable|string|max:100000',
            'platform' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'skp' => 'nullable|string|max:255',
            'admin_left_name' => 'nullable|string|max:255',
            'admin_left_link' => 'nullable|string|max:255',
            'admin_right_name' => 'nullable|string|max:255',
            'admin_right_link' => 'nullable|string|max:255',
            'health_channel_text' => 'nullable|string',
            'health_channel_link' => 'nullable|string|max:255',
            'health_channel_btn_text' => 'nullable|string|max:255',
            'wa_message' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_no' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'flyer' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data['register_closed'] = $request->boolean('register_closed');
        $data['is_active'] = true;

        $data['professions'] = strip_tags($request->input('professions', ''), '<b><strong><br><p><div><span><i><em><u>');

        $disk = env('FILESYSTEM_DISK', 'public');
        \Log::info('storeWebinar: disk='.$disk.', files='.json_encode(array_keys($request->allFiles())));

        try {
            if ($request->hasFile('bank_logo')) {
                $file = $request->file('bank_logo');
                \Log::info('storeWebinar: bank_logo name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                $data['bank_logo'] = $file->store('banks', $disk);
                \Log::info('storeWebinar: bank_logo stored as '.($data['bank_logo'] ?? 'NULL'));
            }

            if ($request->hasFile('flyer')) {
                $file = $request->file('flyer');
                \Log::info('storeWebinar: flyer name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                $data['flyer'] = $file->store('flyers', $disk);
                \Log::info('storeWebinar: flyer stored as '.($data['flyer'] ?? 'NULL'));
            }
        } catch (\Throwable $e) {
            \Log::warning('S3 store failed (bank_logo/flyer): '.$e->getMessage());
        }

        $speakers = [];
        for ($i = 1; $i <= 3; $i++) {
            $name = $request->input("speaker_name_$i");
            if ($name) {
                $speaker = [
                    'name' => $name,
                    'role' => $request->input("speaker_role_$i", ''),
                    'country' => $request->input("speaker_country_$i", ''),
                    'focal' => $request->input("speaker_focal_$i", '50% 30%'),
                ];
                if ($request->hasFile("speaker_avatar_$i")) {
                    try {
                        $file = $request->file("speaker_avatar_$i");
                        \Log::info('storeWebinar: speaker_avatar_'.$i.' name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                        $speaker['avatar'] = $file->store('speakers', $disk);
                        \Log::info('storeWebinar: speaker_avatar_'.$i.' stored as '.($speaker['avatar'] ?? 'NULL'));
                    } catch (\Throwable $e) {
                        \Log::warning('S3 store failed (speaker_avatar_'.$i.'): '.$e->getMessage());
                    }
                }
                $speakers[] = $speaker;
            }
        }
        $data['speakers'] = $speakers;

        Webinar::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Webinar baru berhasil ditambahkan.');
    }

    public function updateWebinar(Request $request, Webinar $webinar)
    {
        $data = $request->validate([
            'tag' => 'nullable|string|max:255',
            'title' => 'required|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:255',
            'register_link' => 'nullable|string|max:255',
            'lms_link' => 'nullable|string|max:255',
            'register_closed' => 'boolean',
            'price' => 'nullable|string|max:255',
            'price2' => 'nullable|string|max:255',
            'professions' => 'nullable|string|max:100000',
            'platform' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'skp' => 'nullable|string|max:255',
            'admin_left_name' => 'nullable|string|max:255',
            'admin_left_link' => 'nullable|string|max:255',
            'admin_right_name' => 'nullable|string|max:255',
            'admin_right_link' => 'nullable|string|max:255',
            'health_channel_text' => 'nullable|string',
            'health_channel_link' => 'nullable|string|max:255',
            'health_channel_btn_text' => 'nullable|string|max:255',
            'wa_message' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_no' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'flyer' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'speaker_avatar_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data['register_closed'] = $request->boolean('register_closed');

        $data['professions'] = strip_tags($request->input('professions', ''), '<b><strong><br><p><div><span><i><em><u>');

        $disk = env('FILESYSTEM_DISK', 'public');
        \Log::info('updateWebinar: disk='.$disk.', files='.json_encode(array_keys($request->allFiles())));

        try {
            if ($request->hasFile('bank_logo')) {
                $file = $request->file('bank_logo');
                \Log::info('updateWebinar: bank_logo name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                $data['bank_logo'] = $file->store('banks', $disk);
                \Log::info('updateWebinar: bank_logo stored as '.($data['bank_logo'] ?? 'NULL'));
            }

            if ($request->hasFile('flyer')) {
                $file = $request->file('flyer');
                \Log::info('updateWebinar: flyer name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                $data['flyer'] = $file->store('flyers', $disk);
                \Log::info('updateWebinar: flyer stored as '.($data['flyer'] ?? 'NULL'));
            }
        } catch (\Throwable $e) {
            \Log::warning('S3 store failed (update bank_logo/flyer): '.$e->getMessage());
        }

        $existingSpeakers = $webinar->speakers ?? [];
        $speakers = [];
        for ($i = 1; $i <= 3; $i++) {
            $name = $request->input("speaker_name_$i");
            if ($name) {
                $speaker = [
                    'name' => $name,
                    'role' => $request->input("speaker_role_$i", ''),
                    'country' => $request->input("speaker_country_$i", ''),
                    'focal' => $request->input("speaker_focal_$i", '50% 30%'),
                ];
                if ($request->hasFile("speaker_avatar_$i")) {
                    try {
                        $file = $request->file("speaker_avatar_$i");
                        \Log::info('updateWebinar: speaker_avatar_'.$i.' name='.$file->getClientOriginalName().' size='.$file->getSize().' valid='.($file->isValid() ? 'yes' : 'no'));
                        $speaker['avatar'] = $file->store('speakers', $disk);
                        \Log::info('updateWebinar: speaker_avatar_'.$i.' stored as '.($speaker['avatar'] ?? 'NULL'));
                    } catch (\Throwable $e) {
                        \Log::warning('S3 store failed (update speaker_avatar_'.$i.'): '.$e->getMessage());
                    }
                } elseif (isset($existingSpeakers[$i - 1]['avatar'])) {
                    $speaker['avatar'] = $existingSpeakers[$i - 1]['avatar'];
                } else {
                    $speaker['avatar'] = '';
                }
                $speakers[] = $speaker;
            }
        }
        $data['speakers'] = $speakers;

        $webinar->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Webinar berhasil diperbarui.');
    }

    public function destroyWebinar(Webinar $webinar)
    {
        $webinar->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Webinar berhasil dihapus.');
    }

    // ─── SPEAKER ────────────────────────────────────

    public function storeSpeaker(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'inst' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'date' => 'nullable|date',
        ]);

        $data['sort_order'] = Speaker::max('sort_order') + 1;
        Speaker::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Pembicara berhasil ditambahkan.');
    }

    public function updateSpeaker(Request $request, Speaker $speaker)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'inst' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'date' => 'nullable|date',
        ]);

        $speaker->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Pembicara berhasil diperbarui.');
    }

    public function destroySpeaker(Speaker $speaker)
    {
        $speaker->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Pembicara berhasil dihapus.');
    }

    // ─── TESTIMONIAL ────────────────────────────────

    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'stars' => 'nullable|string|max:50',
            'gender' => 'nullable|string|in:male,female',
            'date' => 'nullable|date',
        ]);

        $data['sort_order'] = Testimonial::max('sort_order') + 1;
        Testimonial::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'stars' => 'nullable|string|max:50',
            'gender' => 'nullable|string|in:male,female',
            'date' => 'nullable|date',
        ]);

        $testimonial->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Testimoni berhasil dihapus.');
    }

    // ─── CONTACT SETTINGS ──────────────────────────

    public function updateContact(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:5000',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'maps_embed' => 'nullable|string|max:10000',
            'whatsapp' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        foreach (['address', 'phone', 'email', 'maps_embed', 'whatsapp', 'instagram', 'youtube'] as $key) {
            $value = $request->input($key, '');

            if ($key === 'maps_embed') {
                $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $value);
                $value = preg_replace('/\s+on\w+\s*=\s*"[^"]*"/i', '', $value);
                $value = preg_replace("/\s+on\w+\s*=\s*'[^']*'/i", '', $value);
                $value = preg_replace('/\s+on\w+\s*=\s*[^\s>]+/i', '', $value);
            }

            ContactSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.dashboard')->with('success', 'Pengaturan kontak berhasil diperbarui.');
    }
}
