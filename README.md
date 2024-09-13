# Instalación de WebSocket

Instalamos este paquete de NodeJS en su versión `probada 18.16.1` y parece que solo funciona en las versiones `14.x, 16.x y 18.x`.

en la versión 20.16.0 no me funciono.
y en laravel estoy usando la v8.1.12

```bash
npm install -g @soketi/soketi
```

Para poder ejecutar el servicio junto con el servidor (Windows)
Debemos Programar una Tarea para que corra el sig. comando:
```bash
soketi start
```

Para conocer más favor de visitar [Soketi.app](https://docs.soketi.app/getting-started/installation/cli-installation)

## Configuración de Laravel
La misma que la de pusher, para eso revisar todos los cambios del commit x
