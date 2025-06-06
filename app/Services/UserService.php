<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            $user = $this->repository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => (Auth::check() && Auth::user()->isAdmin()) ? $data['role'] : 'user',
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $user = $this->repository->find($id);

            $input = [
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => (Auth::check() && Auth::user()->isAdmin()) ? $data['role'] : 'user',
            ];

            if (isset($data['password'])) {
                $input['password'] = Hash::make($data['password']);
            }

            $user->update($input);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
