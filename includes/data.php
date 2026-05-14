<?php
$eventTypes = [
    'Bodas' => 'bodas',
    'Congresos' => 'congresos',
    'Cumpleaños' => 'cumpleanos',
    'Corporativo' => 'corporativo',
    'Lanzamientos' => 'lanzamientos',
    'Privado' => 'privado',
];

$clientTypes = [
    'Empresas' => 'empresas',
    'Parejas' => 'parejas',
    'Familias' => 'familias',
    'Redes Sociales' => 'redes',
    'ONG' => 'ong',
];

$salones = [
    [
        'title' => 'Salón Altamira',
        'location' => 'Centro Empresarial, La Paz',
        'price' => 'Desde $280',
        'description' => 'Espacio elegante para eventos corporativos, bodas y congresos con iluminación de diseño.',
        'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=1200&q=80',
        'event_types' => ['bodas', 'corporativo', 'congresos', 'privado'],
        'client_types' => ['empresas', 'parejas', 'familias'],
    ],
    [
        'title' => 'Gran Lobby Executive',
        'location' => 'Zona Norte, Santa Cruz',
        'price' => 'Desde $180',
        'description' => 'Ambiente moderno con acabados neutros y capacidad para presentaciones y lanzamientos.',
        'image' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1200&q=80',
        'event_types' => ['corporativo', 'lanzamientos', 'congresos'],
        'client_types' => ['empresas', 'redes', 'ong'],
    ],
    [
        'title' => 'Terraza Panorama',
        'location' => 'Hotel Boutique, Cochabamba',
        'price' => 'Desde $220',
        'description' => 'Terraza sofisticada con vista, ideal para bodas íntimas y celebraciones privadas.',
        'image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1200&q=80',
        'event_types' => ['bodas', 'privado', 'cumpleanos'],
        'client_types' => ['parejas', 'familias'],
    ],
    [
        'title' => 'Sala Corporate',
        'location' => 'Distrito Financiero, La Paz',
        'price' => 'Desde $240',
        'description' => 'Salón premium con tecnología audiovisual para workshops, juntas y reuniones ejecutivas.',
        'image' => 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?auto=format&fit=crop&w=1200&q=80',
        'event_types' => ['corporativo', 'congresos', 'lanzamientos'],
        'client_types' => ['empresas', 'ong'],
    ],
    [
        'title' => 'Auditorio Central',
        'location' => 'Plaza del Estudiante, Sucre',
        'price' => 'Desde $200',
        'description' => 'Auditorio amplio y contemporáneo para congresos, seminarios y presentaciones corporativas.',
        'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1200&q=80',
        'event_types' => ['congresos', 'corporativo', 'lanzamientos'],
        'client_types' => ['empresas', 'ong', 'redes'],
    ],
];
