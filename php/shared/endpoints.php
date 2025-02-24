<?php
class EndPoints {
    static $apiUrl = "https://2395-177-229-104-23.ngrok-free.app/";

    ### Usuarios ###
    static $iniciarSesion = "autenticar_usuario/iniciar_sesion/"; // POST
    static $crearUsuario = "usuario/crear_usuario/"; // POST
    static $obtenerUsuarios = "usuario/obtener_usuarios/"; // GET
    static $obtenerUsuario = "usuario/obtener_usuario/"; // GET
    static $actualizarUsuario = "usuario/actualizar_usuario/"; // PUT
    static $actualizarContra = "usuario/actualizar_contrasena/"; // PUT
    static $eliminarUsuario = "usuario/eliminar_usuario/"; // DELETE
    ### Fin Usuarios ###

    ### Clientes ###
    static $crearCliente = "cliente/crear_cliente/"; // POST
    static $obtenerClientes = "cliente/obtener_clientes/"; // GET
    static $obtenerCliente = "cliente/obtener_cliente/"; // GET
    static $actualizarCliente = "cliente/actualizar_cliente/"; // PUT
    static $eliminarCliente = "cliente/eliminar_cliente/"; // DELETE
    ### Fin Clientes ###

    ### Mensajes ###
    static $crearMensaje = "mensaje/crear_mensaje/"; // POST
    static $obtenerMensajes = "mensaje/obtener_mensajes/"; // GET
    static $obtenerTipos = "mensaje/obtener_tipos/"; // GET
    static $obtenerConteoSemanal = "mensaje/obtener_conteo_semanal/"; // GET
    static $eliminarMensaje = "mensaje/eliminar_mensaje/"; // DELETE
    ### Fin Mensajes ###

    ### Permisos ###
    static $obtenerPermisos = "permiso/obtener_permisos/"; // GET
    ### Fin Permisos ###
}
?>
