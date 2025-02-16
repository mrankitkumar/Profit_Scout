<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionPackage;
use App\Models\UserSubscriptionHistory;
use Illuminate\Support\Facades\Auth;

class UserSubscription extends Component
{
    // Define the variables to handle pagination
    public $subscriptionHistory = [];
    public $subscriptionHistoryCount = 0;

    public $subscriptionHistoryPage = 1;
    public $subscriptionHistoryPerPage = 5;
    public $subscriptionActiveHistory = [];

    public $keyword = '';


    public function getUserSubscriptionHistory()
    {
        $offset = ($this->subscriptionHistoryPage - 1) * $this->subscriptionHistoryPerPage;
        //dd(auth()->user()->id);

        $subscriptionHistoryQuery = UserSubscriptionHistory::where('customber_id', auth()->user()->id)
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
        $subscriptionHistoryCount = UserSubscriptionHistory::where('customber_id', auth()->user()->id)
            ->count();
       // dd($subscriptionHistoryCount);
        $this->subscriptionHistory = $subscriptionHistoryQuery;
        $this->subscriptionHistoryCount = ceil($subscriptionHistoryCount / $this->subscriptionHistoryPerPage);
    }

    public function userActiveSubscription()
    {
        $subscription = UserSubscriptionHistory::where('customber_id', Auth::user()->id)
            ->where('subscription_status', 'Active')
            ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
            ->when($this->keyword, function ($query) {
                $query->where('subscription_packages.subscription_name', 'like', '%' . $this->keyword . '%')
                    ->orWhere('user_subscription_histories.payment_method', 'like', '%' . $this->keyword . '%');
            })
            ->select('user_subscription_histories.*', 'subscription_packages.*', 'user_subscription_histories.subscription_id')
            ->orderBy('user_subscription_histories.created_at', 'desc')
            ->get();

        $this->subscriptionActiveHistory = $subscription;
    }


    public function goToPage($page)
    {
        $this->subscriptionHistoryPage = $page;
        $this->getUserSubscriptionHistory();
        $this->useractivesubscription();
    }



    public function render()
    {


        $package = SubscriptionPackage::where('isActive', 1)->get();


        $this->getUserSubscriptionHistory();
        $this->useractivesubscription();

        return view('livewire.user-subscription', [
            'package' => $package,
            'subscriptionHistory' => $this->subscriptionHistory,
            'subscriptionHistoryCount' => $this->subscriptionHistoryCount,
            'subscriptionActiveHistory' => $this->subscriptionActiveHistory

        ]);
    }
}
