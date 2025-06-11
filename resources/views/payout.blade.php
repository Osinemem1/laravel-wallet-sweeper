@extends('layouts.app')

@section('content')
<section class="p-6" x-data="{ showNewModal: false, showViewModal: false, payoutToView: null }">

          <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Payouts</h3>
                    <button
                              @click="showNewModal = true"
                              class="bg-blue-600 hover:bg-blue-700 focus:ring focus:ring-blue-400 px-4 py-2 rounded text-white whitespace-nowrap focus:outline-none">
                              + New Payout
                    </button>
          </div>

          <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full bg-gray-300 dark:bg-gray-800 rounded border-collapse border border-gray-400 dark:border-gray-700 overflow-hidden text-gray-900 dark:text-gray-200">
                              <thead>
                                        <tr>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Recipient Wallet</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Amount</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Status</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Date</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Action</th>
                                        </tr>
                              </thead>
                              <tbody>
                                        {{-- Example payout data --}}
                                        <template x-for="payout in [
                    { id: 1, wallet: '0x4e3b2a...e9f8d2', amount: 0.5, status: 'Completed', date: '2025-06-01', txid: '0xabc123...' },
                    { id: 2, wallet: '0x1a7c9b...d4e7f0', amount: 1.2, status: 'Pending', date: '2025-06-03', txid: '0xdef456...' }
                ]" :key="payout.id">
                                                  <tr>
                                                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="payout.wallet"></td>
                                                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="`Ξ ${payout.amount}`"></td>
                                                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                                                                      <span
                                                                                :class="{
                                  'bg-green-200 text-green-800': payout.status === 'Completed',
                                  'bg-yellow-200 text-yellow-800': payout.status === 'Pending',
                                  'bg-red-200 text-red-800': payout.status === 'Failed'
                                }"
                                                                                class="px-2 py-1 rounded text-sm"
                                                                                x-text="payout.status"></span>
                                                            </td>
                                                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="payout.date"></td>
                                                            <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                                                                      <button
                                                                                @click="payoutToView = payout; showViewModal = true"
                                                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">View</button>
                                                            </td>
                                                  </tr>
                                        </template>
                              </tbody>
                    </table>
          </div>

          <!-- New Payout Modal -->
          <div
                    x-show="showNewModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-transition.opacity
                    style="display: none;">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6" @click.away="showNewModal = false" x-trap="showNewModal">
                              <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">New Payout</h4>
                              <form method="POST" action="{{ route('payouts.store') }}" class="space-y-4">
                                        @csrf
                                        <div>
                                                  <label for="recipient" class="block mb-1 text-gray-700 dark:text-gray-300">Recipient Wallet Address</label>
                                                  <input
                                                            type="text"
                                                            name="recipient"
                                                            id="recipient"
                                                            required
                                                            class="w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded px-3 py-2"
                                                            placeholder="Recipient wallet address" />
                                        </div>

                                        <div>
                                                  <label for="amount" class="block mb-1 text-gray-700 dark:text-gray-300">Amount (ETH)</label>
                                                  <input
                                                            type="number"
                                                            name="amount"
                                                            id="amount"
                                                            required
                                                            min="0.0001"
                                                            step="0.0001"
                                                            class="w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded px-3 py-2"
                                                            placeholder="Amount to send" />
                                        </div>

                                        <div class="text-right">
                                                  <button
                                                            type="button"
                                                            @click="showNewModal = false"
                                                            class="mr-2 px-4 py-2 rounded border border-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">
                                                            Cancel
                                                  </button>
                                                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                                                            Send Payout
                                                  </button>
                                        </div>
                              </form>
                    </div>
          </div>

          <!-- View Payout Modal -->
          <div
                    x-show="showViewModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-transition.opacity
                    style="display: none;">
                    <div
                              class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6"
                              @click.away="showViewModal = false; payoutToView = null"
                              x-trap="showViewModal">
                              <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Payout Details</h4>

                              <template x-if="payoutToView">
                                        <div class="space-y-3 text-gray-900 dark:text-gray-200">
                                                  <div><strong>Wallet Address:</strong> <span x-text="payoutToView.wallet"></span></div>
                                                  <div><strong>Amount:</strong> <span x-text="`Ξ ${payoutToView.amount}`"></span></div>
                                                  <div><strong>Status:</strong> <span x-text="payoutToView.status"></span></div>
                                                  <div><strong>Date:</strong> <span x-text="payoutToView.date"></span></div>
                                                  <div><strong>Transaction ID:</strong> <span x-text="payoutToView.txid"></span></div>
                                        </div>
                              </template>

                              <div class="mt-6 text-right">
                                        <button
                                                  @click="showViewModal = false; payoutToView = null"
                                                  class="px-4 py-2 rounded border border-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">
                                                  Close
                                        </button>
                              </div>
                    </div>
          </div>

</section>
@endsection