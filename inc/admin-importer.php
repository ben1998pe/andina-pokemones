<?php

add_action('admin_menu', 'andina_pokemones_admin_menu');

function andina_pokemones_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=pokemones',
        'Importar Pokemones',
        'Importar Pokemones',
        'manage_options',
        'andina-importar',
        'andina_pokemones_importar_callback'
    );
}

function andina_pokemones_importar_callback() {
    echo '<div class="wrap"><h1>Importar Pokemones desde PokéAPI</h1>';

    if (isset($_POST['andina_importar'])) {
        $nombres = andina_get_pokemon_list(20);
        foreach ($nombres as $nombre) {
            $datos = andina_get_pokemon_data($nombre);

            if (!$datos) continue;

            $post_id = wp_insert_post([
                'post_title' => $datos['nombre'],
                'post_type' => 'pokemones',
                'post_status' => 'publish'
            ]);

            if (is_wp_error($post_id)) continue;

            // Simulamos tipo = tipo real / fortaleza = tipo[0] si existe
            if (!empty($datos['tipos'])) {
                wp_set_object_terms($post_id, $datos['tipos'], 'tipo');
                wp_set_object_terms($post_id, $datos['tipos'][0], 'fortaleza');
            }

            // Guardar imagen destacada si existe
            if ($datos['imagen']) {
                andina_set_post_thumbnail_from_url($post_id, $datos['imagen']);
            }
        }
        echo '<div class="updated"><p>¡Importación completada!</p></div>';
    }

    echo '<form method="post"><input type="submit" name="andina_importar" class="button button-primary" value="Importar 20 Pokemones"></form></div>';
}

function andina_set_post_thumbnail_from_url($post_id, $url) {
    $tmp = download_url($url);
    if (is_wp_error($tmp)) return;

    $desc = basename($url);
    $file_array = [
        'name'     => $desc,
        'tmp_name' => $tmp
    ];

    $id = media_handle_sideload($file_array, $post_id);
    if (!is_wp_error($id)) {
        set_post_thumbnail($post_id, $id);
    }
}
