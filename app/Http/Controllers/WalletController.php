<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public WalletService $walletService;

    /**
     * WalletController constructor.
     *
     * @param WalletService $walletService
     */
    public function __construct()
    {
        $this->walletService = new WalletService(Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return WalletResource::collection($this->walletService->getWallets());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWalletRequest $request
     * @return JsonResponse|WalletResource
     */
    public function store(StoreWalletRequest $request): WalletResource|JsonResponse
    {
        return new WalletResource($this->walletService->createWallet($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  $wallet
     * @return JsonResponse|WalletResource
     */
    public function show(string $wallet): WalletResource|JsonResponse
    {
        $wallet = $this->walletService->getWalletById($wallet);
        return new WalletResource($wallet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateWalletRequest $request
     * @param  Wallet $wallet
     * @return JsonResponse|WalletResource
     */
    public function update(UpdateWalletRequest $request, string $wallet): WalletResource|JsonResponse
    {
        return new WalletResource($this->walletService->updateWallet($wallet, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Wallet $wallet
     * @return JsonResponse
     */
    public function destroy(string $wallet): JsonResponse
    {
        return $this->walletService->deleteWallet($wallet);
    }
}
