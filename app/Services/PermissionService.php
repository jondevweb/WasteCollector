<?php

namespace App\Services;

use App\Models\Role;
// use Spatie\Permission\Models\Permission;

class PermissionService
{
    private static $instance = null;
    private $permissions = [];

    private function __construct()
    {
        $this->permissions = [
            'client' => [
                'view_users',
                'create_collecte_client',
                'download_document_client'],
            'transporteur' => [
                'valider_transporteur',
                'view_transporteur'],
            'admin' => [
                'view_admin',
                'create_admin',
                'update_admin',
                'delete_admin']
        ];
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PermissionService();
        }

        return self::$instance;
    }

    public function getPermissions($role)
    {
        return $this->permissions;
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }
  
    public function createPermission($name)
    {
        return Permission::create(['name' => $name]);
    }

    // public function createRole($name)
    // {
    //     return Role::create(['name' => $name]);
    // }

    public function addPermission($item)
    {
        $this->permissions[] = $item;
    }

    public function getRoleByName($name)
    {
        return Role::where('name', $name)->first();
    }

    public function assignPermissionToRole($role)
    {         
        return $this->permissions[$role];
            // $permissionModel = Permission::findByName($pp);
            // dd($permissionModel);
            // if ($permissionModel) {
            //     $roleModel->givePermissionTo($permissionModel);
            //     return true;
            // }
        // return false;
    }

    // Autres méthodes pour gérer les permissions selon vos besoins
}
