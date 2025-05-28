<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclam;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ReclamController extends Controller
{
    // Ֆորմա ցույց տալ
    public function create()
    {
        return view('admin.reclamform');
    }

    // Պահպանել գովազդ
    public function store(Request $request)
    {
        $request->validate([
            'href' => 'required|url',
            'page' => 'required|in:index,interview,news,single',
            'position' => 'required|in:top,bottom,right_top,right_bottom,bottom_large',
            'img' => 'required|image|max:5120', // 5MB
        ]);

        $dimensions = $this->getDimensions($request->page, $request->position);

        $image = $request->file('img');

        // Ստեղծում ենք Intervention Image օբյեկտ
        $img = Image::make($image->getRealPath());

        // Վերակազմավորում չափսերը, եթե անհրաժեշտ է
        $img->resize($dimensions['width'], $dimensions['height'], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $folder = 'reclam/' . $request->page;

        $filename = time() . '_' . $image->getClientOriginalName();

        // Պահպանում storage/app/public/reclams/{page}/
        Storage::put('public/' . $folder . '/' . $filename, (string) $img->encode());

        $reclam = new Reclam();
        $reclam->href = $request->href;
        $reclam->page = $request->page;
        $reclam->position = $request->position;
        $reclam->image = $folder . '/' . $filename;
        $reclam->save();

        return redirect()->back()->with('success', 'Գովազդը հաջողությամբ ավելացվեց։');
    }

    // Վերադարձնում է չափսերը ըստ էջի և դիրքի
    private function getDimensions($page, $position)
    {
        if ($page === 'index') {
            return ['width' => 1312, 'height' => 371];
        }

        if ($page === 'single') {
            if ($position === 'bottom_large') {
                return ['width' => 1312, 'height' => 371];
            }
            if (in_array($position, ['right_top', 'right_bottom'])) {
                return ['width' => 313, 'height' => 516];
            }
        }

        if (in_array($page, ['interview', 'news'])) {
            if (in_array($position, ['top', 'bottom'])) {
                return ['width' => 313, 'height' => 516];
            }
        }

        // Եթե ոչ մի պայման չի բավարարվում՝ կանոնավոր չափս
        return ['width' => 313, 'height' => 516];
    }
}
