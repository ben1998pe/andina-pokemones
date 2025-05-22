<?php

function andina_get_pokemon_data($nombre) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($nombre);
    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        return null;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!$data || !isset($data['name'])) {
        return null;
    }

    return [
        'nombre' => $data['name'],
        'imagen' => $data['sprites']['front_default'],
        'peso' => $data['weight'],
        'tipos' => array_map(fn($t) => $t['type']['name'], $data['types'])
    ];
}

function andina_get_pokemon_list($limit = 20) {
    $url = "https://pokeapi.co/api/v2/pokemon?limit={$limit}";
    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        return [];
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!isset($data['results'])) {
        return [];
    }

    return array_map(fn($item) => $item['name'], $data['results']);
}