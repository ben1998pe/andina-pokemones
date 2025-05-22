<?php

function andina_register_cpt() {
    // CPT: pokemones
    register_post_type('pokemones', [
        'labels' => [
            'name' => 'Pokemones',
            'singular_name' => 'Pokemon',
            'add_new_item' => 'Agregar nuevo Pokemon',
            'edit_item' => 'Editar Pokemon',
            'new_item' => 'Nuevo Pokemon',
            'view_item' => 'Ver Pokemon',
            'search_items' => 'Buscar Pokemones'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'pokemones'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true
    ]);

    // Taxonomía: tipo
    register_taxonomy('tipo', 'pokemones', [
        'labels' => [
            'name' => 'Tipos',
            'singular_name' => 'Tipo'
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'tipo']
    ]);

    // Taxonomía: fortaleza
    register_taxonomy('fortaleza', 'pokemones', [
        'labels' => [
            'name' => 'Fortalezas',
            'singular_name' => 'Fortaleza'
        ],
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'fortaleza']
    ]);
}
add_action('init', 'andina_register_cpt');
