<?php
namespace App;


use App\Repositories\Eloquent\CategoryRepository;

class Category {

    protected $categories;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories=$categoryRepository;
    }


    /**
     * @return CategoryRepository
     */
    public function getCategories()
    {
         $this->categories->all();
    }


}
