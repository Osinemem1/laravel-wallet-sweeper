@extends('layouts.app')

@section('content')
     <section x-data="{
        editModalOpen: false,
        addModalOpen: false,
        currentWallet: { id: null, address: '', balance: '', type: 'source', private_key: '' },
        newWallet: { address: '', balance: '', type: 'source', private_key: '' }
    }" class="p-6">

        <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Wallets</h3>
            <button @click="addModalOpen = true; newWallet = { address: '', balance: '', type: 'Source' }"
                class="bg-blue-600 hover:bg-blue-700 focus:ring focus:ring-blue-400 px-4 py-2 rounded text-white whitespace-nowrap focus:outline-none">
                + Add Wallet
            </button>
        </div>

        <div class="overflow-x-auto rounded-lg">
            <table
                class="min-w-full bg-gray-300 dark:bg-gray-800 rounded border-collapse border border-gray-400 dark:border-gray-700 overflow-hidden text-gray-900 dark:text-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Address</th>
                        <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Balance</th>
                        <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Type</th>
                        <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wallets as $wallet)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700"
                                title="{{ $wallet->address }}">
                                {{ Str::limit($wallet->address, 10, '...') }}
                            </td>
                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                                ${{ number_format($wallet->balance, 2) }}</td>
                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">{{ $wallet->type }}</td>
                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                                <div class="flex gap-2">
                                    <button
                                        @click="editModalOpen = true; currentWallet = { id: '{{ $wallet->id }}', address: '{{ $wallet->address }}', balance: '{{ $wallet->balance }}', type: '{{ $wallet->type }}' }"
                                        class="flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-yellow-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('wallets.destroy', $wallet) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-red-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('sweeps.wallet', $wallet) }}" class="mt-2">
                                    @csrf

                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Sweep</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- Edit Modal -->
        <div x-show="editModalOpen" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="editModalOpen = false"
                class="bg-white dark:bg-gray-900 rounded-lg shadow-lg max-w-md w-full p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200">Edit Wallet</h2>
                <form method="POST" :action="`/wallets/${currentWallet.id}`">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col">
                        <label for="edit-address"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" id="edit-address" x-model="currentWallet.address"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex flex-col">
                        <label for="edit-balance"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Balance</label>
                        <input type="number" id="edit-balance" x-model="currentWallet.balance" min="0"
                            step="0.01"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex flex-col">
                        <label for="edit-type"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                        <select id="edit-type" x-model="currentWallet.type"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="Source">Source</option>
                            <option value="Destination">Destination</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="edit-private-key"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Private Key</label>
                        <input type="password" id="edit-private-key" name="private_key" x-model="currentWallet.private_key"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>


                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="editModalOpen = false"
                            class="px-4 py-2 rounded bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Wallet Modal -->
        <div x-show="addModalOpen" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="addModalOpen = false"
                class="bg-white dark:bg-gray-900 rounded-lg shadow-lg max-w-md w-full p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200">Add Wallet</h2>

                <form method="POST" action="{{ route('wallets.store') }}">
                    @csrf

                    <div class="flex flex-col">
                        <label for="add-address"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" name="address" id="add-address" x-model="newWallet.address"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex flex-col">
                        <label for="add-balance"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Balance</label>
                        <input type="number" name="balance" id="add-balance" x-model="newWallet.balance"
                            min="0" step="0.00000001"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex flex-col">
                        <label for="add-type"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                        <select name="type" id="add-type" x-model="newWallet.type"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="source">Source</option>
                            <option value="destination">Destination</option>
                            <option value="central">Central</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="add-private-key"
                            class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Private Key</label>
                        <input type="password" name="private_key" id="add-private-key" x-model="newWallet.private_key"
                            class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>


                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="addModalOpen = false"
                            class="px-4 py-2 rounded bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Add
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
