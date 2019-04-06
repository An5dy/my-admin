<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Helpers\APIResponse;
use App\Services\AdminService;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\UpdateAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Resources\AdminCollection;

class AdminController extends Controller
{
    use APIResponse;

    public function index(Request $request, Admin $admin)
    {
        $admins = $admin->nickname($request->nickname)
            ->with('roles:id,display_name')
            ->orderBy('id', 'desc')
            ->paginate($request->get('limit', config('api.pagination.per_page')), [
                'id', 'is_super', 'nickname', 'username', 'avatar', 'created_at'
            ]);

        return (new AdminCollection($admins))->setMessage('管理员获取成功。');
    }

    public function store(StoreAdmin $request, Admin $admin)
    {
        DB::transaction(function () use ($request, $admin){
            $admin = $admin->create([
                'nickname' => $request->nickname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'avatar' => 'https://i.loli.net/2017/08/21/599a521472424.jpg',
            ]);

            if ($roles = $request->roles) {
                $admin->assignRole($roles);
            }
        });

        return $this->succeedResponse('管理员添加成功。');
    }

    public function show(int $id, AdminService $adminService)
    {
        $admin = $adminService->findAdminById($id, [
            'id', 'nickname', 'username'
        ]);

        return (new AdminResource($admin))->setMessage('管理详情获取成功。');
    }

    public function update(int $id, UpdateAdmin $request, AdminService $adminService)
    {
        $admin = $adminService->findAdminById($id);

        $data = $request->only(['nickname', 'username']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $bool = $admin->update($data);

        $admin->syncRoles($request->roles);

        return $bool
            ? $this->succeedResponse('管理员信息更新成功。')
            : $this->failedResponse('管理员信息更新失败。');
    }

    public function destroy(int $id, AdminService $adminService)
    {
        $admin = $adminService->findAdminById($id);

        return $admin->delete()
            ? $this->succeedResponse('管理员删除成功。')
            : $this->failedResponse('管理员删除失败。');
    }
}
