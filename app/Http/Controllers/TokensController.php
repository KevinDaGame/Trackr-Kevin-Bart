<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TokensController extends Controller
{
    public function index() {
        if(!Auth::user()->hasRole('webshop')){
            abort(401);
        }

        return view('webshop.tokens', [
            'tokens' => Auth::user()->tokens()->get()
        ]);
    }

    public function delete(Request $request){
        $user = Auth::user();
        if(!Auth::user()->hasRole('webshop')){
            abort(401);
        }

        $tokens = $request->dl;
        foreach ($tokens as $token){
            $user->tokens()->where('id', $token)->delete();
        }

        return redirect('/webshop/tokens')->with('success', 'The selected tokens have been deleted!');
    }

    public function create(Request $request){
        request()->validate([
            'tokenName' => 'required'
            ]);
        if(!Auth::user()->hasRole('webshop')){
            abort(401);
        }
        $token = Auth::user()->createToken($request->tokenName, ['package:create', 'package:update'])->plainTextToken;
        return redirect('/webshop/tokens')->with('success', 'The token has been created!')->with('token', $token);
    }
}
