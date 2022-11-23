<?php

namespace App\Http\Controllers;

use App\Models\MenuLangList;
use Illuminate\Http\Request;
use App\Models\MenusLang;


class LanguageController extends Controller
{

    public function index()
    {
        return view('dashboard.languages.index', ['langs' => MenuLangList::all()]);
    }


    public function create()
    {
        return view('dashboard.languages.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|min:1|max:64',
            'shortName'        => 'required|min:1|max:64',
            'is_default'       => 'required|in:true,false'
        ]);
        $menuLang = new MenuLangList();
        $menuLang->name         = $request->input('name');
        $menuLang->short_name   = $request->input('shortName');
        if($request->input('is_default') === 'true'){
            $menuLang->is_default = true;
        }else{
            $menuLang->is_default = false;
        }
        $menuLang->save();
        $request->session()->flash('message', 'Successfully created language');
        return redirect()->route('languages.create');
    }


    public function show($id){
        return view('dashboard.languages.show', [
            'lang' => MenuLangList::where('id', '=', $id)->first()
        ]);
    }

    public function edit($id)
    {
        return view('dashboard.languages.edit', [
            'lang' => MenuLangList::where('id', '=', $id)->first()
        ]);
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|min:1|max:64',
            'shortName'        => 'required|min:1|max:64',
            'is_default'       => 'required|in:true,false'
        ]);
        $menuLangList = MenuLangList::where('id', '=', $request->input('id'))->first();
        $menuLangList->name = $request->input('name');
        $menuLangList->short_name = $request->input('shortName');
        if($request->input('is_default') === 'true'){
            $menuLangList->is_default = true;
        }else{
            $menuLangList->is_default = false;
        }
        $menuLangList->save();
        $request->session()->flash('message', 'Successfully updated language');
        return redirect()->route('languages.edit', [$request->input('id')]);
    }


    public function destroy($id, Request $request)
    {
        $menu = MenuLangList::where('id', '=', $id)->first();
        $menusLang = MenusLang::where('lang', '=', $menu->short_name)->first();
        if(!empty($menusLang)){
            $request->session()->flash('message', "Can't delete. Language has one or more assigned tranlsation of menu element");
            $request->session()->flash('back', 'languages.index');
            return view('dashboard.shared.universal-info');
        }else{
            $menus = MenuLangList::all();
            if(count($menus) <= 1){
                $request->session()->flash('message', "Can't delete. This is last language on the list");
                $request->session()->flash('back', 'languages.index');
                return view('dashboard.shared.universal-info');
            }else{
                if($menu->is_default == true){
                    $request->session()->flash('message', "Can't delete. This is default language");
                    $request->session()->flash('back', 'languages.index');
                    return view('dashboard.shared.universal-info');
                }else{
                    $menu->delete();
                    $request->session()->flash('message', 'Successfully deleted language');
                    $request->session()->flash('back', 'languages.index');
                    return view('dashboard.shared.universal-info');
                }
            }
        }
    }
}
