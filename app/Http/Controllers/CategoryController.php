<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\ImageService;

class CategoryController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(10);   
        return view('admin.blog-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // Prepare data before storing (slugs are generated automatically via the trait)
        $data = $this->prepareCategoryData($request);

        // Create the category
        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        return view('admin.blog-category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        return view('admin.blog-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Prepare the data before updating (slugs are generated automatically via the trait)
        $data = $this->prepareCategoryData($request, $category);

        // Update the category
        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the associated image if it exists
        $this->imageService->deleteImage($category->image);

        // Delete the category
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Toggle the category status
        $category->update([
            'status' => $category->status === 'active' ? 'inactive' : 'active'
        ]);

        return redirect()->back()
            ->with('success', 'Category status updated successfully');
    }

    /**
     * Prepare category data for storage or update.
     */
    private function prepareCategoryData(Request $request, Category $category = null): array
    {
        $data = $request->validated();

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            if ($category) {
                // If updating, delete the old image
                $this->imageService->deleteImage($category->image);
            }
            
            // Store the new image and add it to the data
            $data['image'] = $this->imageService->storeImage($request->file('image'), 'categories');
        }

        return $data;
    }
}
