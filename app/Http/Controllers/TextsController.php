<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextsController extends Controller
{
    public function edit($id){
        $text = \App\Text::findOrFail($id);
        $data = compact('text');
        return view('m.texts.edit', $data);
    }
    public function update($id, Request $request){
        $text = \App\Text::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $text->update($request->all());
        return redirect()->route('events.index');
    }
}
