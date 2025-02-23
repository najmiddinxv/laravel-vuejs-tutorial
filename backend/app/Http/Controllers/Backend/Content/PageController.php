<?php

namespace App\Http\Controllers\Backend\Content;

use App\Models\Content\Page;
use App\Models\Content\Category;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\PageRequest;

class PageController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $pages = Page::latest()->paginate(config('settings.paginate_per_page'));
		return view('backend.pages.index',[
			'pages'=>$pages,
		]);
    }

    public function create()
    {
        $categories = Category::byModel(Page::class)->latest()->get();
        return view('backend.pages.create',[
            'categories' => $categories,
		]);
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }
        Page::create($data);
        return redirect()->route('backend.pages.index')->with('Page ',__('lang.successfully_created'));
    }

    public function show(Page $page)
    {
        return view('backend.pages.show',[
            'page' => $page,
        ]);
    }

    public function edit(Page $page)
    {
        $categories = Category::byModel(Page::class)->latest()->get();
        return view('backend.pages.edit',[
            'page' => $page,
            'categories' => $categories
        ]);
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($page->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }

        $page->update($data);
        return redirect()->route('backend.pages.index')->with('Page ',__('lang.successfully_updated'));
    }

    public function destroy(Page $page)
    {
        $this->fileUploadService->resizedImageDelete($page->main_image);
        $page->delete();
        return back()->with('success', 'Page ' . __('lang.successfully_deleted'));
    }
}
