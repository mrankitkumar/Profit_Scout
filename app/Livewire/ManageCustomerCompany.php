<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\UserDetail;

class ManageCustomerCompany extends Component
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

    public function mount()
    {


        $this->activeTab = session()->has('activeTab') ? session('activeTab') : 'customer';

        if ($this->activeTab === 'customer') {
            $this->activeTab = 'customer';
        } else if ($this->activeTab === 'company') {
            $this->activeTab = 'company';
        } else {
            $this->activeTab = 'customer';
        }

        $this->getCustomers();
        $this->getCompany();
    }

    public function switchTab($tabName)
    {
        $this->activeTab = $tabName;
        session(['activeTab' => $tabName]);
        $this->getCustomers();
        $this->getCompany();
    }
    public function search($page)
    {
        $this->customerPage = $page;
        $this->getCustomers();
    }

    public function searchCompany($page)
    {
        $this->companyPage = $page;
        $this->getCompany();
    }

    public function getCustomers()
    {
        $this->response = User::getCustomers($this->customerPage, $this->customerPerPage, $this->keyword);
        if ($this->response['Success']) {
            $this->customers = $this->response['resdata']['customers'] ?? [];
            $this->customersCount = ceil($this->response['resdata']['count'] / $this->customerPerPage);
        } else {
            $this->customers = [];
            $this->customersCount = 0;
        }
    }

    public function getCompany()
    {
        $this->response = User::getCompany($this->companyPage, $this->companyPerPage, $this->keyword);
        if ($this->response['Success']) {
            $this->companies = $this->response['resdata']['companies'] ?? [];
            $this->companyCount = ceil($this->response['resdata']['count'] / $this->companyPerPage);
        } else {
            $this->companies = [];
            $this->companyCount = 0;
        }
    }

    public function changePage($direction)
    {
        if ($this->activeTab === 'customer') {
            $newPage = $this->customerPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->customersCount) {
                $this->customerPage = $newPage;
                $this->getCustomers();
            }
        } elseif ($this->activeTab === 'company') {
            $newPage = $this->companyPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->companyCount) {
                $this->companyPage = $newPage;
                $this->getCompany();
            }
        }
    }

    public function render()
    {
        return view('livewire.manage-customer-company', [
            'customers' => $this->customers,
            'companies' => $this->companies,
            'isCustomerTab' => $this->activeTab === 'customer',
            'isCompanyTab' => $this->activeTab === 'company',
        ]);
    }

    public function updateStatus($customerId)
    {
        try {
            // Fetch the user by ID
            $user = User::findOrFail($customerId);

            // Toggle the 'isActive' status for the user
            $user->isActive = !$user->isActive;
            $user->save();

            // Fetch the related UserDetail by ID
            $userDetail = UserDetail::findOrFail($user->userdetail_id);

            // Toggle the 'isActive' status for the UserDetail
            $userDetail->isActive = !$userDetail->isActive;
            $userDetail->save();

            // Flash a success message
            session()->flash('successMessage', 'Customer status updated successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Flash an error message if the user or user detail is not found
            session()->flash('errorMessage', 'Customer or associated details not found.');
        } catch (\Exception $e) {
            // Catch any other exceptions
            session()->flash('errorMessage', 'An error occurred while updating the status.');
        }

        $this->dispatch('status-updated', [
            'message' => 'Customer status updated successfully!',
        ]);
    }

    public function updateStatuscompany($customerId)
    {
        try {
            // Fetch the user by ID
            $user = User::findOrFail($customerId);

            // Toggle the 'isActive' status for the user
            $user->isActive = !$user->isActive;
            $user->save();

            // Fetch the related UserDetail by ID
            $userDetail = UserDetail::findOrFail($user->userdetail_id);

            // Toggle the 'isActive' status for the UserDetail
            $userDetail->isActive = !$userDetail->isActive;
            $userDetail->save();

            // Flash a success message
            session()->flash('successMessage', 'Company status updated successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Flash an error message if the user or user detail is not found
            session()->flash('errorMessage', 'Company or associated details not found.');
        } catch (\Exception $e) {
            // Catch any other exceptions
            session()->flash('errorMessage', 'An error occurred while updating the status.');
        }

        $this->dispatch('status-updatedcompany', [
            'message' => 'Company status updated successfully!',
        ]);
        
    }
}
