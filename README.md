# Andina Pokemones Plugin

Plugin WordPress

## 📦 Descripción
Este plugin permite:

- Registrar un **Custom Post Type** llamado `pokemones`
- Registrar taxonomías personalizadas: `tipo` y `fortaleza`
- Mostrar un buscador filtrable mediante el **shortcode** `[buscar_pokemones]`
- Conectarse a la **PokéAPI** para importar y visualizar datos reales
- Usar un botón en el panel de administración para importar los primeros 20 Pokémon

## ✅ Requisitos
- WordPress 6.0 o superior
- Tema activo que soporte shortcodes y CPTs

## 🚀 Instalación
1. Descargar y extraer `andina-pokemones.zip`
2. Subir la carpeta `andina-pokemones` a `/wp-content/plugins/`
3. Activar desde el panel de plugins

## 🧩 Uso
### Shortcode
Agrega el siguiente shortcode en una página o entrada:
```shortcode
[buscar_pokemones]
```

Mostrará:
- Campo de búsqueda por nombre
- Filtros por tipo y fortaleza
- Resultados en tarjetas con imagen, tipo y fortaleza

### Importación de Pokemones
1. Ir al panel de WordPress > Pokemones > Importar Pokemones
2. Hacer clic en "Importar 20 Pokemones"
3. Se crearán 20 entradas del CPT con sus taxonomías y miniaturas

## 🧪 Tecnologías usadas
- `register_post_type`, `register_taxonomy`
- `wp_remote_get()` para consumir la PokéAPI
- `add_shortcode()`
- `media_handle_sideload()` para imagen destacada

## 📁 Estructura del plugin
```
andina-pokemones/
├── andina-pokemones.php
├── inc/
│   ├── cpt-setup.php
│   ├── api-helper.php
│   ├── shortcode-handler.php
│   └── admin-importer.php
├── templates/
│   └── pokemones-list.php
├── assets/
│   └── style.css
└── README.md
```

## 🧼 Buenas prácticas
- Código modular y organizado
- Compatible con WordPress moderno
- Inputs sanitizados y salida escapada correctamente

---
Desarrollado para Andina Digital – Test Técnico Backend WordPress 💼
