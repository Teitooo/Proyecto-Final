// Catalog Page JavaScript

// Pagination Settings
let currentPage = 1;
const productsPerPage = 9;
let catalogFilteredProducts = [...products];
let currentView = 'grid';

// Filter State
let activeFilters = {
    search: '',
    categories: [],
    brands: [],
    zones: [],
    minPrice: 0,
    maxPrice: 20000,
    sort: 'name-asc'
};

// Catalog Filter Products
function catalogFilterProducts() {
    // Get search term
    const searchInput = document.getElementById('catalogSearch');
    if (searchInput) {
        activeFilters.search = searchInput.value.toLowerCase();
    }

    // Get selected categories
    const categoryCheckboxes = document.querySelectorAll('#categoryFilters input[type="checkbox"]:checked');
    activeFilters.categories = Array.from(categoryCheckboxes)
        .map(cb => cb.value)
        .filter(v => v !== '');

    // Get selected brands
    const brandCheckboxes = document.querySelectorAll('#brandFilters input[type="checkbox"]:checked');
    activeFilters.brands = Array.from(brandCheckboxes)
        .map(cb => cb.value)
        .filter(v => v !== '');

    // Get selected zones
    const zoneCheckboxes = document.querySelectorAll('#zoneFilters input[type="checkbox"]:checked');
    activeFilters.zones = Array.from(zoneCheckboxes)
        .map(cb => cb.value)
        .filter(v => v !== '');

    // Get price range
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    if (minPriceInput) activeFilters.minPrice = parseFloat(minPriceInput.value) || 0;
    if (maxPriceInput) activeFilters.maxPrice = parseFloat(maxPriceInput.value) || 20000;

    // Get sort option
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        activeFilters.sort = sortSelect.value;
    }

    // Apply filters
    catalogFilteredProducts = products.filter(product => {
        // Search filter
        const matchesSearch = !activeFilters.search || 
            product.name.toLowerCase().includes(activeFilters.search) ||
            product.brand.toLowerCase().includes(activeFilters.search) ||
            product.description.toLowerCase().includes(activeFilters.search);

        // Category filter
        const matchesCategory = activeFilters.categories.length === 0 || 
            activeFilters.categories.includes(product.category);

        // Brand filter
        const matchesBrand = activeFilters.brands.length === 0 || 
            activeFilters.brands.includes(product.brand);

        // Zone filter
        const matchesZone = activeFilters.zones.length === 0 || 
            activeFilters.zones.includes(product.zone);

        // Price filter
        const matchesPrice = product.price >= activeFilters.minPrice && 
            product.price <= activeFilters.maxPrice;

        return matchesSearch && matchesCategory && matchesBrand && matchesZone && matchesPrice;
    });

    // Apply sorting
    catalogFilteredProducts = sortProducts(catalogFilteredProducts, activeFilters.sort);

    // Reset to first page
    currentPage = 1;

    // Render products and pagination
    renderCatalogProducts();
    renderPagination();
    updateResultsCount();
}

// Sort Products
function sortProducts(productsArray, sortType) {
    const sorted = [...productsArray];
    
    switch(sortType) {
        case 'name-asc':
            return sorted.sort((a, b) => a.name.localeCompare(b.name));
        case 'name-desc':
            return sorted.sort((a, b) => b.name.localeCompare(a.name));
        case 'price-asc':
            return sorted.sort((a, b) => a.price - b.price);
        case 'price-desc':
            return sorted.sort((a, b) => b.price - a.price);
        case 'brand':
            return sorted.sort((a, b) => a.brand.localeCompare(b.brand));
        default:
            return sorted;
    }
}

// Render Catalog Products
function renderCatalogProducts() {
    const grid = document.getElementById('catalogProductsGrid');
    
    if (!grid) return;

    // Calculate pagination
    const startIndex = (currentPage - 1) * productsPerPage;
    const endIndex = startIndex + productsPerPage;
    const paginatedProducts = catalogFilteredProducts.slice(startIndex, endIndex);

    if (paginatedProducts.length === 0) {
        grid.innerHTML = `
            <div class="catalog-empty">
                <i class="fas fa-box-open"></i>
                <h3>No se encontraron productos</h3>
                <p>Intenta ajustar tus filtros de búsqueda</p>
                <button class="btn btn-primary" onclick="resetFilters()">Limpiar Filtros</button>
            </div>
        `;
        return;
    }

    grid.className = `catalog-products-grid view-${currentView}`;
    
    grid.innerHTML = paginatedProducts.map(product => `
        <div class="product-card" onclick="openProductDetail(${product.id})">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="product-info">
                <span class="product-category">${getCategoryName(product.category)}</span>
                <div class="product-rating">
                    <div class="product-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="product-reviews">(${Math.floor(Math.random() * 50) + 10} reviews)</span>
                </div>
                <h3 class="product-name">${product.name}</h3>
                <p class="product-brand">${product.brand}</p>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                <div class="product-actions">
                    <button class="btn btn-primary btn-add-to-cart" onclick="event.stopPropagation(); addToCart(${product.id})">
                        <i class="fas fa-shopping-cart"></i>
                        Agregar al Carrito
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// Render Pagination
function renderPagination() {
    const pagination = document.getElementById('catalogPagination');
    
    if (!pagination) return;

    const totalPages = Math.ceil(catalogFilteredProducts.length / productsPerPage);

    if (totalPages <= 1) {
        pagination.innerHTML = '';
        return;
    }

    let paginationHTML = '';

    // Previous button
    paginationHTML += `
        <button class="pagination-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="goToPage(${currentPage - 1})">
            <i class="fas fa-chevron-left"></i>
        </button>
    `;

    // Page numbers
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    if (startPage > 1) {
        paginationHTML += `
            <button class="pagination-btn" onclick="goToPage(1)">1</button>
        `;
        if (startPage > 2) {
            paginationHTML += `<span class="pagination-dots">...</span>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `
            <button class="pagination-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">
                ${i}
            </button>
        `;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationHTML += `<span class="pagination-dots">...</span>`;
        }
        paginationHTML += `
            <button class="pagination-btn" onclick="goToPage(${totalPages})">${totalPages}</button>
        `;
    }

    // Next button
    paginationHTML += `
        <button class="pagination-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="goToPage(${currentPage + 1})">
            <i class="fas fa-chevron-right"></i>
        </button>
    `;

    pagination.innerHTML = paginationHTML;
}

// Go to Page
function goToPage(page) {
    const totalPages = Math.ceil(catalogFilteredProducts.length / productsPerPage);
    
    if (page < 1 || page > totalPages) return;
    
    currentPage = page;
    renderCatalogProducts();
    renderPagination();
    
    // Scroll to top of products
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Update Results Count
function updateResultsCount() {
    const resultsCount = document.getElementById('resultsCount');
    
    if (!resultsCount) return;

    const total = catalogFilteredProducts.length;
    const startIndex = (currentPage - 1) * productsPerPage + 1;
    const endIndex = Math.min(currentPage * productsPerPage, total);

    if (total === 0) {
        resultsCount.textContent = 'No se encontraron productos';
    } else if (total <= productsPerPage) {
        resultsCount.textContent = `${total} ${total === 1 ? 'producto' : 'productos'}`;
    } else {
        resultsCount.textContent = `Mostrando ${startIndex}-${endIndex} de ${total} productos`;
    }
}

// Change View
function changeView(view) {
    currentView = view;
    
    // Update active button
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-view="${view}"]`).classList.add('active');
    
    // Re-render products with new view
    renderCatalogProducts();
}

// Reset Filters
function resetFilters() {
    // Reset search
    const searchInput = document.getElementById('catalogSearch');
    if (searchInput) searchInput.value = '';

    // Reset all checkboxes
    document.querySelectorAll('.filter-checkbox input[type="checkbox"]').forEach(cb => {
        cb.checked = cb.value === '';
    });

    // Reset price range
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const priceRange = document.getElementById('priceRange');
    
    if (minPriceInput) minPriceInput.value = 0;
    if (maxPriceInput) maxPriceInput.value = 20000;
    if (priceRange) priceRange.value = 20000;

    // Reset sort
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) sortSelect.value = 'name-asc';

    // Reset filters and re-render
    activeFilters = {
        search: '',
        categories: [],
        brands: [],
        zones: [],
        minPrice: 0,
        maxPrice: 20000,
        sort: 'name-asc'
    };

    catalogFilterProducts();
    showNotification('Filtros reiniciados');
}

// Update Price Range
function updatePriceRange(value) {
    const maxPriceInput = document.getElementById('maxPrice');
    if (maxPriceInput) {
        maxPriceInput.value = value;
    }
    catalogFilterProducts();
}

// Quick Filter by Category
function quickFilterCategory(category) {
    event.preventDefault();
    
    // Reset all category checkboxes
    document.querySelectorAll('#categoryFilters input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });

    // Check the selected category
    const categoryCheckbox = document.querySelector(`#categoryFilters input[value="${category}"]`);
    if (categoryCheckbox) {
        categoryCheckbox.checked = true;
    }

    catalogFilterProducts();
    
    // Scroll to products
    document.querySelector('.catalog-products').scrollIntoView({ behavior: 'smooth' });
}

// Handle checkbox "All" selection
function handleAllCheckbox(groupSelector) {
    const allCheckbox = document.querySelector(`${groupSelector} input[value=""]`);
    const otherCheckboxes = document.querySelectorAll(`${groupSelector} input[type="checkbox"]:not([value=""])`);
    
    if (allCheckbox && allCheckbox.checked) {
        otherCheckboxes.forEach(cb => cb.checked = false);
    }
}

// Setup checkbox event listeners
function setupCheckboxListeners() {
    // Category filters
    document.querySelectorAll('#categoryFilters input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', () => {
            if (cb.value === '' && cb.checked) {
                document.querySelectorAll('#categoryFilters input[type="checkbox"]:not([value=""])').forEach(
                    other => other.checked = false
                );
            } else if (cb.value !== '' && cb.checked) {
                document.querySelector('#categoryFilters input[value=""]').checked = false;
            }
        });
    });

    // Brand filters
    document.querySelectorAll('#brandFilters input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', () => {
            if (cb.value === '' && cb.checked) {
                document.querySelectorAll('#brandFilters input[type="checkbox"]:not([value=""])').forEach(
                    other => other.checked = false
                );
            } else if (cb.value !== '' && cb.checked) {
                document.querySelector('#brandFilters input[value=""]').checked = false;
            }
        });
    });

    // Zone filters
    document.querySelectorAll('#zoneFilters input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', () => {
            if (cb.value === '' && cb.checked) {
                document.querySelectorAll('#zoneFilters input[type="checkbox"]:not([value=""])').forEach(
                    other => other.checked = false
                );
            } else if (cb.value !== '' && cb.checked) {
                document.querySelector('#zoneFilters input[value=""]').checked = false;
            }
        });
    });
}

// Mobile Sidebar Toggle
function toggleSidebar() {
    const sidebar = document.querySelector('.catalog-sidebar');
    if (sidebar) {
        sidebar.classList.toggle('mobile-hidden');
    }
}

// Initialize Catalog Page
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the catalog page
    if (document.getElementById('catalogProductsGrid')) {
        setupCheckboxListeners();
        catalogFilterProducts();
        updateCartBadge();
        
        // Add mobile sidebar toggle button if needed
        if (window.innerWidth < 1024) {
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'sidebar-toggle';
            toggleBtn.innerHTML = '<i class="fas fa-filter"></i>';
            toggleBtn.onclick = toggleSidebar;
            document.body.appendChild(toggleBtn);
        }
    }
});

// Handle window resize
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Re-render on significant size changes
        if (document.getElementById('catalogProductsGrid')) {
            renderCatalogProducts();
        }
    }, 250);
});

// Export functions for use in HTML onclick handlers
window.catalogFilterProducts = catalogFilterProducts;
window.goToPage = goToPage;
window.changeView = changeView;
window.resetFilters = resetFilters;
window.updatePriceRange = updatePriceRange;
window.quickFilterCategory = quickFilterCategory;
window.toggleSidebar = toggleSidebar;
