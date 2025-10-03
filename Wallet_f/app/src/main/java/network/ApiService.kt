package network

import modelo.*
import modelo.res.*
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.POST


interface ApiService {

    // LOGIN / AUTENTICACIÓN
    @POST("autenticacion.php")
    fun autenticarUsuario(@Body usuario: Usuario): Call<Map<String, Any>>

    // CUENTA
    @POST("cuenta.php")
    fun obtenerCuenta(@Body cuenta: Cuenta): Call<Map<String, Any>>

    // ENTRADA (ej. dashboard o datos iniciales)
    @POST("entrada.php")
    fun traerDatos(@Body usuario: Usuario): Call<EntradaRes>

    // HISTORIAL DE TRANSACCIONES
    @POST("historial.php")
    fun obtenerHistorial(@Body usuario: Usuario): Call<Map<String, Any>>

    // NOTIFICACIONES
    @POST("notificacion.php")
    fun obtenerNotificaciones(@Body usuario: Usuario): Call<Map<String, Any>>

    // TRANSACCIONES
    @POST("transaccion.php")
    fun registrarTransaccion(@Body transaccion: Transaccion): Call<Map<String, Any>>

    // REGISTRO / GESTIÓN DE USUARIOS
    @POST("usuario.php")
    fun registrarUsuario(@Body usuario: Usuario): Call<Map<String, Any>>
}
