<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public User $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return WalletResource::collection($this->user->wallets()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function show(Wallet $wallet): WalletResource
    {
        return new WalletResource($this->user->wallets()->findOrFail($wallet->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWalletRequest $request
     * @return WalletResource
     */
    public function store(StoreWalletRequest $request): WalletResource
    {
        $wallet = $this->user->wallets()->create($request->validated());
        return new WalletResource($wallet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWalletRequest $request
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet): WalletResource
    {
        Gate::authorize('modify', $wallet);
        $wallet = $this->user->wallets()->findOrFail($wallet->id);
        $wallet->update($request->validated());
        return new WalletResource($wallet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     * @return JsonResponse
     */
    public function destroy(Wallet $wallet): JsonResponse
    {
        Gate::authorize('modify', $wallet);
        $wallet = $this->user->wallets()->findOrFail($wallet->id);
        $wallet->delete();
        return response()->json([
            'message' => 'Wallet deleted successfully'
        ]);
    }
}
