<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Nuestra Impresionante Galería</h1>
        <p>Explora algunas de nuestras mejores capturas.</p>
    </header>

    <main class="gallery-container">
        <?php
        // Definir la ruta al directorio de imágenes
        $image_directory = 'images/';

        // Obtener una lista de todos los archivos y directorios dentro de 'images/'
        // scandir() devuelve un array de nombres de archivos y directorios
        $files = scandir($image_directory);

        // Array para almacenar solo los nombres de los archivos de imagen
        $images = [];

        // Extensiones de archivo permitidas para imágenes
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

        // Filtrar los resultados para obtener solo archivos de imagen válidos
        foreach ($files as $file) {
            // Ignorar '.' (directorio actual) y '..' (directorio padre)
            if ($file === '.' || $file === '..') {
                continue;
            }

            // Construir la ruta completa al archivo
            $filepath = $image_directory . $file;

            // Comprobar si es un archivo (no un subdirectorio)
            // y si tiene una extensión de imagen permitida
            if (is_file($filepath)) {
                $file_extension = pathinfo($file, PATHINFO_EXTENSION); // Obtener la extensión
                // Convertir a minúsculas para una comparación sin distinción entre mayúsculas y minúsculas
                if (in_array(strtolower($file_extension), $allowed_extensions)) {
                    $images[] = $file; // Añadir el nombre del archivo al array de imágenes
                }
            }
        }

        // Si se encontraron imágenes, mostrar la galería
        if (!empty($images)) {
            echo '<div class="gallery-grid">';
            foreach ($images as $image_name) {
                // Generar el HTML para cada imagen
                echo '<div class="gallery-item">';
                echo '<img src="' . $image_directory . $image_name . '" alt="Imagen de la galería">';
                // Puedes añadir un pie de foto o descripción aquí si lo deseas
                echo '<div class="image-title">' . htmlspecialchars(pathinfo($image_name, PATHINFO_FILENAME)) . '</div>';
                echo '</div>'; // Cierra gallery-item
            }
            echo '</div>'; // Cierra gallery-grid
        } else {
            // Mensaje si no se encuentran imágenes
            echo '<p class="no-images">No se encontraron imágenes en el directorio "' . htmlspecialchars($image_directory) . '".</p>';
            echo '<p class="no-images-tip">Asegúrate de que tus imágenes estén en la carpeta `' . htmlspecialchars($image_directory) . '` y sean de tipos comunes como JPG, PNG, GIF, WEBP.</p>';
        }
        ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Galería de Imágenes. Todos los derechos reservados.</p>
    </footer>

</body>
</html>