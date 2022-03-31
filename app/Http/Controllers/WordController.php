<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function word(){
        $allwords = Word::all();
        $word = null;
        return view('word',['words'=>$allwords,'editword'=>$word]);
    }
    public function addword(Request $request){
        $newword = new Word();
        $newword->word_no = $request->word;
        $newword->save();
        return redirect()->route('word');
    }
    public function destroyword($id){
        $word = Word::find($id);
        $word->delete();
        return redirect()->route('word');
    }
    public function editword($id){
        $word = Word::find($id);
        $allwords = Word::all();
        return view('word',['words'=>$allwords,'editword'=>$word]);
    }
    public function eword(Request $request,$id){
        $newword = Word::find($id);
        $newword->word_no = $request->word;
        $newword->save();
        return redirect()->route('word');
    }
}
