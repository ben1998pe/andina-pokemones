<?php

function andina_render_pokemon_shortcode() {
    ob_start();

    $nombre = isset($_GET['pokemon_nombre']) ? sanitize_text_field($_GET['pokemon_nombre']) : '';
    $tipos = isset($_GET['pokemon_tipo']) ? array_map('sanitize_text_field', (array) $_GET['pokemon_tipo']) : [];
    $fortalezas = isset($_GET['pokemon_fortaleza']) ? array_map('sanitize_text_field', (array) $_GET['pokemon_fortaleza']) : [];

    ?>
    <form method="get" class="pokemon-form">
        <label for="pokemon_nombre">Buscar por nombre:</label>
        <input type="text" name="pokemon_nombre" id="pokemon_nombre" placeholder="Nombre" value="<?php echo esc_attr($nombre); ?>">

        <label for="pokemon_tipo">Filtrar por Tipo:</label>
        <select name="pokemon_tipo[]" id="pokemon_tipo">
            <option value="">-- Selecciona un tipo --</option>
            <?php $tipos_terms = get_terms(['taxonomy' => 'tipo', 'hide_empty' => false]); ?>
            <?php foreach ($tipos_terms as $term): ?>
                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected(in_array($term->slug, $tipos)); ?>><?php echo esc_html($term->name); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="pokemon_fortaleza">Filtrar por Fortaleza:</label>
        <select name="pokemon_fortaleza[]" id="pokemon_fortaleza">
            <option value="">-- Selecciona una fortaleza --</option>
            <?php $fortaleza_terms = get_terms(['taxonomy' => 'fortaleza', 'hide_empty' => false]); ?>
            <?php foreach ($fortaleza_terms as $term): ?>
                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected(in_array($term->slug, $fortalezas)); ?>><?php echo esc_html($term->name); ?></option>
            <?php endforeach; ?>
        </select>

        <div class="form-buttons">
            <button type="submit" class="btn-search">Buscar</button>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn-reset">Limpiar</a>
        </div>
    </form>
    <?php

    $args = [
        'post_type' => 'pokemones',
        'posts_per_page' => -1,
        's' => $nombre,
        'tax_query' => []
    ];

    if (!empty($tipos)) {
        $args['tax_query'][] = [
            'taxonomy' => 'tipo',
            'field' => 'slug',
            'terms' => $tipos
        ];
    }
    if (!empty($fortalezas)) {
        $args['tax_query'][] = [
            'taxonomy' => 'fortaleza',
            'field' => 'slug',
            'terms' => $fortalezas
        ];
    }

    $query = new WP_Query($args);

    include ANDINA_POKEMONES_PATH . 'templates/pokemones-list.php';

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('buscar_pokemones', 'andina_render_pokemon_shortcode');
