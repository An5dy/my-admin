<?php

namespace App\Http\Controllers\API;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Helpers\APIResponse;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermission;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionsCollection;

class PermissionController extends Controller
{
    use APIResponse;

    public function index(Request $request, Permission $permission)
    {
        $permissions = $permission->name($request->name)
            ->displayName($request->display_name)
            ->orderBy('id', 'desc')
            ->paginate($request->get('limit', config('api.pagination.per_page')), [
                'id', 'name', 'display_name', 'created_at'
            ]);

        return (new PermissionCollection($permissions))->setMessage('权限列表获取成功。');
    }

    public function store(StorePermission $request, Permission $permission)
    {
        $permission->create($request->only(['name', 'display_name']));

        return $this->succeedResponse('权限添加成功。');
    }

    public function show(int $id, PermissionService $permissionService)
    {
        $permission = $permissionService->findPermissionById($id);

        return (new PermissionResource($permission))->setMessage('权限获取成功。');
    }

    public function update(int $id, StorePermission $request, PermissionService $permissionService)
    {
        $permission = $permissionService->findPermissionById($id);

        $bool = $permission->update($request->only('name', 'display_name'));

        return $bool
            ? $this->succeedResponse('权限更新成功。')
            : $this->failedResponse('权限更新失败。');
    }

    public function destroy(int $id, PermissionService $permissionService)
    {
        $permission = $permissionService->findPermissionById($id);

        return $permission->delete()
            ? $this->succeedResponse('权限删除成功。')
            : $this->succeedResponse('权限删除失败。');
    }

    public function all(PermissionRegistrar $permission)
    {
        $permissions = $permission->getPermissions();

        return (new PermissionsCollection($permissions))->setMessage('权限获取成功。');
    }
}
