package data.network

import data.modelo.Transaccion
import data.modelo.Usuario
import data.modelo.cuenta
import data.modelo.req.Autenticacion
import data.modelo.req.Entrada
import data.modelo.req.Historial
import data.modelo.req.TransaccionReq
import data.modelo.res.EntradaRes
import retrofit2.Call
import retrofit2.Response
import retrofit2.http.Body
import retrofit2.http.POST


interface ApiService {

    // LOGIN / AUTENTICACIÓN
    @POST("autenticacion.php")
    suspend fun autenticarUsuario(@Body autenticacion: Autenticacion): Response<Unit>

    // CUENTA
    @POST("cuenta.php")
    fun obtenerCuenta(@Body cuenta: cuenta): Call<Map<String, Any>>

    // ENTRADA (ej. dashboard o datos iniciales)
    @POST("entrada.php")
    fun traerDatos(@Body entrada: Entrada): Response<EntradaRes>

    // HISTORIAL DE TRANSACCIONES
    @POST("historial.php")
    fun obtenerHistorial(@Body historial: Historial): Response<List<Transaccion>>

    // NOTIFICACIONES
    @POST("notificacion.php")
    fun obtenerNotificaciones(@Body usuario: Usuario): Call<Map<String, Any>>

    // TRANSACCIONES
    @POST("transaccion.php")
    fun registrarTransaccion(@Body transaccion: TransaccionReq): Response<Unit>

    // REGISTRO / GESTIÓN DE USUARIOS
    @POST("usuario.php")
    fun registrarUsuario(@Body usuario: Usuario): Call<Map<String, Any>>
}
