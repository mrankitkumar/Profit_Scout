<?php

namespace App\Livewire;

use App\Models\SubscriptionPackage;
use Livewire\Component;

class ManageSubscription extends Component
{
    public $subscription = [];
    public $subscriptionCount = 0;
    public $subscriptionPage = 1;
    public $subscriptionPerPage = 10;
    public $keyword = ''; // Assuming you want to allow searching by keyword
    public $response = [];
    
    public function mount()
    {
        $this->getSubscription();
    }

    /**
     * Fetch subscriptions based on the current search and pagination state.
     */
    public function getSubscription()
    {
        // Call the model's method to fetch subscriptions
        $this->response = SubscriptionPackage::getSubscription($this->subscriptionPage, $this->subscriptionPerPage, $this->keyword);

        if ($this->response['Success']) {
            // Store the subscription data and the total count
            $this->subscription = $this->response['resdata']['subscription_packages'] ?? [];
            $this->subscriptionCount = $this->response['resdata']['pagecount'] ?? 0;
        } else {
            // Reset subscriptions if the response is not successful
            $this->subscription = [];
            $this->subscriptionCount = 0;
        }
    }
    
    /**
     * Render the Livewire view.
     */
    public function render()
    {
        return view('livewire.manage-subscription', [
            'subscription' => $this->subscription,
        ]);
    }

    /**
     * Handle the search functionality.
     */
    public function searchSubscription($page)
    {
        // Update page number and trigger the search again
        $this->subscriptionPage = $page;
        $this->getSubscription();
    }

    /**
     * Change the current page for pagination.
     */
    public function changePage($direction)
    {
        // Calculate the new page
        $newPage = $this->subscriptionPage + $direction;

        // Check if the new page is valid
        if ($newPage >= 1 && $newPage <= $this->subscriptionCount) {
            $this->subscriptionPage = $newPage;
            $this->getSubscription();
        }
    }

    public function deletepackage($catId)
    {
        $language = SubscriptionPackage::find($catId);
    
        if ($language) {
            $language->delete(); 
           
            $this->dispatch('package-deleted', [['message' => 'package deleted successfully.', 'status' => 'success']]);
        } else {
            
            $this->dispatch('package-deleted', [['message' => 'package not found.', 'status' => 'error']]);
        }
    }
    public function updateStatuspackage($catId)
    {
           $package = SubscriptionPackage::findOrFail($catId);

           
        if ($package) {
            
            $package->isActive = !$package->isActive;
            $package->save();
           
            // Dispatch the event with success message
            $this->dispatch('package-statusupdate', [['message' => 'package updated successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('package-statusupdate', [['message' => 'package not found.', 'status' => 'error']]);
        }
    }
}
