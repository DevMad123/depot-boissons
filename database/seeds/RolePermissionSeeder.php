<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Enable these options if you need same role and other permission for User Model
         * Else, please follow the below steps for admin guard
         */

        // Create Roles and Permissions
        // $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'editor']);
        // $roleUser = Role::create(['name' => 'user']);

        // Permission List as array
        // $permissions = [

        //     [
        //         'group_name' => 'dashboard',
        //         'permissions' => [
        //             'dashboard.view',
        //             'dashboard.edit',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'blog',
        //         'permissions' => [
        //             // Blog Permissions
        //             'blog.create',
        //             'blog.view',
        //             'blog.edit',
        //             'blog.delete',
        //             'blog.approve',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'admin',
        //         'permissions' => [
        //             // admin Permissions
        //             'admin.create',
        //             'admin.view',
        //             'admin.edit',
        //             'admin.delete',
        //             'admin.approve',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'role',
        //         'permissions' => [
        //             // role Permissions
        //             'role.create',
        //             'role.view',
        //             'role.edit',
        //             'role.delete',
        //             'role.approve',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'profile',
        //         'permissions' => [
        //             // profile Permissions
        //             'profile.view',
        //             'profile.edit',
        //             'profile.delete',
        //             'profile.update',
        //         ]
        //     ],
        // ];

        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => ['dashboard.view', 'dashboard.edit'],
            ],
            [
                'group_name' => 'produits',
                'permissions' => ['produit.create', 'produit.view', 'produit.edit', 'produit.delete', 'emballage.create', 'emballage.view', 'emballage.edit', 'emballage.delete', 'format.create', 'format.view', 'format.edit', 'format.delete', 'type_produit.create', 'type_produit.view', 'type_produit.edit', 'type_produit.delete'],
            ],
            [
                'group_name' => 'ventes',
                'permissions' => ['ventes.create', 'ventes.view', 'ventes.edit', 'ventes.delete','listeventes.view','listeventes.validervente','listeventes.annulervente', 'detailventes.view',],
            ],
            [
                'group_name' => 'approvisionnements',
                'permissions' => ['approvisionnement.create', 'approvisionnement.view', 'approvisionnement.edit', 'approvisionnement.delete'],
            ],
            [
                'group_name' => 'stocks',
                'permissions' => ['stock.view', 'stock.edit'],
            ],
            [
                'group_name' => 'factures',
                'permissions' => ['factures.create', 'factures.view', 'factures.edit', 'factures.delete', 'facture.imprimer', 'listefacturesliquide.view', 'listefacturesemballage.view'],
            ],
            [
                'group_name' => 'rapports',
                'permissions' => ['rapportinventaire.view', 'rapportventes.view', 'rapportapprovisionnement.view', 'rapportfacture.view'],
            ],
            [
                'group_name' => 'Tiers',
                'permissions' => ['client.create', 'client.view', 'client.edit', 'client.delete', 'fournisseur.create', 'fournisseur.view', 'fournisseur.edit', 'fournisseur.delete'],
            ],
            [
                'group_name' => 'administrateurs',
                'permissions' => ['admin.create', 'admin.view', 'admin.edit', 'admin.delete'],
            ],
            [
                'group_name' => 'parametre',
                'permissions' => ['general.create', 'general.view','general.edit','general.delete',  'mode_paiement.create', 'mode_paiement.view', 'mode_paiement.edit', 'mode_paiement.delete', 'devise.view', 'devise.create', 'devise.edit', 'devise.delete', 'role.create', 'role.view', 'role.edit', 'role.delete', 'tva.create', 'tva.view', 'tva.edit', 'tva.delete', 'fraisairsi.view', 'fraisairsi.create', 'fraisairsi.edit', 'fraisairsi.delete'],
            ],
            [
                'group_name' => 'autre Paramèttre',
                'permissions' => ['seuilcritique.create', 'seuilcritique.view','seuilcritique.edit','Seuil Critique.delete',  'tarifclient.create', 'tarifclient.view', 'tarifclient.edit', 'tarifclient.delete','tarifclientemb.create', 'tarifclientemb.view', 'tarifclientemb.edit', 'tarifclientemb.delete', 'tariffournisseur.view', 'tariffournisseur.create', 'tariffournisseur.edit', 'tariffournisseur.delete', 'tariffournisseuremb.create', 'tariffournisseuremb.view', 'tariffournisseuremb.edit', 'tariffournisseuremb.delete', 'tariftypeproduitclient.create', 'tariftypeproduitclient.view', 'tariftypeproduitclient.edit', 'tariftypeproduitclient.delete', 'tariftypeproduitfournisseur.view', 'tariftypeproduitfournisseur.create', 'tariftypeproduitfournisseur.edit', 'tariftypeproduitfournisseur.delete', 'typeclient.view', 'typeclient.create', 'typeclient.edit', 'typeclient.delete', 'tariftypeproduitembclient.view', 'tariftypeproduitembclient.create', 'tariftypeproduitembclient.edit', 'tariftypeproduitembclient.delete'],
            ]
        ];



        // Do same for the admin guard for tutorial purposes.
        $admin = Admin::where('username', 'superadmin')->first();
        $roleSuperAdmin = $this->maybeCreateSuperAdminRole($admin);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permissionExist = Permission::where('name', $permissions[$i]['permissions'][$j])->first();
                if (is_null($permissionExist)) {
                    $permission = Permission::create([
                        'name' => $permissions[$i]['permissions'][$j],
                        'group_name' => $permissionGroup,
                        'guard_name' => 'admin',
                    ]);
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
            }
        }

        // Assign super admin role permission to superadmin user
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }

    private function maybeCreateSuperAdminRole($admin): Role
    {
        if (is_null($admin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        } else {
            $roleSuperAdmin = Role::where('name', 'superadmin')->where('guard_name', 'admin')->first();
        }

        if (is_null($roleSuperAdmin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        }

        return $roleSuperAdmin;
    }
}
