// Catalog Script - Medical Supplies

// Filter products by category
function filterByCategory(category) {
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        if (category === 'all' || product.dataset.category === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

// Search functionality
function setupSearch() {
    const searchInput = document.querySelector('.search-box-catalog input');
    if (!searchInput) return;
    
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.product-card');
        
        products.forEach(product => {
            const name = product.querySelector('.product-name').textContent.toLowerCase();
            const brand = product.querySelector('.product-brand').textContent.toLowerCase();
            
            if (name.includes(query) || brand.includes(query)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
}

// Sort products
function sortProducts(sortType) {
    const grid = document.querySelector('.catalog-products-grid');
    if (!grid) return;
    
    const products = Array.from(document.querySelectorAll('.product-card'));
    
    products.sort((a, b) => {
        const priceA = parseFloat(a.dataset.price) || 0;
        const priceB = parseFloat(b.dataset.price) || 0;
        
        switch(sortType) {
            case 'price-low':
                return priceA - priceB;
            case 'price-high':
                return priceB - priceA;
            case 'name':
                const nameA = a.querySelector('.product-name').textContent;
                const nameB = b.querySelector('.product-name').textContent;
                return nameA.localeCompare(nameB);
            default:
                return 0;
        }
    });
    
    products.forEach(product => {
        grid.appendChild(product);
    });
}

// View toggle (grid/list)
function toggleView(viewType) {
    const grid = document.querySelector('.catalog-products-grid');
    const buttons = document.querySelectorAll('.view-btn');
    
    if (!grid) return;
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.closest('.view-btn').classList.add('active');
    
    if (viewType === 'grid') {
        grid.classList.remove('view-list');
        grid.classList.add('view-grid');
    } else {
        grid.classList.remove('view-grid');
        grid.classList.add('view-list');
    }
}

// Filter by price range
function filterByPrice(min, max) {
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        const price = parseFloat(product.dataset.price) || 0;
        
        if (price >= min && price <= max) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

// Price slider update
function setupPriceSlider() {
    const minInput = document.getElementById('priceMin');
    const maxInput = document.getElementById('priceMax');
    
    if (!minInput || !maxInput) return;
    
    [minInput, maxInput].forEach(input => {
        input.addEventListener('change', function() {
            const min = parseFloat(minInput.value) || 0;
            const max = parseFloat(maxInput.value) || 10000;
            
            if (min <= max) {
                filterByPrice(min, max);
            }
        });
    });
}

// Pagination
function setupPagination(itemsPerPage = 12) {
    const grid = document.querySelector('.catalog-products-grid');
    if (!grid) return;
    
    const products = document.querySelectorAll('.product-card');
    const totalPages = Math.ceil(products.length / itemsPerPage);
    
    function showPage(pageNum) {
        products.forEach((product, index) => {
            const start = (pageNum - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            product.style.display = (index >= start && index < end) ? 'block' : 'none';
        });
    }
    
    window.goToPage = showPage;
    if (totalPages > 0) showPage(1);
}

// Compare functionality
function toggleCompare(productId) {
    const btn = event.target.closest('.product-compare-btn');
    if (!btn) return;
    
    btn.classList.toggle('active');
    
    let compared = JSON.parse(localStorage.getItem('comparedProducts')) || [];
    
    if (btn.classList.contains('active')) {
        if (!compared.includes(productId)) {
            compared.push(productId);
        }
    } else {
        compared = compared.filter(id => id !== productId);
    }
    
    localStorage.setItem('comparedProducts', JSON.stringify(compared));
    updateCompareButton();
}

function updateCompareButton() {
    const compared = JSON.parse(localStorage.getItem('comparedProducts')) || [];
    const compareBtn = document.querySelector('.compare-toggle-btn');
    
    if (compareBtn) {
        compareBtn.textContent = `Comparar (${compared.length})`;
        compareBtn.style.display = compared.length > 0 ? 'block' : 'none';
    }
}

// Mobile sidebar toggle
function toggleSidebar() {
    const sidebar = document.querySelector('.catalog-sidebar');
    if (sidebar) {
        sidebar.classList.toggle('mobile-hidden');
    }
}

// Initialize catalog on page load
document.addEventListener('DOMContentLoaded', function() {
    setupSearch();
    setupPriceSlider();
    setupPagination();
    updateCompareButton();
    
    // Sort select
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function(e) {
            sortProducts(e.target.value);
        });
    }
    
    // View toggle buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            toggleView(this.dataset.view);
        });
    });
    
    // Sidebar toggle (mobile)
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }
});
