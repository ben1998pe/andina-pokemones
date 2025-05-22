<?php

if ($query->have_posts()) {
    echo '<div class="pokemones-grid">';

    while ($query->have_posts()) {
        $query->the_post();
        $tipos = get_the_terms(get_the_ID(), 'tipo');
        $fortalezas = get_the_terms(get_the_ID(), 'fortaleza');

        echo '<div class="pokemon-card">';
        echo '<h3>' . esc_html(get_the_title()) . '</h3>';

        if (has_post_thumbnail()) {
            echo get_the_post_thumbnail(get_the_ID(), 'medium');
        }

        if ($tipos) {
            echo '<p><strong>Tipo:</strong> ' . implode(', ', wp_list_pluck($tipos, 'name')) . '</p>';
        }
        if ($fortalezas) {
            echo '<p><strong>Fortaleza:</strong> ' . implode(', ', wp_list_pluck($fortalezas, 'name')) . '</p>';
        }

        echo '</div>';
    }

    echo '</div>';
} else {
    echo '<p>No se encontraron Pokemones con esos filtros.</p>';
}
