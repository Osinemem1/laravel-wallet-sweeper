  <script>
            const sidebar = document.getElementById('sidebar');
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const overlay = document.getElementById('overlay');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');

            hamburgerBtn.addEventListener('click', () => {
                      const isOpen = sidebar.classList.toggle('open');
                      overlay.classList.toggle('show', isOpen);
                      hamburgerBtn.setAttribute('aria-expanded', isOpen);
                      hamburgerIcon.classList.toggle('hidden', isOpen);
                      closeIcon.classList.toggle('hidden', !isOpen);
            });

            overlay.addEventListener('click', () => {
                      sidebar.classList.remove('open');
                      overlay.classList.remove('show');
                      hamburgerBtn.setAttribute('aria-expanded', 'false');
                      hamburgerIcon.classList.remove('hidden');
                      closeIcon.classList.add('hidden');
            });

            // Dark mode toggle logic
            const darkModeToggle = document.getElementById('darkModeToggle');
            const rootElement = document.documentElement;

            // Load stored mode from localStorage or system preference
            function loadDarkModePreference() {
                      const storedMode = localStorage.getItem('darkMode');
                      if (storedMode === 'dark') {
                                rootElement.classList.add('dark');
                                darkModeToggle.textContent = '☀️';
                      } else if (storedMode === 'light') {
                                rootElement.classList.remove('dark');
                                darkModeToggle.textContent = '🌙';
                      } else {
                                // Default: system preference
                                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                                          rootElement.classList.add('dark');
                                          darkModeToggle.textContent = '☀️';
                                } else {
                                          rootElement.classList.remove('dark');
                                          darkModeToggle.textContent = '🌙';
                                }
                      }
            }

            darkModeToggle.addEventListener('click', () => {
                      const isDark = rootElement.classList.toggle('dark');
                      if (isDark) {
                                localStorage.setItem('darkMode', 'dark');
                                darkModeToggle.textContent = '☀️'; // Sun icon for light mode
                      } else {
                                localStorage.setItem('darkMode', 'light');
                                darkModeToggle.textContent = '🌙'; // Moon icon for dark mode
                      }
            });

            loadDarkModePreference();
  </script>




  <!-- ghgjhgvjhgvjhgjkghjkghk -->
  <script>
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');

            userMenuButton.addEventListener('click', () => {
                      userDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                      if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                                userDropdown.classList.add('hidden');
                      }
            });
  </script>


  <!-- for my graph.js part script-->
  <!-- <script>
      const ctx = document.getElementById('amountSpentChart').getContext('2d');
      const amountSpentChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
                  'Sun'
              ], // Replace with dynamic timestamps if needed
              datasets: [{
                  label: 'Amount Spent ($)',
                  data: [120, 90, 150, 75, 200, 180, 220], // Replace with dynamic data
                  borderColor: '#10B981',
                  backgroundColor: 'rgba(16, 185, 129, 0.2)',
                  tension: 0.3,
                  fill: true,
                  pointBackgroundColor: '#10B981',
                  pointBorderColor: '#fff',
                  pointRadius: 5
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      labels: {
                          color: '#e5e7eb' // light text for dark mode
                      }
                  },
                  tooltip: {
                      callbacks: {
                          label: function(context) {
                              return `$${context.parsed.y}`;
                          }
                      }
                  }
              },
              scales: {
                  x: {
                      ticks: {
                          color: '#e5e7eb'
                      },
                      grid: {
                          color: 'rgba(255, 255, 255, 0.05)'
                      }
                  },
                  y: {
                      beginAtZero: true,
                      ticks: {
                          color: '#e5e7eb'
                      },
                      grid: {
                          color: 'rgba(255, 255, 255, 0.05)'
                      }
                  }
              }
          }
      });
  </script> -->

  <!-- end -->

  <script>
            const ctx = document.getElementById('walletChart').getContext('2d');
            const walletChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                datasets: [{
                                          label: 'Total Sent ($)',
                                          data: [500, 1200, 800, 1500, 1000, 4320],
                                          borderColor: 'rgb(34,197,94)',
                                          backgroundColor: 'rgba(34,197,94,0.1)',
                                          fill: true,
                                          tension: 0.4
                                }]
                      },
                      options: {
                                responsive: true,
                                plugins: {
                                          legend: {
                                                    labels: {
                                                              color: 'white'
                                                    }
                                          }
                                },
                                scales: {
                                          x: {
                                                    ticks: {
                                                              color: 'white'
                                                    },
                                                    grid: {
                                                              color: '#374151'
                                                    }
                                          },
                                          y: {
                                                    ticks: {
                                                              color: 'white'
                                                    },
                                                    grid: {
                                                              color: '#374151'
                                                    }
                                          }
                                }
                      }
            });
  </script>

  <!-- for add wallet in admin -->
  <script>
            function walletsComponent() {
                      return {
                                wallets: [{
                                          address: 'TXYZ00001234',
                                          balance: 120,
                                          type: 'Source'
                                }, ],
                                modalOpen: false,
                                isEditing: false,
                                editIndex: null,
                                currentWallet: {
                                          address: '',
                                          balance: '',
                                          type: 'Source'
                                },

                                openAddModal() {
                                          this.isEditing = false;
                                          this.currentWallet = {
                                                    address: '',
                                                    balance: '',
                                                    type: 'Source'
                                          };
                                          this.modalOpen = true;
                                },

                                openEditModal(index) {
                                          this.isEditing = true;
                                          this.editIndex = index;
                                          // Copy wallet data to avoid binding issues
                                          this.currentWallet = Object.assign({}, this.wallets[index]);
                                          this.modalOpen = true;
                                },

                                closeModal() {
                                          this.modalOpen = false;
                                          this.currentWallet = {
                                                    address: '',
                                                    balance: '',
                                                    type: 'Source'
                                          };
                                          this.editIndex = null;
                                },

                                submitForm() {
                                          if (this.isEditing && this.editIndex !== null) {
                                                    // Save changes to existing wallet
                                                    this.wallets[this.editIndex] = Object.assign({}, this.currentWallet);
                                          } else {
                                                    // Add new wallet
                                                    this.wallets.push(Object.assign({}, this.currentWallet));
                                          }
                                          this.closeModal();
                                },

                                deleteWallet(index) {
                                          if (confirm('Are you sure you want to delete this wallet?')) {
                                                    this.wallets.splice(index, 1);
                                          }
                                },

                                formatBalance(balance) {
                                          return '$' + parseFloat(balance).toFixed(2);
                                }
                      }
            }
  </script>

  <!-- for payout -->
  <script>
            function payoutComponent() {
                      return {
                                payoutMode: 'manual', // default mode
                                recipientAddress: '',
                                amount: null,

                                sendPayout() {
                                          if (!this.recipientAddress.trim()) {
                                                    alert('Please enter a recipient address.');
                                                    return;
                                          }
                                          if (!this.amount || this.amount <= 0) {
                                                    alert('Please enter a valid amount.');
                                                    return;
                                          }

                                          alert(`Payout sent!\nRecipient: ${this.recipientAddress}\nAmount: $${this.amount.toFixed(2)}`);

                                          this.recipientAddress = '';
                                          this.amount = null;
                                }
                      }
            }
  </script>