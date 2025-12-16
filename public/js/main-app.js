// Medical Supplies - Main JavaScript

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
    if (badge) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        badge.textContent = totalItems;
        badge.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function addToCart(productId) {
    // Crear un formulario y enviarlo al servidor
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/carrito/agregar';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_token';
        input.value = csrfToken.getAttribute('content');
        form.appendChild(input);
    }
    
    const productInput = document.createElement('input');
    productInput.type = 'hidden';
    productInput.name = 'producto_id';
    productInput.value = productId;
    form.appendChild(productInput);
    
    const cantidadInput = document.createElement('input');
    cantidadInput.type = 'hidden';
    cantidadInput.name = 'cantidad';
    cantidadInput.value = '1';
    form.appendChild(cantidadInput);
    
    document.body.appendChild(form);
    form.submit();
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            updateCart();
        }
    }
}

function renderCart() {
    const cartItems = document.getElementById('cartItems');
    const subtotalEl = document.getElementById('cartSubtotal');
    const shippingEl = document.getElementById('cartShipping');
    const totalEl = document.getElementById('cartTotal');
    
    // Si los elementos no existen, no renderizar (no estamos en la página del carrito)
    if (!cartItems || !subtotalEl || !shippingEl || !totalEl) {
        return;
    }
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="cart-empty"><i class="fas fa-shopping-cart"></i><p>Tu carrito está vacío</p></div>';
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
    if (cart.length === 0) {
        showNotification('El carrito está vacío', 'error');
        return;
    }
    showNotification('Procesando pedido...');
    setTimeout(() => {
        cart = [];
        updateCart();
        closeCart();
        showNotification('¡Pedido realizado exitosamente!', 'success');
    }, 1500);
}

// Modal Management
function openLoginModal() {
    document.getElementById('loginModal').classList.add('active');
}

function closeLoginModal() {
    document.getElementById('loginModal').classList.remove('active');
}

function openRegisterModal() {
    document.getElementById('registerModal').classList.add('active');
}

function closeRegisterModal() {
    document.getElementById('registerModal').classList.remove('active');
}

function switchToRegister() {
    closeLoginModal();
    openRegisterModal();
}

function switchToLogin() {
    closeRegisterModal();
    openLoginModal();
}

function openCart() {
    document.getElementById('cartModal').classList.add('active');
}

function closeCart() {
    document.getElementById('cartModal').classList.remove('active');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const modal = event.target.closest('.modal');
    if (modal && event.target === modal) {
        modal.classList.remove('active');
    }
}

// Forms
function handleLogin(event) {
    event.preventDefault();
    showNotification('Iniciando sesión...');
    setTimeout(() => {
        closeLoginModal();
        showNotification('¡Sesión iniciada!', 'success');
    }, 1500);
}

function handleRegister(event) {
    event.preventDefault();
    showNotification('Creando cuenta...');
    setTimeout(() => {
        closeRegisterModal();
        showNotification('¡Cuenta creada exitosamente!', 'success');
    }, 1500);
}

function handleContactSubmit(event) {
    event.preventDefault();
    showNotification('Enviando mensaje...');
    setTimeout(() => {
        event.target.reset();
        showNotification('¡Mensaje enviado! Te contactaremos pronto.', 'success');
    }, 1500);
}

// Notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease forwards';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Initialize
console.log('Script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    updateCartBadge();
    renderCart();
    
    // No iniciar dropdown aquí, se maneja en nav.blade.php
});
