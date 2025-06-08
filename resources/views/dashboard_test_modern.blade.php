@extends('layouts.app_sidebar_modern')

@section('title', 'Dashboard ')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-800">Bienvenido al Sistema de Gestión Académica IFC</h1>
        <p class="mb-8 text-gray-600">Administra estudiantes, facilitadores, materias y notas de manera eficiente y moderna. Explora las secciones del menú para gestionar toda la información académica del Instituto IFC de forma centralizada, segura y rápida.</p>

        <style>
            .card-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
            }
            .card {
                position: relative;
                background: linear-gradient(135deg, #667eea, #764ba2);
                border-radius: 1rem;
                padding: 2rem;
                color: white;
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
                overflow: hidden;
            }
            .card:hover {
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 20px 40px rgba(102, 126, 234, 0.5);
            }
            .card-icon-bg {
                position: absolute;
                top: -20px;
                right: -20px;
                font-size: 6rem;
                color: rgba(255, 255, 255, 0.15);
                pointer-events: none;
                user-select: none;
            }
            .card-content {
                position: relative;
                display: flex;
                align-items: center;
                gap: 1rem;
                font-weight: 700;
                font-size: 1.25rem;
            }
            .card-icon {
                font-size: 2.5rem;
            }
            .card-title {
                flex-grow: 1;
            }
            /* Different gradient backgrounds for each card */
            .bg-estudiantes {
                background: linear-gradient(135deg, #7b2ff7, #f107a3);
                box-shadow: 0 10px 20px rgba(123, 47, 247, 0.3);
            }
            .bg-facilitadores {
                background: linear-gradient(135deg, #11998e, #38ef7d);
                box-shadow: 0 10px 20px rgba(17, 153, 142, 0.3);
            }
            .bg-materias {
                background: linear-gradient(135deg, #f7971e, #ffd200);
                box-shadow: 0 10px 20px rgba(247, 151, 30, 0.3);
            }
            .bg-notas {
                background: linear-gradient(135deg, #ee7752, #e73c7e);
                box-shadow: 0 10px 20px rgba(238, 119, 82, 0.3);
            }
            .bg-roles {
                background: linear-gradient(135deg, #2193b0, #6dd5ed);
                box-shadow: 0 10px 20px rgba(33, 147, 176, 0.3);
            }
        </style>

        <div class="card-container">
            <a href="{{ route('estudiantes.index') }}" class="card bg-estudiantes">
                <div class="card-icon-bg">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="card-content">
                    <i class="bi bi-people-fill card-icon"></i>
                    <span class="card-title">Estudiantes</span>
                </div>
            </a>

            <a href="{{ route('facilitadores.index') }}" class="card bg-facilitadores">
                <div class="card-icon-bg">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div class="card-content">
                    <i class="bi bi-person-badge-fill card-icon"></i>
                    <span class="card-title">Facilitadores</span>
                </div>
            </a>

            <a href="{{ route('materias.index') }}" class="card bg-materias">
                <div class="card-icon-bg">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div class="card-content">
                    <i class="bi bi-journal-text card-icon"></i>
                    <span class="card-title">Materias</span>
                </div>
            </a>

            <a href="{{ route('notas.index') }}" class="card bg-notas">
                <div class="card-icon-bg">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div class="card-content">
                    <i class="bi bi-journal-check card-icon"></i>
                    <span class="card-title">Notas</span>
                </div>
            </a>

            <a href="{{ route('roles.index') }}" class="card bg-roles">
                <div class="card-icon-bg">
                    <i class="bi bi-person-rolodex"></i>
                </div>
                <div class="card-content">
                    <i class="bi bi-person-rolodex card-icon"></i>
                    <span class="card-title">Roles</span>
                </div>
            </a>
        </div>
    </div>
@endsection
