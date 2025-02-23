<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\MenuRequest;
use App\Models\Content\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::latest('id')->paginate(config('settings.paginate_per_page'));
		return view('backend.menu.index',[
			'menu'=>$menu,
		]);
    }

    public function create()
    {
        $menu = Menu::all();
        return view('backend.menu.create',[
            'menu' => $menu,
		]);
    }

    public function store(MenuRequest $request)
    {
        $data = $request->validated();
        Menu::create($data);
        return redirect()->route('backend.menu.index')->with('menu ',__('lang.successfully_created'));
    }

    public function edit(Menu $menu)
    {
        $allMenu = Menu::all();
        return view('backend.menu.edit',[
			'allMenu' => $allMenu,
			'menu' => $menu,
		]);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $data = $request->validated();
        $menu->update($data);
        return back()->with('success', 'menu ' . __('lang.successfully_updated'));
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'menu ' . __('lang.successfully_deleted'));
    }


    // public function store(MenuRequest $request)
    // {
    //       // Menu::create([
    //     //     'name' => [
    //     //        'uz' => 'Name in English', //yoki $data['name_uz']
    //     //        'ru' => 'Naam in het Nederlands', //yoki $data['name_ru']
    //     //        'en' => 'Naam in het Nederlands'
    //     //     ],
    //     //  ]);
    // }
}
