import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('auth-container');
    const btnSignUp = document.getElementById('go-to-signup');
    const btnSignIn = document.getElementById('go-to-signin');

    // Slide & Fade Transitions Toggle
    if (btnSignUp && container) {
        btnSignUp.addEventListener('click', () => {
            container.classList.add('active');
        });
    }

    if (btnSignIn && container) {
        btnSignIn.addEventListener('click', () => {
            container.classList.remove('active');
        });
    }

    // Universal Toggle Password Visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const relativeWrapper = button.closest('.relative');
            const passwordInput = relativeWrapper.querySelector('input');
            const eyeIconPath = button.querySelector('.eye-path');
            
            const svg = button.querySelector('svg');
            if (passwordInput && eyeIconPath) {
                // Trigger pop animation
                if (svg) {
                    svg.classList.add('eye-pop-active');
                    svg.addEventListener('animationend', () => {
                        svg.classList.remove('eye-pop-active');
                    }, { once: true });
                }

                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                if (isPassword) {
                    // Path for Eye Open
                    eyeIconPath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
                } else {
                    // Path for Eye Slash (Hidden)
                    eyeIconPath.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3');
                }
            }
        });
    });

    // Mobile Sidebar Toggle & Overlay Logic
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (mobileSidebarToggle && sidebar && sidebarOverlay) {
        // Open Sidebar
        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            sidebarOverlay.classList.remove('hidden');
        });

        // Close Sidebar (when clicking outside on overlay)
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            sidebarOverlay.classList.add('hidden');
        });
    }

    // ==================== CUSTOM STATUS DROPDOWN & FILTER LOGIC ====================
    const statusDropdown = document.getElementById('status-dropdown');
    const statusBtn = document.getElementById('status-dropdown-button');
    const statusMenu = document.getElementById('status-dropdown-menu');
    const statusInput = document.getElementById('status-filter-input');
    const statusSelectedLabel = document.getElementById('status-selected-label');
    const searchInput = document.getElementById('search-input');
    const buildingTabs = document.querySelectorAll('.building-tab');
    const roomCards = document.querySelectorAll('.room-card');
    const emptyState = document.getElementById('empty-state');

    // Filter state
    let activeFilters = {
        search: '',
        status: 'all',
        building: 'all'
    };

    // Filter execution
    function applyFilters() {
        let visibleCount = 0;

        roomCards.forEach(card => {
            const cardName = (card.getAttribute('data-name') || '').toLowerCase();
            const cardStatus = card.getAttribute('data-status') || '';
            const cardBuilding = card.getAttribute('data-building') || '';

            const matchesSearch = activeFilters.search === '' || cardName.includes(activeFilters.search);
            const matchesStatus = activeFilters.status === 'all' || cardStatus === activeFilters.status;
            const matchesBuilding = activeFilters.building === 'all' || cardBuilding === activeFilters.building;

            if (matchesSearch && matchesStatus && matchesBuilding) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    // Dropdown toggle
    if (statusBtn && statusMenu) {
        statusBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isExpanded = statusBtn.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                statusBtn.setAttribute('aria-expanded', 'false');
                statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.add('pointer-events-none');
                statusBtn.querySelector('svg').classList.remove('rotate-180');
            } else {
                statusBtn.setAttribute('aria-expanded', 'true');
                statusMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.add('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.remove('pointer-events-none');
                statusBtn.querySelector('svg').classList.add('rotate-180');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            statusBtn.setAttribute('aria-expanded', 'false');
            statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            statusMenu.classList.add('pointer-events-none');
            const svg = statusBtn.querySelector('svg');
            if (svg) svg.classList.remove('rotate-180');
        });

        // Option selection
        const options = statusMenu.querySelectorAll('.status-option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = option.getAttribute('data-value');
                const labelText = option.innerText.trim();

                // Update input
                if (statusInput) statusInput.value = val;

                // Update button trigger UI
                if (statusSelectedLabel) {
                    if (val === 'tersedia') {
                        statusSelectedLabel.innerHTML = `
                            <span class="relative flex h-2 w-2 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-teal-600">${labelText}</span>
                        `;
                    } else if (val === 'terpakai') {
                        statusSelectedLabel.innerHTML = `
                            <span class="w-2 h-2 rounded-full bg-rose-500 shrink-0"></span>
                            <span class="text-rose-600">${labelText}</span>
                        `;
                    } else {
                        statusSelectedLabel.innerHTML = `
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="text-slate-600">${labelText}</span>
                        `;
                    }
                }

                // Close dropdown
                statusBtn.setAttribute('aria-expanded', 'false');
                statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.add('pointer-events-none');
                statusBtn.querySelector('svg').classList.remove('rotate-180');

                // Apply filter
                activeFilters.status = val;
                applyFilters();
            });
        });
    }

    // Search bar event
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            activeFilters.search = e.target.value.toLowerCase().trim();
            applyFilters();
        });
    }

    // Building tabs event
    if (buildingTabs.length > 0) {
        buildingTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active classes from all tabs
                buildingTabs.forEach(t => {
                    t.className = 'building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50';
                });

                // Add active classes to selected tab
                tab.className = 'building-tab px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl transition-all whitespace-nowrap';

                // Filter
                activeFilters.building = tab.getAttribute('data-building') || 'all';
                applyFilters();
            });
        });
    }
});
