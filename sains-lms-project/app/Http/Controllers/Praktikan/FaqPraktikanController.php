<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqPraktikanController extends Controller
{

    public function index()
    {
        $faqs = Faq::where('status', true)->get();
        return view('dashboard.praktikan.faq.index', compact('faqs'));
    }


    public function store(Request $request)
    {
        $messages = [
            'question.required' => 'Pertanyaan wajib diisi',
        ];

        $validator = Validator::make($request->all(), [
            'question' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $data = [
            'question' => $request->question,
        ];

        Faq::create($data);
        
        return redirect()->route('faq-praktikan.index')->with('success', 'Pertanyaan Faq berhasil ditambahkan');
    }


}
