@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
          <div class="mb-6">
                    <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-gray-100">Sweep Settings</h1>
                    <p class="text-gray-700 dark:text-gray-300">Configure your sweep settings here.</p>
          </div>

          <section class="bg-gray-300 dark:bg-gray-800 p-6 rounded-lg border border-gray-400 dark:border-gray-700">
                    <form id="sweepSettingsForm" class="grid grid-cols-1 sm:grid-cols-2 gap-6" novalidate>
                              <!-- Sweep Method -->
                              <div class="flex flex-col">
                                        <label for="sweepMethod" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sweep Method</label>
                                        <select id="sweepMethod" name="sweepMethod"
                                                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-400 hover:border-blue-500 transition">
                                                  <option value="auto">Automatic</option>
                                                  <option value="manual">Manual</option>
                                        </select>
                              </div>

                              <!-- Sweep Status -->
                              <div class="flex flex-col">
                                        <label for="sweepStatus" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sweep Status</label>
                                        <select id="sweepStatus" name="sweepStatus"
                                                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-3 py-2 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-600 transition">
                                                  <option value="enabled">Enabled</option>
                                                  <option value="disabled">Disabled</option>
                                        </select>
                              </div>

                              <!-- Threshold Amount -->
                              <div class="flex flex-col">
                                        <label for="thresholdAmount" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Threshold Amount</label>
                                        <input type="number" id="thresholdAmount" name="thresholdAmount" min="0" step="0.01"
                                                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-blue-400 hover:border-blue-500 transition"
                                                  placeholder="Enter minimum balance e.g. 100.00" />
                              </div>

                              <!-- Destination Wallet -->
                              <div class="flex flex-col sm:col-span-2">
                                        <label for="destinationWallet" class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Destination Wallet Address</label>
                                        <input type="text" id="destinationWallet" name="destinationWallet"
                                                  class="text-sm w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 px-3 py-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-400 hover:border-blue-500 transition"
                                                  placeholder="0x..." />
                              </div>

                              <!-- Submit Button -->
                              <div class="sm:col-span-2 flex justify-end mt-4">
                                        <button type="submit"
                                                  class="text-sm bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-semibold shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                                                  Save Settings
                                        </button>
                              </div>
                    </form>
          </section>
</div>
@endsection