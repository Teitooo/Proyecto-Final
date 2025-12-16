@extends('web.app')

@section('titulo', 'Acerca de Nosotros - Medical Supplies')

@push('estilos')
    <link href="{{ asset('css/about-styles.css') }}" rel="stylesheet" />
@endpush

@section('contenido')
<!-- About Header -->
<div class="about-header">
    <div class="container">
        <h1>Acerca de Nosotros</h1>
        <p class="about-subtitle">Comprometidos con la excelencia en el cuidado de la salud desde 1998</p>
    </div>
</div>

<!-- About Intro Section -->
<section class="about-intro">
    <div class="container">
        <div class="intro-grid">
            <div class="intro-image">
                <img src="https://images.unsplash.com/photo-1576091160550-112173f7f869?w=800&q=80" alt="Acerca de nosotros">
                <div class="intro-badge">
                    <i class="fas fa-award"></i>
                    <div>
                        <div class="badge-number">25</div>
                        <div class="badge-text">Años de experiencia</div>
                    </div>
                </div>
            </div>
            <div class="intro-content">
                <div class="section-label">
                    <i class="fas fa-info-circle"></i>
                    Nuestra Historia
                </div>
                <h2>Líderes en Soluciones Médicas</h2>
                <p>
                    Desde nuestro fundación en 1998, Medical Supplies ha sido pionera en la distribución y suministro de equipos médicos de alta calidad. Nuestro compromiso con la excelencia nos ha permitido convertir nos en un socio confiable para hospitales, clínicas y profesionales de la salud en toda la región.
                </p>
                <p>
                    Con más de dos décadas de experiencia, hemos establecido relaciones sólidas con los principales fabricantes mundiales, permitiéndonos ofrecer productos que cumplen con los más altos estándares de calidad y seguridad.
                </p>
                
                <div class="intro-stats">
                    <div class="intro-stat">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Clientes Satisfechos</div>
                    </div>
                    <div class="intro-stat">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Productos Disponibles</div>
                    </div>
                    <div class="intro-stat">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Tasa de Satisfacción</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision">
    <div class="container">
        <div class="mv-grid">
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Nuestra Misión</h3>
                <p>
                    Proporcionar equipos médicos de primera calidad y servicios de excelencia que mejoren la salud y el bienestar de las personas, generando confianza y satisfacción en cada interacción con nuestros clientes.
                </p>
            </div>
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Nuestra Visión</h3>
                <p>
                    Ser la empresa líder reconocida en América Latina en la distribución de soluciones médicas innovadoras, siendo socio estratégico para instituciones de salud comprometidas con la excelencia y la calidad asistencial.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="section-header">
            <h2>Nuestros Valores</h2>
            <p>Los principios fundamentales que guían nuestras acciones y decisiones</p>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <h3>Calidad</h3>
                <p>Comprometidos con la excelencia en cada producto y servicio que ofrecemos a nuestros clientes.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3>Confianza</h3>
                <p>Construimos relaciones duraderas basadas en la transparencia y el cumplimiento de nuestros compromisos.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3>Innovación</h3>
                <p>Buscamos constantemente nuevas soluciones y tecnologías para mejorar nuestros productos.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Compromiso</h3>
                <p>Dedicados al bienestar de la salud y el desarrollo sostenible de nuestras comunidades.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Trabajo en Equipo</h3>
                <p>Colaboramos constantemente para lograr objetivos comunes y superar expectativas.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3>Sostenibilidad</h3>
                <p>Responsables con el medio ambiente en todas nuestras operaciones y procesos.</p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="timeline-section">
    <div class="container">
        <div class="section-header">
            <h2>Nuestro Recorrido</h2>
            <p>Hitos importantes en la historia de Medical Supplies</p>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">1998</span>
                    <h3>Fundación</h3>
                    <p>Se estableció Medical Supplies como distribuidor independiente de equipos médicos en la región.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2005</span>
                    <h3>Expansión Regional</h3>
                    <p>Abrimos nuestras primeras sucursales en países vecinos, ampliando nuestro alcance comercial.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2010</span>
                    <h3>Certificación Internacional</h3>
                    <p>Obtuvimos las certificaciones ISO 9001 y FDA, garantizando la más alta calidad en nuestros procesos.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2015</span>
                    <h3>Transformación Digital</h3>
                    <p>Implementamos plataforma de e-commerce y sistemas avanzados para mejorar la experiencia del cliente.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2020</span>
                    <h3>Modernización</h3>
                    <p>Inauguramos nuestro nuevo centro de distribución con tecnología de punta y logística optimizada.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2024</span>
                    <h3>Presente</h3>
                    <p>Continuamos innovando con soluciones telemédicas y servicios de valor agregado para nuestros clientes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="section-header">
            <h2>Nuestro Equipo</h2>
            <p>Profesionales comprometidos con tu salud</p>
        </div>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80" alt="Director General">
                    <div class="team-social">
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Carlos García</h3>
                    <div class="team-role">Director General</div>
                    <p class="team-bio">Emprendedor con 25 años de experiencia en el sector médico. Especialista en estrategia comercial y relaciones empresariales.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&q=80" alt="Directora de Operaciones">
                    <div class="team-social">
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-info">
                    <h3>María López</h3>
                    <div class="team-role">Directora de Operaciones</div>
                    <p class="team-bio">Ingeniera industrial con especialización en logística y gestión de calidad. Responsable de optimizar procesos.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80" alt="Gerente Comercial">
                    <div class="team-social">
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Dr. Roberto Sánchez</h3>
                    <div class="team-role">Gerente Comercial</div>
                    <p class="team-bio">Médico y especialista en tecnología médica con conexiones en principales instituciones de salud.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certifications Section -->
<section class="about-certifications">
    <div class="container">
        <div class="section-header">
            <h2>Nuestras Certificaciones</h2>
            <p>Cumplimos con los más altos estándares internacionales</p>
        </div>
        <div class="cert-grid">
            <div class="cert-card">
                <div class="cert-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3>ISO 9001:2015</h3>
                <p>Certificación en Sistema de Gestión de Calidad. Garantiza procesos estandarizados y mejora continua.</p>
                <span class="cert-year">2010</span>
            </div>
            <div class="cert-card">
                <div class="cert-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>FDA Approved</h3>
                <p>Aprobación de la Administración de Alimentos y Medicamentos de EE.UU. para distribución de equipos médicos.</p>
                <span class="cert-year">2010</span>
            </div>
            <div class="cert-card">
                <div class="cert-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3>ISO 13485:2016</h3>
                <p>Sistemas de Gestión de Calidad para Dispositivos Médicos. Cumplimiento con regulaciones internacionales.</p>
                <span class="cert-year">2018</span>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose">
    <div class="container">
        <div class="why-grid">
            <div class="why-content">
                <h2>¿Por Qué Elegirnos?</h2>
                <div class="why-list">
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4>Productos de Calidad Garantizada</h4>
                            <p>Todos nuestros equipos cumplen con certificaciones internacionales y estándares de seguridad.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4>Servicio Técnico Especializado</h4>
                            <p>Contamos con personal capacitado para instalación, mantenimiento y soporte técnico continuo.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4>Entregas Rápidas y Seguras</h4>
                            <p>Sistema logístico optimizado que garantiza entregas a tiempo en toda la región.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4>Precios Competitivos</h4>
                            <p>Ofertas especiales para compras en volumen y clientes institucionales.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4>Asesoramiento Profesional</h4>
                            <p>Nuestros especialistas te ayudan a seleccionar los mejores equipos para tus necesidades.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-image">
                <img src="https://images.unsplash.com/photo-1576091160479-112193c7fc32?w=600&q=80" alt="Por qué elegirnos">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="about-cta">
    <div class="container">
        <div class="cta-content">
            <h2>¿Listo para Trabajar con Nosotros?</h2>
            <p>Contáctanos para conocer cómo podemos ser tu socio confiable en soluciones médicas</p>
            <div class="cta-buttons">
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <i class="fas fa-envelope"></i>
                    Solicitar Cotización
                </a>
                <a href="tel:+1234567890" class="btn btn-outline">
                    <i class="fas fa-phone"></i>
                    Llamar Ahora
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
