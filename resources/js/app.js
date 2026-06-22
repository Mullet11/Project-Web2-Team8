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

    // Check if redirect from successful registration
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('registered') && container) {
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.classList.remove('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100');
        }
        
        // Wait 1.8 seconds, then slide/transition back to sign-in smoothly
        setTimeout(() => {
            container.classList.remove('active');
            
            // Clean up url query param without reload
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.pushState({ path: newUrl }, '', newUrl);

            // Hide toast after transition starts
            setTimeout(() => {
                if (toast) {
                    toast.classList.add('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
                    toast.classList.remove('translate-y-0', 'opacity-100');
                }
            }, 600);
        }, 1800);
    }

    // Clean up url query param for login without reload
    if (urlParams.has('login')) {
        setTimeout(() => {
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.pushState({ path: newUrl }, '', newUrl);
        }, 1000);
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

    // ==================== CUSTOM DROPDOWN & FILTER LOGIC ====================
    const statusDropdown = document.getElementById('status-dropdown');
    const statusBtn = document.getElementById('status-dropdown-button');
    const statusMenu = document.getElementById('status-dropdown-menu');
    const statusInput = document.getElementById('status-filter-input');
    const statusSelectedLabel = document.getElementById('status-selected-label');

    const facultyDropdown = document.getElementById('faculty-dropdown');
    const facultyBtn = document.getElementById('faculty-dropdown-button');
    const facultyMenu = document.getElementById('faculty-dropdown-menu');
    const facultyInput = document.getElementById('faculty-filter-input');
    const facultySelectedLabel = document.getElementById('faculty-selected-label');

    const campusDropdown = document.getElementById('campus-dropdown');
    const campusBtn = document.getElementById('campus-dropdown-button');
    const campusMenu = document.getElementById('campus-dropdown-menu');
    const campusInput = document.getElementById('campus-filter-input');
    const campusSelectedLabel = document.getElementById('campus-selected-label');

    const filterInstruction = document.getElementById('filter-instruction');
    const buildingFiltersSection = document.getElementById('building-filters-section');
    const buildingFiltersDivider = document.getElementById('building-filters-divider');
    const typeFiltersSection = document.getElementById('type-filters-section');
    const typeFiltersDivider = document.getElementById('type-filters-divider');
    const searchInput = document.getElementById('search-input');
    const buildingTabs = document.querySelectorAll('.building-tab');
    const typeTabs = document.querySelectorAll('.type-tab');
    const roomCards = document.querySelectorAll('.room-card');
    const emptyState = document.getElementById('empty-state');

    // Filter state
    let activeFilters = {
        search: '',
        status: 'all',
        building: 'all',
        type: 'all',
        campus: '',
        faculty: ''
    };
    let showAllTriggered = false;



    function updateDropdownOptions() {
        // Keep all campus dropdown options visible at all times
        if (campusMenu) {
            const campusOptions = campusMenu.querySelectorAll('.campus-option');
            campusOptions.forEach(opt => {
                opt.style.display = '';
            });
        }

        // Keep all faculty dropdown options visible at all times
        if (facultyMenu) {
            const facultyOptions = facultyMenu.querySelectorAll('.faculty-option');
            facultyOptions.forEach(opt => {
                opt.style.display = '';
            });
        }
    }

    function updateTypeTabs() {
        if ((!activeFilters.campus && !activeFilters.faculty && !activeFilters.search) && !showAllTriggered) {
            // Hide the type tabs and divider
            if (typeFiltersSection) typeFiltersSection.classList.add('hidden');
            if (typeFiltersDivider) typeFiltersDivider.classList.add('hidden');
            return;
        }

        // Show the type tabs and divider
        if (typeFiltersSection) typeFiltersSection.classList.remove('hidden');
        if (typeFiltersDivider) typeFiltersDivider.classList.remove('hidden');

        // Always show all type tabs
        typeTabs.forEach(tab => {
            tab.style.display = '';
        });
    }

    // Filter execution
    function applyFilters() {
        // Show/hide Reset button dynamically
        const isFiltering = activeFilters.search !== '' || 
                            activeFilters.status !== 'all' || 
                            activeFilters.building !== 'all' || 
                            activeFilters.type !== 'all' || 
                            activeFilters.campus !== '' || 
                            activeFilters.faculty !== '' ||
                            showAllTriggered;
        const resetBtn = document.getElementById('btn-reset-filter');
        if (resetBtn) {
            if (isFiltering) {
                resetBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                resetBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        updateTypeTabs();
        updateDropdownOptions();

        if ((!activeFilters.campus && !activeFilters.faculty && !activeFilters.search) && !showAllTriggered) {
            // Hide all room cards
            roomCards.forEach(card => {
                card.style.display = 'none';
            });
            // Show instruction and hide empty state
            if (filterInstruction) filterInstruction.classList.remove('hidden');
            if (emptyState) emptyState.classList.add('hidden');
            // Hide sections
            if (typeFiltersSection) typeFiltersSection.classList.add('hidden');
            if (typeFiltersDivider) typeFiltersDivider.classList.add('hidden');
            return;
        }

        // Hide instruction
        if (filterInstruction) filterInstruction.classList.add('hidden');

        let visibleCount = 0;

        roomCards.forEach(card => {
            const cardName = (card.getAttribute('data-name') || '').toLowerCase();
            const cardStatus = card.getAttribute('data-status') || '';
            const cardBuilding = card.getAttribute('data-building') || '';
            const cardType = card.getAttribute('data-type') || '';
            const cardCampus = card.getAttribute('data-campus') || '';
            const cardFaculty = (card.getAttribute('data-faculty') || '').toLowerCase();

            const matchesSearch = activeFilters.search === '' || cardName.includes(activeFilters.search);
            const matchesStatus = activeFilters.status === 'all' || cardStatus === activeFilters.status;
            const matchesBuilding = activeFilters.building === 'all' || cardBuilding === activeFilters.building;
            const matchesType = activeFilters.type === 'all' || cardType === activeFilters.type;
            const matchesCampus = activeFilters.campus === '' || cardCampus === activeFilters.campus;
            const matchesFaculty = activeFilters.faculty === '' || cardFaculty === activeFilters.faculty.toLowerCase();

            if (matchesSearch && matchesStatus && matchesBuilding && matchesType && matchesCampus && matchesFaculty) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update category section headers and grids visibility
        const categorySections = document.querySelectorAll('.category-section');
        categorySections.forEach(section => {
            const visibleCardsInSection = section.querySelectorAll('.room-card:not([style*="display: none"])');
            if (visibleCardsInSection.length > 0) {
                section.style.display = '';
            } else {
                section.style.display = 'none';
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

    // Status Dropdown toggle
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

            // Close other dropdowns
            if (facultyBtn && facultyMenu) {
                facultyBtn.setAttribute('aria-expanded', 'false');
                facultyMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                facultyMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                facultyMenu.classList.add('pointer-events-none');
                facultyBtn.querySelector('svg').classList.remove('rotate-180');
            }
            if (campusBtn && campusMenu) {
                campusBtn.setAttribute('aria-expanded', 'false');
                campusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                campusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                campusMenu.classList.add('pointer-events-none');
                const svg = campusBtn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');
            }
        });

        // Option selection
        const options = statusMenu.querySelectorAll('.status-option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = option.getAttribute('data-value');
                const labelText = option.innerText.trim();

                if (statusInput) statusInput.value = val;

                if (statusSelectedLabel) {
                    if (val === 'tersedia') {
                        statusSelectedLabel.innerHTML = `
                            <span class="relative flex h-2 w-2 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-teal-600 truncate">${labelText}</span>
                        `;
                    } else if (val === 'terpakai') {
                        statusSelectedLabel.innerHTML = `
                            <span class="w-2 h-2 rounded-full bg-rose-500 shrink-0"></span>
                            <span class="text-rose-600 truncate">${labelText}</span>
                        `;
                    } else {
                        statusSelectedLabel.innerHTML = `
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="text-slate-600 truncate">${labelText}</span>
                        `;
                    }
                }

                statusBtn.setAttribute('aria-expanded', 'false');
                statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.add('pointer-events-none');
                statusBtn.querySelector('svg').classList.remove('rotate-180');

                activeFilters.status = val;
                applyFilters();
            });
        });
    }

    // Faculty Dropdown toggle
    if (facultyBtn && facultyMenu) {
        facultyBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isExpanded = facultyBtn.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                facultyBtn.setAttribute('aria-expanded', 'false');
                facultyMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                facultyMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                facultyMenu.classList.add('pointer-events-none');
                facultyBtn.querySelector('svg').classList.remove('rotate-180');
            } else {
                facultyBtn.setAttribute('aria-expanded', 'true');
                facultyMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                facultyMenu.classList.add('opacity-100', 'visible', 'scale-100');
                facultyMenu.classList.remove('pointer-events-none');
                facultyBtn.querySelector('svg').classList.add('rotate-180');
            }

            // Close other dropdowns
            if (statusBtn && statusMenu) {
                statusBtn.setAttribute('aria-expanded', 'false');
                statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.add('pointer-events-none');
                statusBtn.querySelector('svg').classList.remove('rotate-180');
            }
            if (campusBtn && campusMenu) {
                campusBtn.setAttribute('aria-expanded', 'false');
                campusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                campusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                campusMenu.classList.add('pointer-events-none');
                const svg = campusBtn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');
            }
        });

        // Option selection
        const options = facultyMenu.querySelectorAll('.faculty-option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = option.getAttribute('data-value');
                const labelText = option.innerText.trim();

                if (facultyInput) facultyInput.value = val;

                if (facultySelectedLabel) {
                    if (val === 'all') {
                        facultySelectedLabel.innerHTML = `
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="text-slate-600 truncate">${labelText}</span>
                        `;
                    } else {
                        const bulletSpan = option.querySelector('span');
                        const bulletClass = bulletSpan ? bulletSpan.className + ' shrink-0' : 'w-2 h-2 rounded-full bg-blue-500 shrink-0';
                        facultySelectedLabel.innerHTML = `
                            <span class="${bulletClass}"></span>
                            <span class="text-slate-600 truncate">${labelText}</span>
                        `;
                    }
                }

                facultyBtn.setAttribute('aria-expanded', 'false');
                facultyMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                facultyMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                facultyMenu.classList.add('pointer-events-none');
                facultyBtn.querySelector('svg').classList.remove('rotate-180');

                showAllTriggered = false;
                activeFilters.faculty = val;
                applyFilters();
            });
        });
    }

    // Campus Dropdown toggle
    if (campusBtn && campusMenu) {
        campusBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isExpanded = campusBtn.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                campusBtn.setAttribute('aria-expanded', 'false');
                campusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                campusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                campusMenu.classList.add('pointer-events-none');
                campusBtn.querySelector('svg').classList.remove('rotate-180');
            } else {
                campusBtn.setAttribute('aria-expanded', 'true');
                campusMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                campusMenu.classList.add('opacity-100', 'visible', 'scale-100');
                campusMenu.classList.remove('pointer-events-none');
                campusBtn.querySelector('svg').classList.add('rotate-180');
            }

            // Close other dropdowns
            if (statusBtn && statusMenu) {
                statusBtn.setAttribute('aria-expanded', 'false');
                statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                statusMenu.classList.add('pointer-events-none');
                const svg = statusBtn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');
            }
            if (facultyBtn && facultyMenu) {
                facultyBtn.setAttribute('aria-expanded', 'false');
                facultyMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                facultyMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                facultyMenu.classList.add('pointer-events-none');
                const svg = facultyBtn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');
            }
        });

        // Option selection
        const options = campusMenu.querySelectorAll('.campus-option');
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = option.getAttribute('data-value');
                const labelText = option.innerText.trim();

                if (campusInput) campusInput.value = val;

                if (campusSelectedLabel) {
                    const bulletSpan = option.querySelector('span');
                    const bulletClass = bulletSpan ? bulletSpan.className + ' shrink-0' : 'w-2 h-2 rounded-full bg-slate-400 shrink-0';
                    campusSelectedLabel.innerHTML = `
                        <span class="${bulletClass}"></span>
                        <span class="text-slate-600 truncate">${labelText}</span>
                    `;
                }

                campusBtn.setAttribute('aria-expanded', 'false');
                campusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                campusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                campusMenu.classList.add('pointer-events-none');
                campusBtn.querySelector('svg').classList.remove('rotate-180');

                showAllTriggered = false;
                activeFilters.campus = val;
                applyFilters();
            });
        });
    }

    // Global document click to close dropdowns
    document.addEventListener('click', () => {
        if (statusBtn && statusMenu) {
            statusBtn.setAttribute('aria-expanded', 'false');
            statusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            statusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            statusMenu.classList.add('pointer-events-none');
            const svg = statusBtn.querySelector('svg');
            if (svg) svg.classList.remove('rotate-180');
        }
        if (facultyBtn && facultyMenu) {
            facultyBtn.setAttribute('aria-expanded', 'false');
            facultyMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            facultyMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            facultyMenu.classList.add('pointer-events-none');
            const svg = facultyBtn.querySelector('svg');
            if (svg) svg.classList.remove('rotate-180');
        }
        if (campusBtn && campusMenu) {
            campusBtn.setAttribute('aria-expanded', 'false');
            campusMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            campusMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            campusMenu.classList.add('pointer-events-none');
            const svg = campusBtn.querySelector('svg');
            if (svg) svg.classList.remove('rotate-180');
        }
    });

    // Search bar event
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            activeFilters.search = e.target.value.toLowerCase().trim();
            applyFilters();
        });
    }

    // Show All Rooms button event
    const showAllBtn = document.getElementById('show-all-rooms-btn');
    if (showAllBtn) {
        showAllBtn.addEventListener('click', () => {
            showAllTriggered = true;
            applyFilters();
        });
    }

    // Reset Filter Button click handler
    const resetBtn = document.getElementById('btn-reset-filter');
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            // Reset active filters
            activeFilters.search = '';
            activeFilters.status = 'all';
            activeFilters.building = 'all';
            activeFilters.type = 'all';
            activeFilters.campus = '';
            activeFilters.faculty = '';
            showAllTriggered = false;

            // Reset search input
            if (searchInput) searchInput.value = '';

            // Reset campus dropdown label & value
            if (campusInput) campusInput.value = '';
            if (campusSelectedLabel) {
                campusSelectedLabel.innerHTML = `
                    <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                    <span class="truncate">Pilih Lokasi</span>
                `;
            }

            // Reset faculty dropdown label & value
            if (facultyInput) facultyInput.value = '';
            if (facultySelectedLabel) {
                facultySelectedLabel.innerHTML = `
                    <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                    <span class="truncate">Pilih Fakultas</span>
                `;
            }

            // Reset status dropdown label & value
            if (statusInput) statusInput.value = 'all';
            if (statusSelectedLabel) {
                statusSelectedLabel.innerHTML = `
                    <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                    <span class="truncate">Semua Status</span>
                `;
            }

            // Reset Type Tabs style
            if (typeTabs.length > 0) {
                typeTabs.forEach(t => {
                    t.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-500/10');
                    t.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'shadow-sm', 'hover:bg-slate-50', 'hover:text-slate-900');
                    if (t.getAttribute('data-type') === 'all') {
                        t.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'shadow-sm', 'hover:bg-slate-50', 'hover:text-slate-900');
                        t.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-500/10');
                    }
                });
            }

            // Reset Building Tabs if any
            if (buildingTabs.length > 0) {
                buildingTabs.forEach(t => {
                    t.className = 'building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50 cursor-pointer';
                    if ((t.getAttribute('data-building') || 'all') === 'all') {
                        t.className = 'building-tab px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl transition-all whitespace-nowrap cursor-pointer';
                    }
                });
            }

            applyFilters();
        });
    }

    // Building tabs event
    if (buildingTabs.length > 0) {
        buildingTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                buildingTabs.forEach(t => {
                    t.className = 'building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50 cursor-pointer';
                });
                tab.className = 'building-tab px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl transition-all whitespace-nowrap cursor-pointer';

                activeFilters.building = tab.getAttribute('data-building') || 'all';
                applyFilters();
            });
        });
    }
    // Type tabs event
    if (typeTabs.length > 0) {
        typeTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                typeTabs.forEach(t => {
                    t.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-500/10');
                    t.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'shadow-sm', 'hover:bg-slate-50', 'hover:text-slate-900');
                });
                tab.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'shadow-sm', 'hover:bg-slate-50', 'hover:text-slate-900');
                tab.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-500/10');

                activeFilters.type = tab.getAttribute('data-type') || 'all';
                applyFilters();
            });
        });
    }
});
