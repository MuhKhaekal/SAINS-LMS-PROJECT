<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('dashboard.admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('faq.index')->with('success', 'Pertanyaan Faq berhasil dijawab');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
