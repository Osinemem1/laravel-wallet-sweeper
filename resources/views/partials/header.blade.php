<header
          class="flex justify-between items-center bg-gray-300 dark:bg-gray-800 p-4 shadow sticky top-0 z-50 border-b border-gray-400 dark:border-gray-700">

          <!-- Hamburger button (left) -->
          <button id="hamburgerBtn" aria-label="Toggle sidebar" aria-expanded="false"
                    class="md:hidden p-2 rounded bg-gray-300 dark:bg-gray-800 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring focus:ring-indigo-500">
                    <svg id="hamburgerIcon" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                              <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                              <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
          </button>

          <!-- Spacer to push right side to the right -->
          <div class="flex-1"></div>

          <!-- Right Side: Dark mode toggle + Crypto icon dropdown -->
          <div class="flex items-center space-x-4 relative">
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" aria-label="Toggle dark mode"
                              class="p-2 rounded bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring focus:ring-indigo-500">
                              🌙
                    </button>

                    <!-- Crypto Icon Button -->
                    <div class="relative">
                              <button id="userMenuButton"
                                        class="focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-full p-1 bg-gray-300 dark:bg-gray-700 border-2 border-gray-400 dark:border-gray-600">
                                        <!-- Crypto Coin SVG icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500" fill="none"
                                                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                                            fill="gold" />
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 12h8M8 15h8M8 9h8" />
                                        </svg>
                              </button>

                              <!-- Dropdown Menu -->
                              <div id="userDropdown"
                                        class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded shadow-lg z-50">
                                        <a href="/settings" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">⚙️
                                                  Settings</a>
                                        <a href="/change-password"
                                                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">🔒 Change Password</a>
                                        <form method="POST" action="/logout">
                                                  <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">🚪
                                                            Logout</button>
                                        </form>
                              </div>
                    </div>
          </div>
</header>