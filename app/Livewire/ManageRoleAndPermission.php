<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\subadminpermission;


class ManageRoleAndPermission extends Component
{

    public $role = [];
    public $roleCount = 0;
    public $subadmin = [];
    public $subadminCount = 0;
    public $keyword = '';

    public $rolePage = 1;
    public $subadminPage = 1;
    public $rolePerPage = 10;
    public $subadminPerPage = 10;

    public $response = [];
    public $activeTab;



    public function mount()
    {


        $this->activeTab = session()->has('activeTab') ? session('activeTab') : 'role';

        if ($this->activeTab === 'role') {
            $this->activeTab = 'role';
        } else if ($this->activeTab === 'subadmin') {
            $this->activeTab = 'subadmin';
        } else {
            $this->activeTab = 'role';
        }
        $this->getRoles();
        $this->getSubadmin();

       
    }
    public function getRoles()
    {
        $this->response = Role::getData($this->rolePage, $this->rolePerPage, $this->keyword); 
        if ($this->response['Success']) 
        {
            $this->role = $this->response['resdata']['items'] ?? [];
            $this->roleCount = ceil($this->response['resdata']['count'] / $this->rolePerPage);
        } else {
            $this->role = [];
            $this->roleCount = 0;
        }

    }

    public function getSubadmin()
    {
        $this->response = User::getDatasubadmin($this->subadminPage, $this->subadminPerPage, $this->keyword); 
        if ($this->response['Success']) 
        {
            $this->subadmin = $this->response['resdata']['items'] ?? [];
            $this->subadminCount = ceil($this->response['resdata']['count'] / $this->subadminPerPage);
        } else {
            $this->subadmin = [];
            $this->subadminCount = 0;
        }
       // dd($this->subadmin );

    }
  
    public function changePage($direction)
    {
        if ($this->activeTab === 'role') {
            $newPage = $this->rolePage + $direction;
            if ($newPage >= 1 && $newPage <= $this->roleCount) {
                $this->rolePage = $newPage;
                $this->getRoles();
            }
        } elseif ($this->activeTab === 'subadmin') {
            $newPage = $this->subadminPage + $direction;
            if ($newPage >= 1 && $newPage <= $this->subadminCount) {
                $this->subadminPage = $newPage;
              
                $this->getSubadmin();
            }
        }
    }
    public function search($page)
    {
        $this->subadminPage = $page;
     
        $this->getSubadmin();
    }
    

    public function switchTab($tabName)
    {
       // dd($tabName);
        $this->activeTab = $tabName;
        session(['activeTab' => $tabName]);
        $this->getRoles();
        $this->getSubadmin();


        
    }

    public function render()
    {
        return view('livewire.manage-role-and-permission',[
             
            'roles' => $this->role,
            'isroleTab' => $this->activeTab === 'role',
            'issubadminTab' => $this->activeTab === 'subadmin',
        ]);
    }
    public function updateStatusrole($catId)
    {
           $role = Role::findOrFail($catId);

        if ($role) {
            
            $role->isActive = !$role->isActive;
            $role->save();
           
            // Dispatch the event with success message
            $this->dispatch('role-statusupdate', [['message' => 'Role deleted successfully.', 'status' => 'success']]);
        } else {
            // Dispatch the event with error message
            $this->dispatch('role-statusupdate', [['message' => 'Role not found.', 'status' => 'error']]);
        }
    }

    public function deleterole($catId)
    {
        $role = Role::find($catId);
    
        if ($role) {
            $role->delete(); 
           
            $this->dispatch('role-deleted', [['message' => 'Role deleted successfully.', 'status' => 'success']]);
        } else {
            
            $this->dispatch('role-deleted', [['message' => 'Role not found.', 'status' => 'error']]);
        }
    }
    public function updateStatussubadmin($catId)
    {
        $Subadmin = User::find($catId);
    
        if ($Subadmin) {
           
            $Subadmin->isActive = !$Subadmin->isActive;
            $Subadmin->save();
           
            $this->dispatch('Subadmin-Updated', [['message' => 'Subadmin Updated successfully.', 'status' => 'success']]);
        } else {
            
            $this->dispatch('Subadmin-Updated', [['message' => 'Subadmin not found.', 'status' => 'error']]);
        }
    }

    public function deletesubadmin($catId)
    {
        // Find the user
        $role = User::find($catId);
    
        // Find subadmin permissions related to this user
        $subadmin = subadminpermission::where('adminid', $catId)->get();
    
        if ($role) {
            // Delete the user
            $role->delete();
    
            // Delete all related subadmin permission records
            if ($subadmin->isNotEmpty()) {
                subadminpermission::where('adminid', $catId)->delete();
            }
    
            $this->dispatch('Subadmin-deleted', [['message' => 'Subadmin deleted successfully.', 'status' => 'success']]);
        } else {
            $this->dispatch('Subadmin-deleted', [['message' => 'Subadmin not found.', 'status' => 'error']]);
        }
    }

    public function editrole($catId)
    {
        $role = Role::find($catId);
       
        $this->dispatch('role-edit', [
            'id' => $role->id,
            'rolesname' => $role->rolesname,
            'isActive' => $role->isActive
        ]);
    }
    
}
