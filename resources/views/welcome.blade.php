  @extends('layouts.app')

  @section('content')

  <section
      class="bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-4 border-b border-gray-400 dark:border-gray-700 shadow-sm sticky top-[56px] z-10">
      <div class="max-w-7xl mx-auto">
          <h1 class="text-2xl font-semibold">Welcome back, HazzaTech! 👋</h1>
      </div>
  </section>



  <!-- Dashboard Cards -->
  <section class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div
          class="bg-gray-300 dark:bg-gray-800 p-4 rounded-lg shadow-lg text-gray-900 dark:text-gray-200 transition-colors duration-300">
          <h3 class="text-sm">Total Wallets</h3>
          <p class="text-2xl font-bold">12</p>
      </div>
      <div
          class="bg-gray-300 dark:bg-gray-800 p-4 rounded-lg shadow-lg text-gray-900 dark:text-gray-200 transition-colors duration-300">
          <h3 class="text-sm">Total Sent</h3>
          <p class="text-2xl font-bold">$4,320.00</p>
      </div>
      <div
          class="bg-gray-300 dark:bg-gray-800 p-4 rounded-lg shadow-lg text-gray-900 dark:text-gray-200 transition-colors duration-300">
          <h3 class="text-sm">Last Transaction</h3>
          <p class="text-sm truncate" title="0x123456789abcdef123456789abcdef">0x123456789abc...def</p>
      </div>
      <div
          class="bg-gray-300 dark:bg-gray-800 p-4 rounded-lg shadow-lg text-gray-900 dark:text-gray-200 transition-colors duration-300">
          <h3 class="text-sm">Sweep Mode</h3>
          <p class="text-green-600 dark:text-green-400 font-bold">Enabled</p>
      </div>
  </section>

  <!-- my graph .js part ----- -->
  <!-- Amount Spent Chart -->
  <!-- <section class="p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Amount Spent Over Time</h3>
                <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg border border-gray-300 dark:border-gray-700">
                    <canvas id="amountSpentChart" height="100"></canvas>
                </div>
            </section> -->

  <!-- end---- -->

  <!-- Token Drained Table -->
  <section class="px-6 pb-6">
      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold mb-4">Tokens Drained</h3>
          <div class="overflow-x-auto">
              <table class="min-w-full text-sm text-left text-gray-200">
                  <thead class="bg-gray-700 text-gray-300">
                      <tr>
                          <th class="px-4 py-2">Token</th>
                          <th class="px-4 py-2">Amount</th>
                          <th class="px-4 py-2">Wallet</th>
                          <th class="px-4 py-2">Date</th>
                          <th class="px-4 py-2">Status</th>
                      </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-700">
                      <tr>
                          <td class="px-4 py-2">USDT</td>
                          <td class="px-4 py-2">1200</td>
                          <td class="px-4 py-2 truncate">0xabcdef1234567890</td>
                          <td class="px-4 py-2">2025-06-05</td>
                          <td class="px-4 py-2"><span
                                  class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">Success</span>
                          </td>
                      </tr>
                      <tr>
                          <td class="px-4 py-2">ETH</td>
                          <td class="px-4 py-2">0.8</td>
                          <td class="px-4 py-2 truncate">0x9876543210fedcba</td>
                          <td class="px-4 py-2">2025-06-04</td>
                          <td class="px-4 py-2"><span
                                  class="bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded">Pending</span>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </section>



  <!-- Wallet Chart Section -->
  <section class="px-6 pb-6">
      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold mb-4">Wallet Activity (Monthly)</h3>
          <div class="w-full overflow-x-auto">
              <canvas id="walletChart" height="100"></canvas>
          </div>
      </div>
  </section>

  <!-- Wallets Table -->
  <section x-data="walletsComponent()" class="p-6">

      <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Wallets</h3>
          <button
              @click="openAddModal()"
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
                  <template x-for="(wallet, index) in wallets" :key="index">
                      <tr>
                          <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="wallet.address" :title="wallet.address"></td>
                          <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="formatBalance(wallet.balance)"></td>
                          <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" x-text="wallet.type"></td>
                          <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                              <div class="flex gap-2">
                                  <!-- Edit Button -->
                                  <button
                                      @click="openEditModal(index)"
                                      class="flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-yellow-400">
                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"></path>
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18"></path>
                                      </svg>
                                      Edit
                                  </button>

                                  <!-- Delete Button -->
                                  <button
                                      @click="deleteWallet(index)"
                                      class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-red-400">
                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                      </svg>
                                      Delete
                                  </button>
                              </div>
                          </td>
                      </tr>
                  </template>
                  <template x-if="wallets.length === 0">
                      <tr>
                          <td colspan="4" class="px-4 py-2 text-center text-gray-600 dark:text-gray-400">No wallets added yet.</td>
                      </tr>
                  </template>
              </tbody>
          </table>
      </div>

      <!-- Add/Edit Wallet Modal -->
      <div x-show="modalOpen" x-cloak
          class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
          <div @click.away="closeModal()"
              class="bg-white dark:bg-gray-900 rounded-lg shadow-lg max-w-md w-full p-6 space-y-4">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200" x-text="isEditing ? 'Edit Wallet' : 'Add New Wallet'"></h2>

              <form @submit.prevent="submitForm()">
                  <div class="flex flex-col">
                      <label for="address" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                      <input type="text" id="address" x-model="currentWallet.address" required
                          class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                  </div>

                  <div class="flex flex-col">
                      <label for="balance" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Balance</label>
                      <input type="number" id="balance" x-model.number="currentWallet.balance" min="0" step="0.01" required
                          class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                  </div>

                  <div class="flex flex-col">
                      <label for="type" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                      <select id="type" x-model="currentWallet.type"
                          class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                          <option value="Source">Source</option>
                          <option value="Destination">Destination</option>
                      </select>
                  </div>

                  <div class="flex justify-end gap-2 mt-4">
                      <button type="button" @click="closeModal()"
                          class="px-4 py-2 rounded bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                          Cancel
                      </button>
                      <button type="submit"
                          class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                          <span x-text="isEditing ? 'Save Changes' : 'Add Wallet'"></span>
                      </button>
                  </div>
              </form>
          </div>
      </div>

  </section>




  <!-- Sweep Settings -->
  <section class="p-6">
      <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-200">Sweep Settings</h3>
      <form id="sweepSettingsForm"
          class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-100 dark:bg-gray-800 p-6 rounded-lg border border-gray-300 dark:border-gray-700"
          novalidate>

          <!-- Sweep Mode -->
          <div class="flex flex-col">
              <label for="sweepMode" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sweep
                  Mode</label>
              <select id="sweepMode" name="sweepMode"
                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                  <option value="auto">Automatic</option>
                  <option value="manual">Manual</option>
              </select>
          </div>

          <!-- Sweep Status -->
          <div class="flex flex-col">
              <label for="sweepStatus" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sweep
                  Status</label>
              <select id="sweepStatus" name="sweepStatus"
                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                  <option value="enabled">Enabled</option>
                  <option value="disabled">Disabled</option>
              </select>
          </div>

          <!-- Threshold Amount -->
          <div class="flex flex-col">
              <label for="thresholdAmount"
                  class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Threshold Amount</label>
              <input type="number" id="thresholdAmount" name="thresholdAmount" min="0"
                  step="0.01"
                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="0.00" />
          </div>

          <!-- Destination Wallet -->
          <div class="flex flex-col sm:col-span-2">
              <label for="destinationWallet"
                  class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Destination Wallet
                  Address</label>
              <input type="text" id="destinationWallet" name="destinationWallet"
                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="0x..." />
          </div>

          <!-- Submit Button -->
          <div class="sm:col-span-2 flex justify-end">
              <button type="submit"
                  class="text-sm bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md font-semibold shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                  Save Settings
              </button>
          </div>
      </form>
  </section>



  </section>


  <!-- Payout Panel -->
  <section x-data="payoutComponent()" class="p-6">
      <h3 class="text-lg font-semibold mb-4">Payout</h3>

      <!-- Payout Mode Selection -->
      <div class="mb-4">
          <label class="mr-4">
              <input type="radio" name="payoutMode" value="manual" x-model="payoutMode" />
              Manual
          </label>
          <label>
              <input type="radio" name="payoutMode" value="automatic" x-model="payoutMode" />
              Automatic
          </label>
      </div>

      <!-- Payout Form - only shown if manual -->
      <form x-show="payoutMode === 'manual'" @submit.prevent="sendPayout" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
              <label class="block mb-1">Recipient Address</label>
              <input type="text" x-model="recipientAddress" required
                  class="w-full bg-gray-700 text-white rounded px-3 py-2"
                  placeholder="Recipient wallet address" />
          </div>

          <div>
              <label class="block mb-1">Amount</label>
              <input type="number" x-model.number="amount" min="0.01" step="0.01" required
                  class="w-full bg-gray-700 text-white rounded px-3 py-2"
                  placeholder="Amount to send" />
          </div>

          <div class="sm:col-span-2 text-right">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded text-white">
                  Send Payout
              </button>
          </div>
      </form>

      <!-- Automatic payout info -->
      <div x-show="payoutMode === 'automatic'" class="bg-gray-800 text-gray-200 p-4 rounded">
          <p>Payouts will be processed automatically according to your schedule.</p>
      </div>
  </section>

 


  <!-- Transactions Table -->
  <section class="p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Recent Transactions</h3>
      <div class="overflow-x-auto rounded-lg">
          <table
              class="min-w-full bg-gray-300 dark:bg-gray-800 rounded border border-gray-400 dark:border-gray-700 text-gray-900 dark:text-gray-200">
              <thead>
                  <tr class="border-b border-gray-400 dark:border-gray-700">
                      <th class="px-4 py-2 text-left">Tx Hash</th>
                      <th class="px-4 py-2 text-left">Amount</th>
                      <th class="px-4 py-2 text-left">Status</th>
                      <th class="px-4 py-2 text-left">Timestamp</th>
                      <th class="px-4 py-2 text-left">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="border-b border-gray-400 dark:border-gray-700">
                      <td class="px-4 py-2 truncate" title="0xabcdef123456789abcdef123456789abcdef">
                          0xabcdef123456789...</td>
                      <td class="px-4 py-2">$95.00</td>
                      <td class="px-4 py-2 text-green-500">Success</td>
                      <td class="px-4 py-2">2025-06-06 14:32</td>
                      <td class="px-4 py-2">
                          <button
                              class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-red-400">
                              <!-- Reverse Icon -->
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7">
                                  </path>
                              </svg>
                              Reverse
                          </button>
                      </td>
                  </tr>
                  <tr class="border-b border-gray-400 dark:border-gray-700">
                      <td class="px-4 py-2 truncate" title="0x789xyz654321000000000000000000000000">
                          0x789xyz654321000...</td>
                      <td class="px-4 py-2">$125.00</td>
                      <td class="px-4 py-2 text-yellow-400">Pending</td>
                      <td class="px-4 py-2">2025-06-06 15:45</td>
                      <td class="px-4 py-2">
                          <button
                              class="flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded text-sm focus:outline-none focus:ring focus:ring-yellow-400">
                              <!-- Retry Icon -->
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 4v5h.582M20 20v-5h-.581M5 19a9 9 0 1114 0M4.5 14.5l2.5 2.5 2.5-2.5">
                                  </path>
                              </svg>
                              Retry
                          </button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </section>




  @endsection