package network

import modelo.*
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.POST

interface ApiService {

    @POST("autenticacion.php")
    fun autenticarUsuario(@Body usuario: usuario): Call<Map<String, Any>>

    @POST("cuenta.php")
    fun acount(@Body cuenta: cuenta):Call<Map<String, Any>>

    @POST("entrada.php")
    fun traerDatos(@Body usuario: usuario): Call<Map<String, Any>>

    @POST("historial.php")
    fun historial(@Body usuario: usuario): Call<Map<String, Any>>

    @POST("notificacion.php")
    fun notificacion(@Body usuario: usuario): Call<Map<String, Any>>

    @POST("transaccion.php")
    fun transaccion(@Body transaccion: transaccion): Call<Map<String, Any>>

    @POST("usuario.php")
    fun user(@Body usuario: usuario): Call<Map<String, Any>>


}