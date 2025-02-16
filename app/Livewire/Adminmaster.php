<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Country;
use App\Models\City;
use App\Models\Language;
use Livewire\Component;

class Adminmaster extends Component
{
    public $categories = [];
    public $categoriesCount = 0;

    public $countries = [];
    public $countryCount = 0;

    public $cities = [];
    public $cityCount = 0;

    public $languages = [];
    public $languageCount = 0;

    public $keyword = '';
    public $successMessage = null;
    public $errorMessage = null;
    public $categoriesPage = 1;
    public $countryPage = 1;
    public $cityPage = 1;
    public $languagePage = 1;

    public $itemsPerPage = 10; // Unified per-page variable for all entities
    public $activeTab;
    public $response = [];
    public $editcategories=[];

    public function mount()
    {
        $this->activeTab = session()->has('activeTab') ? session('activeTab') : 'categories';

        if ($this->activeTab === 'categories') {
            $this->activeTab = 'categories';
        } elseif ($this->activeTab === 'country') {
            $this->activeTab = 'country';
        } elseif ($this->activeTab === 'city') {
            $this->activeTab = 'city';
        } elseif ($this->activeTab === 'language') {
            $this->activeTab = 'language';
        } else {
            $this->activeTab = 'categories';
        }
        $this->getCategories();
        $this->getCountry();
        $this->getCity();
        $this->getLanguage();
    }

    public function switchTab($tabName)
    {
        $this->activeTab = $tabName;
        $this->getCategories();
        $this->getCountry();
        $this->getCity();
        $this->getLanguage();
        session(['activeTab' => $tabName]);
        
    }

    public function searchCategories($page)
    {
        $this->categoriesPage = $page;
        $this->getCategories();
    }

    public function searchCountry($page)
    {
        $this->countryPage = $page;
        $this->getCountry();
    }

    public function searchCity($page)
    {
        $this->cityPage = $page;
        $this->getCity();
    }

    public function searchLanguage($page)
    {
        $this->languagePage = $page;
        $this->getLanguage();
    }

    public function getCategories()
    {
        $this->response = Category::getData($this->categoriesPage, $this->itemsPerPage, $this->keyword); // Adjusted method name
        if ($this->response['Success']) {
            $this->categories = $this->response['resdata']['items'] ?? [];
            $this->categoriesCount = ceil($this->response['resdata']['count'] / $this->itemsPerPage);
        } else {
            $this->categories = [];
            $this->categoriesCount = 0;
        }
    }

    public function getCountry()
    {
        $this->response = Country::getData($this->countryPage, $this->itemsPerPage, $this->keyword);
        if ($this->response['Success']) {
            $this->countries = $this->response['resdata']['items'] ?? [];
            $this->countryCount = ceil($this->response['resdata']['count'] / $this->itemsPerPage);
        } else {
            $this->countries = [];
            $this->countryCount = 0;
        }
    }

    public function getCity()
    {
        $this->response = City::getData($this->cityPage, $this->itemsPerPage, $this->keyword);
        if ($this->response['Success']) {
            $this->cities = $this->response['resdata']['items'] ?? [];
            $this->cityCount = ceil($this->response['resdata']['count'] / $this->itemsPerPage);
        } else {
            $this->cities = [];
            $this->cityCount = 0;
        }
    }

    public function getLanguage()
    {
        $this->response = Language::getData($this->languagePage, $this->itemsPerPage, $this->keyword);
        if ($this->response['Success']) {
            $this->languages = $this->response['resdata']['items'] ?? [];
            $this->languageCount = ceil($this->response['resdata']['count'] / $this->itemsPerPage);
        } else {
            $this->languages = [];
            $this->languageCount = 0;
        }
    }

    public function changePage($direction)
    {
        if ($this->activeTab === 'categories') {
            $newPage = $this->categoriesPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->categoriesCount) {
                $this->categoriesPage = $newPage;
                $this->getCategories();
            }
        } elseif ($this->activeTab === 'country') {
            $newPage = $this->countryPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->countryCount) {
                $this->countryPage = $newPage;
                $this->getCountry();
            }
        } elseif ($this->activeTab === 'city') {
            $newPage = $this->cityPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->cityCount) {
                $this->cityPage = $newPage;
                $this->getCity();
            }
        } elseif ($this->activeTab === 'language') {
            $newPage = $this->languagePage + $direction;
            if ($newPage >= 1 && $newPage <= $this->languageCount) {
                $this->languagePage = $newPage;
                $this->getLanguage();
            }
        }
    }

    public function render()
    {
        
        return view('livewire.adminmaster', [
            'categories' => $this->categories,
            'countries' => $this->countries,
            'cities' => $this->cities,
            'languages' => $this->languages,
            'isCategoriesTab' => $this->activeTab === 'categories',
            'isCountryTab' => $this->activeTab === 'country',
            'isCityTab' => $this->activeTab === 'city',
            'isLanguageTab' => $this->activeTab === 'language',
        ]);
    }

    public function deleteCategory($catId)
    {
        $category = Category::find($catId);
    
        if ($category) {
            $category->delete(); // Delete the category
            // Dispatch the event with success message
            $this->dispatch('category-deleted', [['message' => 'Category deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('category-deleted', [['message' => 'Category not found.', 'status' => 'error']]);
        }
    }

    public function deleteCountry($catId)
    {
        $country = Country::find($catId);
    
        if ($country) {
            $country->delete(); // Delete the category
            // Dispatch the event with success message
            $this->dispatch('country-deleted', [['message' => 'country deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('country-deleted', [['message' => 'country not found.', 'status' => 'error']]);
        }
    }
    public function deleteCity($catId)
    {
        $city = City::find($catId);
    
        if ($city) {
            $city->delete(); // Delete the category
            // Dispatch the event with success message
            $this->dispatch('city-deleted', [['message' => 'city deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('city-deleted', [['message' => 'city not found.', 'status' => 'error']]);
        }
    }
    public function deleteLanguage($catId)
    {
        $language = Language::find($catId);
    
        if ($language) {
            $language->delete(); 
           
            $this->dispatch('language-deleted', [['message' => 'language deleted successfully.', 'status' => 'success']]);
        } else {
            
            $this->dispatch('language-deleted', [['message' => 'language not found.', 'status' => 'error']]);
        }
    }

    public function updateStatuscategory($catId)
    {
           $category = Category::findOrFail($catId);

           
            
    
        if ($category) {
            
            $category->isActive = !$category->isActive;
            $category->save();
           
            // Dispatch the event with success message
            $this->dispatch('category-statusupdate', [['message' => 'Category deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('category-statusupdate', [['message' => 'Category not found.', 'status' => 'error']]);
        }
    }
    public function updateStatuscountry($countryId)
    {
           $country = Country::findOrFail($countryId);

           
            
    
        if ($country) {
            
            $country->isActive = !$country->isActive;
            $country->save();
           
            // Dispatch the event with success message
            $this->dispatch('country-statusupdate', [['message' => 'Category deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('country-statusupdate', [['message' => 'Category not found.', 'status' => 'error']]);
        }
    }
    public function updateStatuscity($countryId)
    {
           $city = City::findOrFail($countryId);

           
            
    
        if ($city) {
            
            $city->isActive = !$city->isActive;
            $city->save();
           
            // Dispatch the event with success message
            $this->dispatch('city-statusupdate', [['message' => 'city deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('city-statusupdate', [['message' => 'city not found.', 'status' => 'error']]);
        }
    }
    

    public function updateStatuslanguage($countryId)
    {
           $language = Language::findOrFail($countryId);

           
            
        
        if ($language) {
            
            $language->isActive = !$language->isActive;
            $language->save();
           
            // Dispatch the event with success message
            $this->dispatch('language-statusupdate', [['message' => 'language deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('language-statusupdate', [['message' => 'language not found.', 'status' => 'error']]);
        }
    }

    public function editcategory($catId)
    {
        $cat = Category::findOrFail($catId);
        $this->editcategories = $cat;
        //dd($cat);
        // Emit the data to JavaScript
        $this->dispatch('message-sent', [
            'catId' => $cat->id,
            'catName' => $cat->name,
            'catIsActive' => $cat->isActive
        ]);
    }
    public function editcountry($catId)
    {
        $cat = Country::findOrFail($catId);
       
        $this->dispatch('country-edit', [
            'id' => $cat->id,
            'countryname' => $cat->countryname,
            'isActive' => $cat->isActive
        ]);
    }

    public function cityedit($countryId)
    {
        $city = City::findOrFail($countryId);
        $this->getCity();
       
        $this->dispatch('city-edit', [
            'id' => $city->id,
            'countryid' => $city->countryid,
            'cityname' => $city->cityname,
            'isActive' => $city->isActive
        ]);
    }
    

    
    public function editlanguage($catId)
    {
        $lan = Language::findOrFail($catId);
        
       
        $this->dispatch('language-edit', [
            'id' => $lan->id,
            'languagename' => $lan->languagename,
            'isActive' => $lan->isActive
        ]);
    }
   
  
    
    
}
