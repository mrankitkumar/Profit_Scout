<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionPackage;
use App\Models\UserSubscriptionHistory;
use Illuminate\Support\Facades\Auth;
class AdminUserSubscription extends Component
{
    public $id; 
    public $subscriptionHistory = [];
    public $subscriptionHistoryCount = 0;

    public $subscriptionHistoryPage = 1;
    public $subscriptionHistoryPerPage = 5;
    public $keyword = '';
    public function mount($id) 
    {
        $this->id = $id;
    }

    public function getUserSubscriptionHistory()
    {
        $offset = ($this->subscriptionHistoryPage - 1) * $this->subscriptionHistoryPerPage;

        $subscriptionHistoryQuery = UserSubscriptionHistory::where('customber_id', $this->id)
            ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
            ->when($this->keyword, function ($query) {
                $query->where('subscription_packages.subscription_name', 'like', '%' . $this->keyword . '%')
                    ->orWhere('user_subscription_histories.payment_method', 'like', '%' . $this->keyword . '%');
            })
            ->select('user_subscription_histories.*', 'subscription_packages.*', 'user_subscription_histories.subscription_id','user_subscription_histories.id as user_subscription_histories_id')  // Ensure subscription_id is selected explicitly
            ->skip($offset)
            ->take($this->subscriptionHistoryPerPage)
            ->orderBy('user_subscription_histories.created_at', 'desc')
            ->get();

        // dd($subscriptionHistoryQuery);
        // Count the total number of records, to calculate total pages
        $subscriptionHistoryCount = UserSubscriptionHistory::where('customber_id', $this->id)
            ->count();

        $this->subscriptionHistory = $subscriptionHistoryQuery;
        $this->subscriptionHistoryCount = ceil($subscriptionHistoryCount / $this->subscriptionHistoryPerPage);
    }
    public function goToPage($page)
    {
        $this->subscriptionHistoryPage = $page;
        $this->getUserSubscriptionHistory();
        
    }
    public function render()
    {
        $this->getUserSubscriptionHistory();
        return view('livewire.admin-user-subscription',[
           
            'subscriptionHistory' => $this->subscriptionHistory,
            'subscriptionHistoryCount' => $this->subscriptionHistoryCount,
            

        ]);
    }
}
