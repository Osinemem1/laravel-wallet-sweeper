@extends('layouts.app')

@section('content')
<section class="p-6">
          <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Transactions</h3>
          </div>

          <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full bg-gray-300 dark:bg-gray-800 rounded border-collapse border border-gray-400 dark:border-gray-700 overflow-hidden text-gray-900 dark:text-gray-200">
                              <thead>
                                        <tr>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Tx Hash</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Amount</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Type</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Status</th>
                                                  <th class="px-4 py-2 text-left border-b border-gray-400 dark:border-gray-700">Date</th>
                                        </tr>
                              </thead>
                              <tbody>
                                        <tr>
                                                  <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700" title="0xabc123...def">0xabc...def</td>
                                                  <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">$150</td>
                                                  <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">Sweep</td>
                                                  <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">
                                                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-sm">Success</span>
                                                  </td>
                                                  <td class="px-4 py-2 border-b border-gray-400 dark:border-gray-700">2025-06-07</td>
                                        </tr>
                              </tbody>
                    </table>
          </div>
</section>
@endsection