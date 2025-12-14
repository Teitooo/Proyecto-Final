@extends('autenticacion.app')
@section('titulo', 'Sistema - Registro')
@section('contenido')
<style>
  /* Mejoras visuales para la pantalla de registro */
  :root{
    /* colores ligeramente suavizados manteniendo la misma familia */
    --primary:#3398ff; /* un azul un poco más suave */
    --primary-dark:#2a7ee6; /* versión ligeramente oscurecida */
    --accent:#0dcaf0;
    --muted:#f8f9fa;
    --card-bg: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
    --radius:14px;
    --glass: rgba(255,255,255,0.7);
  }

  /* Página: fondo aplicado a toda la vista */
  .login-page{
    min-height: 100vh;
    display: flex;
    align-items: center; /* centra verticalmente */
    justify-content: center; /* centra horizontalmente */
    padding: 0 1rem; /* quitar offset superior para centrar exactamente */
    background-color: #f5f9ff;
    background-image: radial-gradient(700px 300px at 10% 10%, rgba(13,110,253,0.06), transparent),
                      radial-gradient(600px 260px at 90% 80%, rgba(13,110,253,0.04), transparent),
                      linear-gradient(180deg,#f7fbff 0%, #ffffff 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  /* Card */
  .login-card-custom{
    width: 100%;
    max-width: 560px;
    border-radius: calc(var(--radius) + 4px);
    box-shadow: 0 18px 46px rgba(2,6,23,0.10), 0 8px 20px rgba(13,110,253,0.05);
    overflow: hidden;
    border: 1px solid rgba(13,110,253,0.06);
    background: linear-gradient(180deg, rgba(255,255,255,0.88), rgba(247,251,255,0.95));
    backdrop-filter: blur(6px);
    transition: transform .18s ease, box-shadow .18s ease;
  }
  /* reducir efecto hover: menos elevación y sombra */
  .login-card-custom:hover{ transform: translateY(-2px); box-shadow: 0 18px 40px rgba(2,6,23,0.10); }

  .login-card-header{
    background: linear-gradient(90deg,var(--primary),var(--primary-dark));
    color: #fff;
    padding: 1.25rem 1.5rem;
    text-align: center;
  }
  .login-card-header h1{ font-weight:800; margin:0; font-size:1.6rem; letter-spacing:0.3px; color:#fff }
  .login-card-header a{ color:inherit; text-decoration:none }
  .login-card-header b{ color:#fff }
  /* asegurar texto blanco incluso si hay enlaces */
  .login-card-header a, .login-card-header a *{ color: #fff !important }

  .login-card-body{ padding: 2.25rem 2rem; background: transparent }
  .login-card-body .login-box-msg{ color:#334155; margin-bottom:1.1rem; font-weight:700; font-size:1rem }

  /* Inputs */
  .form-floating .form-control{
    border-radius: 12px;
    padding: 1.05rem .9rem;
    background: rgba(255,255,255,0.95);
    border: 1px solid rgba(15,23,42,0.06);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
    transition: box-shadow .15s ease, border-color .15s ease, transform .12s ease;
    font-size: .98rem;
  }
  .form-floating .form-control:focus{ outline: none; box-shadow: 0 6px 24px rgba(13,110,253,0.12); border-color: var(--primary-dark); transform: translateY(-1px); }
  .form-floating label{ color:#6b7280; padding-left:.25rem }

  .btn-login-primary{
    background: linear-gradient(90deg,var(--primary),var(--primary-dark));
    border: none;
    color:#fff;
    border-radius: 12px;
    padding: .85rem 1.1rem;
    font-weight:800;
    font-size: .98rem;
    box-shadow: 0 12px 32px rgba(13,110,253,0.14);
    transition: transform .12s ease, box-shadow .12s ease, opacity .12s ease;
  }
  .btn-login-primary:active{ transform: translateY(1px) }

  .alert-info{ background: linear-gradient(90deg,var(--accent),#a5f3fc); border:0 }

  /* Inputs de error */
  .is-invalid{ border-color: #dc3545 !important }
  .invalid-feedback{ color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem }

  @media (max-width:576px){
    .login-card-custom{ margin:0 0.5rem; }
    .login-card-header h1{ font-size:1.1rem }
  }
</style>

<div class="login-page">
  <div id="registroCard" class="card card-outline card-primary login-card-custom">
    <div id="registroHeader" class="card-header login-card-header">
    <a href="/" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
      <h1 class="mb-0"><b>Medical </b>Supplies</h1>
    </a>
  </div>
    <div id="registroBody" class="card-body login-card-body">
    <p class="login-box-msg">Crea tu cuenta</p>
    @if(session('error'))
      <div class="alert alert-danger">
        {{session('error')}}
      </div>
    @endif
    <form action="{{route('registro.store')}}" method="post">
      @csrf
      <div class="input-group mb-1">
        <div class="form-floating">
          <input id="name" type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese nombre" />
          <label for="name">Nombre</label>
        </div>
        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
        @error('name')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group mb-1">
        <div class="form-floating">
          <input id="loginEmail" type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="" />
          <label for="loginEmail">Email</label>
        </div>
        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
        @error('email')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group mb-1">
        <div class="form-floating">
          <input id="loginPassword" type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="" />
          <label for="loginPassword">Password</label>
        </div>
        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group mb-1">
        <div class="form-floating">
          <input id="password_confirmation" type="text" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" />
          <label for="password_confirmation">Confirme su password</label>
        </div>
        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
        @error('password_confirmation')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <!--begin::Row-->
      <div class="row">
        <!-- /.col -->
          <div class="col-12 d-flex justify-content-center">
            <div id="submitBtnWrap" class="">
              <button id="submitBtn" type="submit" class="btn btn-login-primary">Registrar</button>
            </div>
          </div>
        <!-- /.col -->
      </div>
      <!--end::Row-->
      <hr class="my-3">
      <p class="text-center text-muted mb-0">
        ¿Ya tienes cuenta? <a href="{{route('login')}}" class="fw-bold" style="color: var(--primary-dark); text-decoration: none;">Inicia sesión</a>
      </p>
    </form>
    <!-- /.social-auth-links -->
  </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

      