// Medical Supplies - JavaScript

// Product Data
const products = [
    {
        id: 1,
        name: 'Monitor de Signos Vitales',
        brand: 'Philips',
        category: 'diagnostico',
        zone: 'cardiovascular',
        price: 2500,
        image: 'https://images.unsplash.com/photo-1584820927498-cfe5bfb1f1e7?w=500&q=80',
        description: 'Monitor multiparamétrico de última generación para el seguimiento completo de signos vitales.',
        specs: {
            'Certificación': 'FDA, CE, ISO 13485',
            'Garantía': '2 años',
            'Pantalla': '12.1 pulgadas táctil',
            'Parámetros': 'ECG, SpO2, NIBP, Temp, Resp'
        }
    },
    {
        id: 2,
        name: 'Estetoscopio Cardiology IV',
        brand: '3M',
        category: 'diagnostico',
        zone: 'cardiovascular',
        price: 180,
        image: 'https://images.unsplash.com/photo-1603398938378-e54eab446dde?w=500&q=80',
        description: 'Estetoscopio de doble cabezal con tecnología acústica superior.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '5 años',
            'Material': 'Acero inoxidable',
            'Tipo': 'Doble cabezal'
        }
    },
    {
        id: 3,
        name: 'Desfibrilador Automático',
        brand: 'Medtronic',
        category: 'urgencias',
        zone: 'cardiovascular',
        price: 4800,
        image: 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=500&q=80',
        description: 'Desfibrilador externo automático con instrucciones de voz y pantalla LCD.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '8 años',
            'Modo': 'AED automático',
            'Energía': '150-360 Joules'
        }
    },
    {
        id: 4,
        name: 'Microscopio Binocular',
        brand: 'Siemens',
        category: 'laboratorio',
        zone: 'neurologico',
        price: 1850,
        image: 'https://images.unsplash.com/photo-1582719471155-d0b76e43cd55?w=500&q=80',
        description: 'Microscopio de alta precisión para análisis clínicos y de laboratorio.',
        specs: {
            'Certificación': 'ISO 9001',
            'Garantía': '3 años',
            'Magnificación': '40x-1000x',
            'Iluminación': 'LED ajustable'
        }
    },
    {
        id: 5,
        name: 'Set Instrumental Quirúrgico',
        brand: 'GE Healthcare',
        category: 'cirugia',
        zone: 'musculoesqueletico',
        price: 3200,
        image: 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=500&q=80',
        description: 'Set completo de instrumental quirúrgico de acero inoxidable.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '5 años',
            'Material': 'Acero inoxidable 316L',
            'Piezas': '47 instrumentos'
        }
    },
    {
        id: 6,
        name: 'Oxímetro de Pulso',
        brand: 'Medtronic',
        category: 'diagnostico',
        zone: 'respiratorio',
        price: 85,
        image: 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=500&q=80',
        description: 'Oxímetro portátil para medición de saturación de oxígeno y frecuencia cardíaca.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '2 años',
            'Precisión': '±2%',
            'Display': 'OLED'
        }
    },
    {
        id: 7,
        name: 'Camilla de Exploración',
        brand: 'Philips',
        category: 'urgencias',
        zone: 'musculoesqueletico',
        price: 1200,
        image: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=500&q=80',
        description: 'Camilla hidráulica ajustable con respaldo reclinable.',
        specs: {
            'Certificación': 'ISO 9001',
            'Garantía': '3 años',
            'Capacidad': '200 kg',
            'Altura': '60-95 cm'
        }
    },
    {
        id: 8,
        name: 'Electrocardiografo',
        brand: 'GE Healthcare',
        category: 'diagnostico',
        zone: 'cardiovascular',
        price: 3500,
        image: 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=500&q=80',
        description: 'ECG de 12 derivaciones con pantalla táctil e impresora integrada.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '3 años',
            'Derivaciones': '12 canales',
            'Pantalla': '10 pulgadas táctil'
        }
    },
    {
        id: 9,
        name: 'Equipo de Ultrasonido',
        brand: 'Siemens',
        category: 'imagenologia',
        zone: 'cardiovascular',
        price: 15000,
        image: 'https://images.unsplash.com/photo-1551076805-e1869033e561?w=500&q=80',
        description: 'Sistema de ultrasonido portátil con tecnología de imagen avanzada.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '5 años',
            'Sondas': '3 transductores',
            'Modo': '2D, 3D, Doppler'
        }
    },
    {
        id: 10,
        name: 'Mesa de Rehabilitación',
        brand: '3M',
        category: 'rehabilitacion',
        zone: 'musculoesqueletico',
        price: 950,
        image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&q=80',
        description: 'Mesa ajustable para terapia física y rehabilitación.',
        specs: {
            'Certificación': 'ISO 9001',
            'Garantía': '2 años',
            'Ajuste': 'Eléctrico',
            'Capacidad': '180 kg'
        }
    },
    {
        id: 11,
        name: 'Termómetro Infrarrojo',
        brand: 'Medtronic',
        category: 'diagnostico',
        zone: 'neurologico',
        price: 45,
        image: 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=500&q=80',
        description: 'Termómetro sin contacto de lectura rápida.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '1 año',
            'Precisión': '±0.2°C',
            'Tiempo': '1 segundo'
        }
    },
    {
        id: 12,
        name: 'Tensiómetro Digital',
        brand: 'Philips',
        category: 'diagnostico',
        zone: 'cardiovascular',
        price: 120,
        image: 'https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=500&q=80',
        description: 'Tensiómetro automático de brazo con memoria.',
        specs: {
            'Certificación': 'FDA, CE',
            'Garantía': '3 años',
            'Memoria': '90 mediciones',
            'Brazalete': '22-42 cm'
        }
    }
];

// Cart Management
let cart = JSON.parse(localStorage.getItem('medicalCart')) || [];

function updateCart() {
    localStorage.setItem('medicalCart', JSON.stringify(cart));
    updateCartBadge();
    renderCart();
}

function updateCartBadge() {
    const badge = document.getElementById('cartBadge');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (badge) {
        badge.textContent = totalItems;
        badge.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) { existingItem.quantity += 1; } else { cart.push({ id: product.id, name: product.name, price: product.price, image: product.image, quantity: 1 }); }
    
    updateCart();
    showNotification('Producto agregado al carrito');
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) removeFromCart(productId);
        updateCart();
    }
}

function renderCart() {
    const cartItems = document.getElementById('cartItems');
    const subtotalEl = document.getElementById('cartSubtotal');
    const shippingEl = document.getElementById('cartShipping');
    const totalEl = document.getElementById('cartTotal');
    
    if (!cartItems || !subtotalEl || !shippingEl || !totalEl) return;
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="cart-empty">Tu carrito está vacío.</div>';
        subtotalEl.textContent = '$0.00';
        shippingEl.textContent = '$0.00';
        totalEl.textContent = '$0.00';
        return;
    }
    
    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="cart-item-info">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                </div>
            </div>
            <button class="cart-item-remove" onclick="removeFromCart(${item.id})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `).join('');
    
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const shipping = subtotal >= 500 ? 0 : 50;
    const total = subtotal + shipping;
    
    subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
    shippingEl.textContent = shipping === 0 ? 'GRATIS' : `$${shipping.toFixed(2)}`;
    totalEl.textContent = `$${total.toFixed(2)}`;
}

function checkout() {
    if (cart.length === 0) { showNotification('El carrito está vacío', 'warning'); return; }
    showNotification('Procesando pedido...');
    setTimeout(() => { cart = []; updateCart(); showNotification('Pedido realizado con éxito', 'success'); closeCart(); }, 1500);
}

// Products Rendering and Filtering
let filteredProducts = [...products];

function renderProducts() {
    const grid = document.getElementById('productsGrid');
    if (!grid) return;
    
    if (filteredProducts.length === 0) { grid.innerHTML = '<p>No se encontraron productos.</p>'; return; }
    
    grid.innerHTML = filteredProducts.map(product => `
        <div class="product-card" onclick="openProductDetail(${product.id})">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="product-info">
                <span class="product-category">${getCategoryName(product.category)}</span>
                <h3 class="product-name">${product.name}</h3>
                <p class="product-brand">${product.brand}</p>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                <div class="product-actions">
                    <button class="btn btn-primary btn-add-to-cart" onclick="event.stopPropagation(); addToCart(${product.id})">
                        <i class="fas fa-shopping-cart"></i>
                        Agregar
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function getCategoryName(category) {
    const names = {
        'diagnostico': 'Diagnóstico',
        'cirugia': 'Cirugía',
        'laboratorio': 'Laboratorio',
        'urgencias': 'Urgencias',
        'imagenologia': 'Imagenología',
        'rehabilitacion': 'Rehabilitación'
    };
    return names[category] || category;
}

function filterProducts() {
    const searchTermEl = document.getElementById('searchInput');
    const brandEl = document.getElementById('brandFilter');
    const categoryEl = document.getElementById('categoryFilter');
    const zoneEl = document.getElementById('zoneFilter');
    const searchTerm = searchTermEl ? searchTermEl.value.toLowerCase() : '';
    const brand = brandEl ? brandEl.value : '';
    const category = categoryEl ? categoryEl.value : '';
    const zone = zoneEl ? zoneEl.value : '';
    
    filteredProducts = products.filter(product => {
        const matchesSearch = searchTerm === '' || product.name.toLowerCase().includes(searchTerm) || product.description.toLowerCase().includes(searchTerm);
        const matchesBrand = brand === '' || product.brand === brand;
        const matchesCategory = category === '' || product.category === category;
        const matchesZone = zone === '' || product.zone === zone;
        return matchesSearch && matchesBrand && matchesCategory && matchesZone;
    });
    
    renderProducts();
}

function filterByCategory(category) {
    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) categoryFilter.value = category;
    filterProducts();
    const productosSection = document.getElementById('productos');
    if (productosSection) productosSection.scrollIntoView({ behavior: 'smooth' });
}

// Product Detail Modal
function openProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;
    const modal = document.getElementById('productModal');
    const detail = document.getElementById('productDetail');
    
    if (!detail || !modal) return;
    
    detail.innerHTML = `
        <div class="product-detail-grid">
            <div class="product-detail-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="product-detail-info">
                <span class="product-category">${getCategoryName(product.category)}</span>
                <h2>${product.name}</h2>
                <p class="product-brand"><strong>Marca:</strong> ${product.brand}</p>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                
                <div class="product-detail-description">
                    <h3>Descripción</h3>
                    <p>${product.description}</p>
                </div>
                
                <div class="product-specs">
                    <h3>Ficha Técnica</h3>
                    ${Object.entries(product.specs).map(([key, value]) => `
                        <div class="spec-row">
                            <span class="spec-label">${key}:</span>
                            <span class="spec-value">${value}</span>
                        </div>
                    `).join('')}
                </div>
                
                <button class="btn btn-primary btn-full" onclick="addToCart(${product.id}); closeProductModal();">
                    <i class="fas fa-shopping-cart"></i>
                    Agregar al Carrito
                </button>
            </div>
        </div>
    `;
    
    modal.classList.add('active');
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    if (modal) modal.classList.remove('active');
}

// Modal Management
function openLoginModal() { const m = document.getElementById('loginModal'); if (m) m.classList.add('active'); }
function closeLoginModal() { const m = document.getElementById('loginModal'); if (m) m.classList.remove('active'); }
function openRegisterModal() { const m = document.getElementById('registerModal'); if (m) m.classList.add('active'); }
function closeRegisterModal() { const m = document.getElementById('registerModal'); if (m) m.classList.remove('active'); }
function switchToRegister() { closeLoginModal(); openRegisterModal(); }
function switchToLogin() { closeRegisterModal(); openLoginModal(); }
function openCart() { const m = document.getElementById('cartModal'); if (m) m.classList.add('active'); renderCart(); }
function closeCart() { const m = document.getElementById('cartModal'); if (m) m.classList.remove('active'); }

// Close modals when clicking outside
window.onclick = function(event) { if (event.target.classList && event.target.classList.contains('modal')) { event.target.classList.remove('active'); } }

// Forms
function handleLogin(event) { event.preventDefault(); const email = document.getElementById('loginEmail') ? document.getElementById('loginEmail').value : ''; showNotification('Iniciando sesión...'); setTimeout(() => { closeLoginModal(); showNotification('Bienvenido'); }, 1000); }
function handleRegister(event) { event.preventDefault(); const name = document.getElementById('registerName') ? document.getElementById('registerName').value : ''; showNotification('Creando cuenta...'); setTimeout(() => { closeRegisterModal(); showNotification('Cuenta creada'); }, 1000); }
function handleContactSubmit(event) { event.preventDefault(); const name = document.getElementById('name') ? document.getElementById('name').value : ''; showNotification('Enviando mensaje...'); setTimeout(() => { showNotification('Mensaje enviado'); }, 1000); }

// Carousel
let currentSlide = 0;
const totalSlides = 3;

function updateCarousel() {
    const track = document.getElementById('carouselTrack');
    if (!track) return;
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    updateIndicators();
}

function nextSlide() { currentSlide = (currentSlide + 1) % totalSlides; updateCarousel(); }
function prevSlide() { currentSlide = (currentSlide - 1 + totalSlides) % totalSlides; updateCarousel(); }
function goToSlide(index) { currentSlide = index % totalSlides; updateCarousel(); }

function updateIndicators() {
    const indicators = document.getElementById('carouselIndicators');
    if (!indicators) return;
    indicators.innerHTML = '';
    for (let i = 0; i < totalSlides; i++) {
        const btn = document.createElement('button');
        btn.className = 'carousel-indicator' + (i === currentSlide ? ' active' : '');
        btn.onclick = () => goToSlide(i);
        indicators.appendChild(btn);
    }
}

// Auto-advance carousel
setInterval(nextSlide, 5000);

// Mobile Menu
function toggleMobileMenu() { const nav = document.querySelector('.nav'); if (nav) nav.classList.toggle('active'); }

// Notifications
function showNotification(message, type = 'info') { console.log('[NOTIFICATION]', type, message); }

// Add keyframe animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Initialize
document.addEventListener('DOMContentLoaded', function() { renderProducts(); updateCartBadge(); updateCarousel(); updateIndicators(); });
