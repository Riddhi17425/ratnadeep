<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function edit()
    {
        // Hamesha pehla (aur sirf) record laao, ya khali object bana do agar record hi nahi hai
        $setting = Setting::first() ?? new Setting();

        return view('admin.settings.edit', compact('setting'));
    }

    private function rules()
    {
        return [
            'address'      => 'nullable|string',
            'contacts'     => 'nullable|array',
            'contacts.*'   => 'nullable|string|max:20',
            'emails'       => 'nullable|array',
            'emails.*'     => 'nullable|email|max:255',
            'facebook'     => 'nullable|url|max:255',
            'linkedin'     => 'nullable|url|max:255',
            'instagram'    => 'nullable|url|max:255',
        ];
    }

    private function prepareRepeaterField(Request $request, $field)
    {
        $values = $request->input($field, []);

        return array_values(array_filter($values, function ($value) {
            return !empty(trim($value));
        }));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $data['contacts'] = $this->prepareRepeaterField($request, 'contacts');
        $data['emails']   = $this->prepareRepeaterField($request, 'emails');

        // Agar record already hai to update karo, warna naya bana do
        $setting = Setting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route('settings.edit')
            ->with('toast_success', 'Settings updated successfully.');
    }
}