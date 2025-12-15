<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::all();
        return view('dashboard.admin.faq.index', compact('faqs'));
    }


    public function update(Request $request, string $id)
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

        $faq = Faq::findOrFail($id);

        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];

        $faq->update($data);

        return redirect()->route('faq.index')->with('success', 'Pertanyaan Faq berhasil dijawab');
    }

    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();
        return redirect()->route('faq.index')->with('success', 'Data FAQ berhasil dihapus');
    }

    public function addToListFaq(string $id)
    {
        $faq = Faq::findOrFail($id);
        $data = [
            'status' => true
        ];

        $faq->update($data);

        return redirect()->route('faq.index')->with('success', 'Pertanyaan Faq berhasil ditambahkan ke daftar');
    }

    public function deleteFromListFaq(string $id)
    {
        $faq = Faq::findOrFail($id);
        $data = [
            'status' => false
        ];

        $faq->update($data);

        return redirect()->route('faq.index')->with('success', 'Pertanyaan Faq berhasil dihapus dari daftar');
    }
}
