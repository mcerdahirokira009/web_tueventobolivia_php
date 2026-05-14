<?php
require_once __DIR__ . '/includes/data.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$selectedEvents = isset($_GET['event_type']) ? (array) $_GET['event_type'] : [];
$selectedClients = isset($_GET['client_type']) ? (array) $_GET['client_type'] : [];

function filterSalon($salon, $search, $selectedEvents, $selectedClients) {
    if ($search !== '') {
        $needle = mb_strtolower($search, 'UTF-8');
        $haystack = mb_strtolower($salon['title'] . ' ' . $salon['location'] . ' ' . $salon['description'], 'UTF-8');
        if (strpos($haystack, $needle) === false) {
            return false;
        }
    }

    if (!empty($selectedEvents)) {
        $matches = false;
        foreach ($selectedEvents as $type) {
            if (in_array($type, $salon['event_types'], true)) {
                $matches = true;
                break;
            }
        }
        if (!$matches) {
            return false;
        }
    }

    if (!empty($selectedClients)) {
        $matches = false;
        foreach ($selectedClients as $type) {
            if (in_array($type, $salon['client_types'], true)) {
                $matches = true;
                break;
            }
        }
        if (!$matches) {
            return false;
        }
    }

    return true;
}

$filteredSalones = array_filter($salones, function ($salon) use ($search, $selectedEvents, $selectedClients) {
    return filterSalon($salon, $search, $selectedEvents, $selectedClients);
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tú Evento Bolivia | Salones de Eventos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <a class="brand" href="index.php">Tú Evento Bolivia</a>
            <nav class="nav-links">
                <a href="#salones">Salones</a>
                <a href="#eventos">Tipo de evento</a>
                <a href="#clientes">Clientes</a>
                <a href="#contacto">Contacto</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-copy">
                <p>Salones de eventos con estilo empresarial y diseño contemporáneo para tus reuniones, celebraciones y lanzamientos.</p>
                <h1>Encuentra el espacio perfecto para tu evento en Bolivia</h1>
                <p>Filtra por tipo de evento, tipo de cliente y descubre salones exclusivos con imágenes reales de cada ambiente.</p>
                <a class="button-primary" href="#search">Buscar salones</a>
            </div>
            <div class="hero-visual">
                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80" alt="Salón de eventos moderno">
                <div class="small-grid">
                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80" alt="Ambiente empresarial de salón">
                    <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=800&q=80" alt="Evento corporativo en salón">
                </div>
            </div>
        </div>
    </section>

    <section class="search-panel" id="search">
        <form method="get" action="index.php">
            <div class="search-row">
                <input type="text" name="search" placeholder="Buscar por ciudad, salón o palabra clave" value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit">Aplicar filtros</button>
            </div>
            <div class="filters">
                <div class="filter-group" id="eventos">
                    <h3>Tipo de evento</h3>
                    <div class="checkbox-row">
                        <?php foreach ($eventTypes as $label => $value): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="event_type[]" value="<?php echo $value; ?>" <?php echo in_array($value, $selectedEvents, true) ? 'checked' : ''; ?>>
                                <?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="filter-group" id="clientes">
                    <h3>Tipo de cliente</h3>
                    <div class="checkbox-row">
                        <?php foreach ($clientTypes as $label => $value): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="client_type[]" value="<?php echo $value; ?>" <?php echo in_array($value, $selectedClients, true) ? 'checked' : ''; ?>>
                                <?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section class="results" id="salones">
        <div class="result-summary">
            <h2><?php echo count($filteredSalones); ?> salones disponibles</h2>
            <p>Opciones modernas y sobrias para tu evento empresarial.</p>
        </div>
        <div class="grid-cards">
            <?php if (empty($filteredSalones)): ?>
                <div style="grid-column: 1 / -1; background: #fff; border-radius: 24px; padding: 36px; box-shadow: 0 18px 40px rgba(16, 42, 67, 0.08); text-align: center;">
                    <h3 style="margin:0 0 12px; color:#102a43;">No se encontraron salones</h3>
                    <p style="margin:0; color:#5b6770;">Ajusta tus criterios de búsqueda y vuelve a intentarlo.</p>
                </div>
            <?php endif; ?>

            <?php foreach ($filteredSalones as $salon): ?>
                <article class="card">
                    <img src="<?php echo htmlspecialchars($salon['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto del <?php echo htmlspecialchars($salon['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($salon['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="card-subtitle"><?php echo htmlspecialchars($salon['location'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($salon['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="badges">
                            <?php foreach ($salon['event_types'] as $type): ?>
                                <span class="badge"><?php echo ucfirst(htmlspecialchars($type, ENT_QUOTES, 'UTF-8')); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="card-price"><?php echo htmlspecialchars($salon['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <a class="button-primary" href="#contacto">Ver detalles</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <footer class="footer" id="contacto">
        <div class="footer-content">
            <p class="brand-small">Tú Evento Bolivia</p>
            <p>&copy; <?php echo date('Y'); ?> Copyright TúEventoBolivia. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
