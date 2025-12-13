@extends('web.app')

@section('contenido')
<section id="contacto" class="contact-section">
    <div class="container">
        <div class="section-header">
            <h2>Contacto</h2>
            <p>Escríbenos para consultas, cotizaciones o soporte técnico.</p>
        </div>
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Información de contacto</h3>
                <p>Teléfono: +1 555 123 4567</p>
                <p>Email: contacto@medicalsupplies.example</p>
                <p>Dirección: Calle Falsa 123, Ciudad, País</p>
            </div>

            <div class="contact-form">
                <form method="POST" action="#" onsubmit="event.preventDefault(); alert('Gracias, su mensaje ha sido enviado.');">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
