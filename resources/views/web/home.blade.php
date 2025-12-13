@extends('web.app')

@section('titulo', 'Medical Supplies - Equipos y Productos Médicos')

@section('contenido')
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="banner-bg"></div>
        <div class="container banner-content">
            <div class="welcome-message">
                <div class="icon-wrapper">
                    <i class="fas fa-sparkles"></i>
                </div>
                <div>
                    <div class="welcome-title">¡Bienvenido a Medical Supplies!</div>
                    <p class="welcome-subtitle">Tu socio confiable en equipamiento médico</p>
                </div>
            </div>
            <div class="banner-divider"></div>
            <div class="promo-messages">
                <div class="promo-item">
                    <i class="fas fa-trending-up"></i>
                    <span>Envío GRATIS en compras +$500</span>
                </div>
                <div class="promo-item">
                    <i class="fas fa-award"></i>
                    <span>Productos 100% Certificados</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    ✨ Calidad y Confianza en Equipos Médicos
                </div>
                
                <h1>
                    Equipos Médicos de <span class="text-blue">Alta Calidad</span> para Profesionales de la Salud
                </h1>
                
                <p class="hero-description">
                    Suministramos los mejores equipos y productos médicos con certificaciones internacionales. 
                    Innovación, precisión y confiabilidad para tu práctica médica.
                </p>

                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Productos certificados y garantizados</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Envío rápido a todo el país</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Asesoría técnica especializada</span>
                    </div>
                </div>

                <div class="hero-buttons">
                    <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">
                        Ver Catálogo
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#contacto" class="btn btn-outline btn-lg">
                        Contactar Asesor
                    </a>
                </div>
            </div>

            <div class="hero-image">
                <div class="image-bg-decoration"></div>
                <div class="image-wrapper">
                    <img src="https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=800&q=80" alt="Equipos médicos de alta calidad">
                </div>
                
                <div class="stat-card stat-card-left">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Productos Disponibles</div>
                </div>
                
                <div class="stat-card stat-card-right">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Años de Experiencia</div>
                </div>
            </div>
        </div>
        <div class="hero-decoration hero-decoration-top"></div>
        <div class="hero-decoration hero-decoration-bottom"></div>
    </section>

    <!-- Image Carousel -->
    <section class="carousel-section">
        <div class="container">
            <div class="carousel-wrapper">
                <div class="carousel-track" id="carouselTrack">
                    <div class="carousel-slide">
                        <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?w=1200&q=80" alt="Hospital moderno">
                    </div>
                    <div class="carousel-slide">
                        <img src="https://images.unsplash.com/photo-1584820927498-cfe5bfb1f1e7?w=1200&q=80" alt="Equipos médicos">
                    </div>
                    <div class="carousel-slide">
                        <img src="https://images.unsplash.com/photo-1581595220892-b0739db3ba8c?w=1200&q=80" alt="Tecnología médica">
                    </div>
                </div>
                <button class="carousel-btn carousel-btn-prev" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn carousel-btn-next" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="carousel-indicators" id="carouselIndicators"></div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <i class="fas fa-hospital stat-icon"></i>
                    <div class="stat-value">1,000+</div>
                    <div class="stat-title">Clientes Satisfechos</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-box stat-icon"></i>
                    <div class="stat-value">500+</div>
                    <div class="stat-title">Productos en Stock</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-certificate stat-icon"></i>
                    <div class="stat-value">100%</div>
                    <div class="stat-title">Certificados</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-shipping-fast stat-icon"></i>
                    <div class="stat-value">24h</div>
                    <div class="stat-title">Envío Express</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categorias" class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2>Categorías de Productos</h2>
                <p>Encuentra los equipos médicos que necesitas</p>
            </div>

            <div class="categories-grid">
                <div class="category-card" onclick="filterByCategory('diagnostico')">
                    <div class="category-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3>Diagnóstico</h3>
                    <p>Equipos para diagnóstico preciso</p>
                    <div class="category-badge">45 productos</div>
                </div>

                <div class="category-card" onclick="filterByCategory('cirugia')">
                    <div class="category-icon">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <h3>Cirugía</h3>
                    <p>Instrumental quirúrgico profesional</p>
                    <div class="category-badge">62 productos</div>
                </div>

                <div class="category-card" onclick="filterByCategory('laboratorio')">
                    <div class="category-icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h3>Laboratorio</h3>
                    <p>Equipamiento para laboratorio clínico</p>
                    <div class="category-badge">38 productos</div>
                </div>

                <div class="category-card" onclick="filterByCategory('urgencias')">
                    <div class="category-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3>Urgencias</h3>
                    <p>Equipos de emergencia médica</p>
                    <div class="category-badge">29 productos</div>
                </div>

                <div class="category-card" onclick="filterByCategory('imagenologia')">
                    <div class="category-icon">
                        <i class="fas fa-x-ray"></i>
                    </div>
                    <h3>Imagenología</h3>
                    <p>Equipos de imagen médica</p>
                    <div class="category-badge">21 productos</div>
                </div>

                <div class="category-card" onclick="filterByCategory('rehabilitacion')">
                    <div class="category-icon">
                        <i class="fas fa-wheelchair"></i>
                    </div>
                    <h3>Rehabilitación</h3>
                    <p>Equipos de fisioterapia</p>
                    <div class="category-badge">34 productos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Catalog -->
    <section id="productos" class="product-catalog">
        <div class="container">
            <div class="section-header">
                <h2>Catálogo de Productos</h2>
                <p>Explora nuestra amplia selección de equipos médicos</p>
            </div>

            <!-- Search and Filters -->
            <div class="search-filters">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar productos..." oninput="filterProducts()">
                </div>

                <div class="filter-group">
                    <select id="brandFilter" onchange="filterProducts()">
                        <option value="">Todas las Marcas</option>
                        <option value="Medtronic">Medtronic</option>
                        <option value="Philips">Philips</option>
                        <option value="GE Healthcare">GE Healthcare</option>
                        <option value="Siemens">Siemens</option>
                        <option value="3M">3M</option>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="categoryFilter" onchange="filterProducts()">
                        <option value="">Todas las Categorías</option>
                        <option value="diagnostico">Diagnóstico</option>
                        <option value="cirugia">Cirugía</option>
                        <option value="laboratorio">Laboratorio</option>
                        <option value="urgencias">Urgencias</option>
                        <option value="imagenologia">Imagenología</option>
                        <option value="rehabilitacion">Rehabilitación</option>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="zoneFilter" onchange="filterProducts()">
                        <option value="">Todas las Zonas</option>
                        <option value="cardiovascular">Cardiovascular</option>
                        <option value="respiratorio">Respiratorio</option>
                        <option value="neurologico">Neurológico</option>
                        <option value="musculoesqueletico">Musculoesquelético</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid" id="productsGrid">
                <!-- Products will be rendered by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2>Lo Que Dicen Nuestros Clientes</h2>
                <p>Testimonios de profesionales de la salud</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Excelente calidad en los equipos. El servicio de atención es muy profesional y los tiempos de entrega son rápidos."
                    </p>
                    <div class="testimonial-author">
                        <img src="https://i.pravatar.cc/150?img=1" alt="Dr. Carlos Méndez">
                        <div>
                            <div class="author-name">Dr. Carlos Méndez</div>
                            <div class="author-role">Cardiólogo</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Los productos son de primera calidad y cuentan con todas las certificaciones necesarias. Muy recomendado."
                    </p>
                    <div class="testimonial-author">
                        <img src="https://i.pravatar.cc/150?img=5" alt="Dra. María González">
                        <div>
                            <div class="author-name">Dra. María González</div>
                            <div class="author-role">Cirujana</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "He comprado varios equipos para mi clínica. La asesoría técnica es excepcional y los precios son competitivos."
                    </p>
                    <div class="testimonial-author">
                        <img src="https://i.pravatar.cc/150?img=8" alt="Dr. Juan Ramírez">
                        <div>
                            <div class="author-name">Dr. Juan Ramírez</div>
                            <div class="author-role">Director de Clínica</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="brands-section">
        <div class="container">
            <div class="section-header">
                <h2>Marcas de Confianza</h2>
                <p>Trabajamos con las mejores marcas del mercado</p>
            </div>

            <div class="brands-grid">
                <div class="brand-logo">Medtronic</div>
                <div class="brand-logo">Philips</div>
                <div class="brand-logo">GE Healthcare</div>
                <div class="brand-logo">Siemens</div>
                <div class="brand-logo">3M</div>
                <div class="brand-logo">Johnson & Johnson</div>
            </div>
        </div>
    </section>

    <!-- Certifications -->
    <section class="certifications-section">
        <div class="container">
            <div class="section-header">
                <h2>Certificaciones y Garantías</h2>
                <p>Nuestros productos cuentan con las certificaciones más importantes</p>
            </div>

            <div class="certifications-grid">
                <div class="certification-card">
                    <i class="fas fa-certificate"></i>
                    <h3>ISO 9001</h3>
                    <p>Gestión de Calidad</p>
                </div>
                <div class="certification-card">
                    <i class="fas fa-check-circle"></i>
                    <h3>FDA</h3>
                    <p>Aprobado por la FDA</p>
                </div>
                <div class="certification-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>CE</h3>
                    <p>Certificación Europea</p>
                </div>
                <div class="certification-card">
                    <i class="fas fa-award"></i>
                    <h3>Garantía</h3>
                    <p>2 Años de Garantía</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contacto" class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Contáctanos</h2>
                    <p>Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos pronto.</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <div class="contact-label">Teléfono</div>
                                <div class="contact-value">+1 (555) 123-4567</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <div class="contact-label">Email</div>
                                <div class="contact-value">contacto@medicalsupplies.com</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <div class="contact-label">Dirección</div>
                                <div class="contact-value">123 Medical Plaza, Ciudad</div>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="contact-form" onsubmit="handleContactSubmit(event)">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="tel" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>
@endsection
