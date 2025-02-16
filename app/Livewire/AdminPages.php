<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Adminpages as Pages;
use App\Models\AdminFaq;

class AdminPages extends Component
{
    public $pages=[];

    public $faq=[];
    public $response = [];
    public $activeTab;
    
    

    public $keyword = '';

    public $Page = 1;
    
    public $PerPage = 10;
    public $Count = 0;

   

    public function mount()
    {
        if (Pages::count() === 0) {
            Pages::insert([
                ['title' => 'Terms and Services', 'content' => ''],
                ['title' => 'Privacy Policy', 'content' => ''],
                ['title' => 'AML Policy', 'content' => ''],
               
            ]);
        }

        
        $this->activeTab = session()->has('activeTab') ? session('activeTab') : 'pages';

        if ($this->activeTab === 'pages') {
            $this->activeTab = 'pages';
        } else if ($this->activeTab === 'faq') {
            $this->activeTab = 'faq';
        } else {
            $this->activeTab = 'pages';
        }
        $this->getPages();
        $this->getFaq();
    }
    public function switchTab($tabName)
    {
        $this->activeTab = $tabName;
        session(['activeTab' => $tabName]);
        $this->getPages();
        $this->getFaq();
       
    }
    public function getPages()
    {
        $this->pages = Pages::all();

    }
    public function getFaq()
    {

         $this->response = AdminFaq::faq($this->Page, $this->PerPage, $this->keyword); 
        if ($this->response['Success']) 
        {
            $this->faq = $this->response['resdata']['items'] ?? [];
            $this->Count = ceil($this->response['resdata']['count'] / $this->PerPage);
        } else {
            $this->faq = [];
            $this->Count = 0;
        }

    }

    public function render()
    {
        return view('livewire.admin-pages',[
           
            'ispagesTab' => $this->activeTab === 'pages',
            'isfaqTab' => $this->activeTab === 'faq',
        ]);
    }

    public function editpages($catId)
    {
        $page = Pages::find($catId);
       
        $this->dispatch('pagel-edit', [
            'id' => $page->id,
            'title' => $page->title,
            'content' => $page->content,
            'isActive' => $page->isActive
        ]);
    }

    public function editfaq($catId)
    {
        $page = AdminFaq::find($catId);
       
        $this->dispatch('faql-edit', [
            'id' => $page->id,
            'question' => $page->question,
            'answer' => $page->answer,
            'isActive' => $page->isActive
        ]);
    }
    public function updateStatuspages($countryId)
    {
           $Pages = Pages::findOrFail($countryId);

           
            
        
        if ($Pages) {
            
            $Pages->isActive = !$Pages->isActive;
            $Pages->save();
           
            // Dispatch the event with success message
            $this->dispatch('Pages-statusupdate', [['message' => 'Pages deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('Pages-statusupdate', [['message' => 'Pages not found.', 'status' => 'error']]);
        }
    }
    
    public function updateStatusfaq($countryId)
    {
           $AdminFaq = AdminFaq::findOrFail($countryId);

           
            
        
        if ($AdminFaq) {
            
            $AdminFaq->isActive = !$AdminFaq->isActive;
            $AdminFaq->save();
           
            // Dispatch the event with success message
            $this->dispatch('AdminFaq-statusupdate', [['message' => 'AdminFaq deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('AdminFaq-statusupdate', [['message' => 'AdminFaq not found.', 'status' => 'error']]);
        }
    }
    public function deletefaq($catId)
    {
        $AdminFaq = AdminFaq::find($catId);
    
        if ($AdminFaq) {
            $AdminFaq->delete(); 
           
            $this->dispatch('AdminFaq-deleted', [['message' => 'AdminFaq deleted successfully.', 'status' => 'success']]);
        } else {
            
            $this->dispatch('AdminFaq-deleted', [['message' => 'AdminFaq not found.', 'status' => 'error']]);
        }
    }
    public function search($page)
    {
        $this->Page = $page;
     
       $this->getPages();
        $this->getFaq();
    }
    public function changePage($direction)
    {
     
            $newPage = $this->Page + $direction;
            if ($newPage >= 1 && $newPage <= $this->Count) {
                $this->Page = $newPage;
              
                $this->getFaq();
            }
        
    }
}
