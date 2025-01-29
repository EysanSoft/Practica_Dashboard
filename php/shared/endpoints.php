<?php
class EndPoints {
    static $apiUrl = "https://localhost:7078/";

    ### Usuarios ###
    static $crearUsuario = "usuario/crear_usuario/"; // POST
    static $obtenerUsuarios = "usuario/obtener_usuarios/"; // GET
    static $obtenerUsuario = "usuario/obtener_usuario/"; // GET
    static $actualizarUsuario = "usuario/actualizar_usuario/"; // PUT
    static $eliminarUsuario = "usuario/eliminar_usuario/"; // DELETE
    ### Fin Usuarios ###

    ### Clientes ###
    static $crearCliente = "cliente/crear_cliente/"; // POST
    static $obtenerClientes = "cliente/obtener_clientes/"; // GET
    static $obtenerCliente = "cliente/obtener_cliente/"; // GET
    static $actualizarCliente = "cliente/actualizar_cliente/"; // PUT
    static $eliminarCliente = "cliente/eliminar_cliente/"; // DELETE
    ### Fin Clientes ###
}
?>
