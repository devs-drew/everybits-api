<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WalletService
{
    public User $user;

    /**
     * WalletService constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all wallets for the authenticated user.
     *
     * @return Collection
     */
    public function getWallets(): Collection
    {
        return $this->user->wallets()->get();
    }

    /**
     * Get a wallet by ID for the authenticated user.
     *
     * @param string $id
     * @return Wallet|JsonResponse
     */
    public function getWalletById(string $id): Wallet|JsonResponse
    {
        return $this->findWallet($id);
    }

    /**
     * Create a new wallet for the authenticated user.
     *
     * @param array $data
     * @return Wallet|JsonResponse
     */
    public function createWallet(array $data): Wallet|JsonResponse
    {
        try {
            return Wallet::create(array_merge($data, [
                'user_id' => $this->user->id, // Replace with actual authenticated user ID
            ]));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create wallet'], 500);
        }
    }

    /**
     * Update an existing wallet for the authenticated user.
     *
     * @param string $id
     * @param array $data
     * @return Wallet|JsonResponse
     */
    public function updateWallet(string $id, array $data): Wallet|JsonResponse
    {
        $wallet = $this->findWallet($id);

        try {
            $wallet->update($data);
            return $wallet;
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update wallet'], 500);
        }
    }

    /**
     * Delete a wallet by ID for the authenticated user.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function deleteWallet(string $id): JsonResponse
    {

        $wallet = $this->findWallet($id);
        try {
            $wallet->delete();
            return response()->json(['message' => 'Wallet deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete wallet'], 500);
        }
    }

    /**
     * Find a wallet by ID.
     *
     * @param string $id
     * @return Wallet|JsonResponse
     * @throws NotFoundHttpException
     */
    public function findWallet(string $id): Wallet|JsonResponse
    {
        try {
            return Wallet::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundHttpException("Wallet not found");
        }
    }
}
