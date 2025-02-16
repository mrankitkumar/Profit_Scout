<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionPackage;
use App\Models\UserSubscriptionHistory;

class ManagePayment extends Component
{
    public $customers = [];
    public $customersCount = 0;
    public $companies = [];
    public $companyCount = 0;
    public $keyword = '';

    public $customerPage = 1;
    public $companyPage = 1;
    public $customerPerPage = 10;
    public $companyPerPage = 10;

    public $response = [];
    public $activeTab;

    public function mount(): void
    {

        $this->activeTab = session()->has('activeTab') ? session('activeTab') : 'customerp';

        if ($this->activeTab === 'customerp') {
            $this->activeTab = 'customerp';
        } else if ($this->activeTab === 'companyp') {
            $this->activeTab = 'companyp';
        } else {
            $this->activeTab = 'customerp';
        }
        $this->getCustomers();
        $this->getCompanies();
    }

    public function switchTab(string $tabName): void
    {
        $this->activeTab = $tabName;
        session(['activeTab' => $tabName]);
        $this->getCustomers();
        $this->getCompanies();
    }

    public function search(int $page): void
    {
        $this->customerPage = $page;
        $this->getCustomers();
    }

    public function searchCompany(int $page): void
    {
        $this->companyPage = $page;
        $this->getCompanies();
    }

    public function getCustomers(): void
    {
        $this->response = UserSubscriptionHistory::getuserSubscriptionHistories($this->customerPage, $this->customerPerPage, $this->keyword);

        if ($this->response['Success']) {
            $this->customers = $this->response['resdata']['customers'] ?? [];
            $this->customersCount = ceil($this->response['resdata']['count'] / $this->customerPerPage);
        } else {
            $this->customers = [];
            $this->customersCount = 0;
        }
    }

    public function getCompanies(): void
    {
        $this->response = UserSubscriptionHistory::getcustomberSubscriptionHistories($this->companyPage, $this->companyPerPage, $this->keyword);

        if ($this->response['Success']) {
            $this->companies = $this->response['resdata']['companies'] ?? [];
            $this->companyCount = ceil($this->response['resdata']['count'] / $this->companyPerPage);
        } else {
            $this->companies = [];
            $this->companyCount = 0;
        }
    }

    public function changePage($direction): void
    {
        if ($this->activeTab === 'customerp') {
            $newPage = $this->customerPage + $direction;
            // dd($newPage,$this->customersCount);
            if ($newPage >= 1 && $newPage <= $this->customersCount) {
                $this->customerPage = $newPage;
                $this->getCustomers();
            }
        } elseif ($this->activeTab === 'companyp') {
            $newPage = $this->companyPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->companyCount) {
                $this->companyPage = $newPage;
                $this->getCompanies();
            }
        }
    }

    public function render()
    {
        return view('livewire.manage-payment', [
            'customers' => $this->customers,
            'companies' => $this->companies,
            'isCustomerTabp' => $this->activeTab === 'customerp',
            'isCompanyTabp' => $this->activeTab === 'companyp',
        ]);
    }
}
