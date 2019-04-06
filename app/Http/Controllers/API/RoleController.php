<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Helpers\APIResponse;
use App\Services\RoleService;
use App\Http\Requests\StoreRole;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RolesCollection;

class RoleController extends Controller
{
    use APIResponse;

    public function index(Request $request, Role $role)
    {
        $roles = $role->name($request->name)
            ->displayName($request->display_name)
            ->with('permissions:id,display_name')
            ->orderBy('id', 'desc')
            ->paginate($request->get('limit', config('api.pagination.per_page')), [
                'id', 'name', 'display_name', 'created_at'
            ]);

        return (new RoleCollection($roles))->setMessage('角色列表获取成功。');
    }

    public function store(StoreRole $request, Role $role)
    {
        $role = $role->create($request->only(['name', 'display_name']));

        $role->givePermissionTo($request->permissions);

        return $this->succeedResponse('角色添加成功。');
    }

    public function show($id, RoleService $roleService)
    {
        $role = $roleService->findRoleById($id);

        return (new RoleResource($role))->setMessage('角色获取成功。');
    }

    public function update($id, StoreRole $request, RoleService $roleService)
    {
        $role = $roleService->findRoleById($id);

        $bool = $role->update($request->only(['name', 'display_name']));

        $role->syncPermissions($request->permissions);

        return $bool
            ? $this->succeedResponse('角色更新成功。')
            : $this->failedResponse('角色更新失败。');
    }

    public function destroy($id, RoleService $roleService)
    {
        $role = $roleService->findRoleById($id);

        return $role->delete()
            ? $this->succeedResponse('角色删除成功。')
            : $this->failedResponse('角色删除失败。');
    }

    public function all(Role $role)
    {
        $roles = $role->get(['id', 'display_name']);

        return (new RolesCollection($roles))->setMessage('角色获取成功。');
    }
}
