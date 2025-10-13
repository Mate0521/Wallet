package data.network

import data.modelo.Transaccion
import data.modelo.Usuario
import data.modelo.cuenta
import data.modelo.req.Autenticacion
import data.modelo.req.Entrada
import data.modelo.req.Historial
import data.modelo.req.TransaccionReq
import data.modelo.res.EntradaRes
import data.modelo.res.Mensaje
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
     suspend fun traerDatos(@Body entrada: Entrada): EntradaRes

    // HISTORIAL DE TRANSACCIONES
    @POST("historial.php")
    suspend fun obtenerHistorial(@Body historial: Historial): Response<List<Transaccion>>

    // NOTIFICACIONES
    @POST("notificacion.php")
    suspend fun obtenerNotificaciones(@Body usuario: Usuario): Call<Map<String, Any>>

    // TRANSACCIONES
    @POST("transaccion.php")
    suspend fun registrarTransaccion(@Body transaccion: TransaccionReq): Mensaje

    // REGISTRO / GESTIÓN DE USUARIOS
    @POST("usuario.php")
    fun registrarUsuario(@Body usuario: Usuario): Call<Map<String, Any>>

}
