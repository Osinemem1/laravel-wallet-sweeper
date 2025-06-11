   <aside id="sidebar"
             class="bg-gray-300 dark:bg-gray-800 p-6 space-y-4 overflow-y-auto w-full md:w-64 flex-shrink-0 md:h-screen md:sticky md:top-0 fixed md:relative top-0 left-0 h-full z-30"
             role="navigation" aria-label="Main sidebar navigation">
             <h1 class="text-2xl font-bold text-gray-900 dark:text-white">⚡ WalletBot</h1>
             <nav class="space-y-3">
                       <a href="{{ route('dashboard') }}"
                                 class="block hover:bg-gray-400 dark:hover:bg-gray-700 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-indigo-400 text-gray-900 dark:text-gray-200"
                                 tabindex="0">Dashboard</a>
                       <a href="{{ route('wallets.index') }}"
                                 class="block hover:bg-gray-400 dark:hover:bg-gray-700 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-indigo-400 text-gray-900 dark:text-gray-200"
                                 tabindex="0">Wallets</a>
                       <a href="{{ route('sweep-settings') }}"
                                 class="block hover:bg-gray-400 dark:hover:bg-gray-700 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-indigo-400 text-gray-900 dark:text-gray-200"
                                 tabindex="0">Sweep Settings</a>
                       <a href="{{ route('payout') }}"
                                 class="block hover:bg-gray-400 dark:hover:bg-gray-700 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-indigo-400 text-gray-900 dark:text-gray-200"
                                 tabindex="0">Payout</a>
                       <a href="{{ route('transactions') }}"
                                 class="block hover:bg-gray-400 dark:hover:bg-gray-700 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-indigo-400 text-gray-900 dark:text-gray-200"
                                 tabindex="0">Transactions</a>
             </nav>
   </aside>